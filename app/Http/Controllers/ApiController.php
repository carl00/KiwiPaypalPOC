<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Logs;
use Exception;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalHttp\HttpRequest;
use kiwi\KiwiPayPalClient;


class WebhookCreateRequest extends HttpRequest
{
    function __construct()
    {
        parent::__construct("/v1/notifications/webhooks", "POST");
        $this->headers["Content-Type"] = "application/json";
    }
}


class ApiController extends Controller

{
    public function __construct()
    {
        $this->client = KiwiPayPalClient::client();
    }

    public function createPaymentLink(Request $body)
    {
        try {
            $order = new Order;
            if ($body->convert == false) {
                $amount = $body->amount;
                $order->amount = $body->amount;
            } else {
                $calc = $body->conversion["minutes"] * $body->conversion["rate"];
                $amount = number_format($calc, 2, '.', '');
                $order->minutes = $body->conversion["minutes"];
                $order->amount = $amount;
            }

            $request = new OrdersCreateRequest();
            $request->prefer('return=representation');
            $request->body = [
                "intent" => "CAPTURE",
                "purchase_units" => [[
                    "reference_id" => "test_ref_id1",
                    "amount" => [
                        "value" => $amount,
                        "currency_code" => "INR"
                    ]
                ]],
                "application_context" => [
                    "cancel_url" => "https://example.com/cancel",
                    "return_url" => "https://example.com/return"
                ]
            ];



            $response = $this->client->execute($request);

            $orderId = $response->result->id;
            $status = $response->result->status;

            //creaing a log for just created order
            $logs = new Logs;
            $logs->order_id = $orderId;
            $logs->status = $status;
            $logs->meta = json_encode($response);
            $logs->save();

            $data = array(
                "errors" => false,
                "success" => true,
                "message" => $status,
                "data" => array(
                    "order_id" => $orderId,
                    "payment_url" => $response->result->links[1]->href,
                    "meta" => $response
                )
            );

            $order->id = $orderId;
            $order->status = $status;
            $order->meta = json_encode($response);
            $order->payer_email = json_encode($response->result->purchase_units[0]->payee->email_address);
            $order->payer_json = json_encode($response->result->purchase_units[0]->payee);
            $order->save();

            return $data;
        } catch (Exception $ex) {
            $data = array(
                "errors" => true,
                "success" => false,
                "message" => $ex->getMessage(),
                "data" => $ex
            );

            return $data;
        }
    }

    public function getOrderById(Request $body)
    {
        if ($body->order_id) {
            $orderId = $body->order_id;
        }
        $request = new OrdersGetRequest($orderId);
        try {
            $response = $this->client->execute($request);
            $data = array(
                "errors" => false,
                "success" => true,
                "message" => sprintf("Your Order Status is %s", $response->result->status),
                "data" => array(
                    "status" => $response->result->status,
                    "meta" => $response
                )
            );

            return $data;
        } catch (Exception $ex) {
            $data = array(
                "errors" => true,
                "success" => false,
                "message" => $ex->getMessage(),
                "data" => array(
                    "meta" => $ex
                )
            );
            return $data;
        }
    }

    public function getOrderHistoryById(Request $body)
    {
        if ($body->order_id) {
            $orderId = $body->order_id;
        }
        try {
            if (Logs::where('order_id', $orderId)->exists()) {
                $orderHistory = Logs::where('order_id', $orderId)->latest()->get();

                $data = array(
                    "errors" => false,
                    "success" => true,
                    "message" => sprintf(" Order Hisory fetched"),
                    "data" => array(
                        "status" => 200,
                        "meta" => $orderHistory
                    )
                );

                return $data;
            } else {
                $data = array(
                    "errors" => true,
                    "success" => false,
                    "message" => "Order Id not found, please check your order id",
                );
                return $data;
            }
        } catch (Exception $ex) {
            $data = array(
                "errors" => true,
                "success" => false,
                "message" => $ex->getMessage(),
                "data" => array(
                    "meta" => $ex
                )
            );
            return $data;
        }
    }

    public function getOrderStatusById(Request $body)
    {
        if ($body->order_id) {
            $orderId = $body->order_id;
        }
        $request = new OrdersCaptureRequest($orderId);
        $request->prefer('return=representation');
        try {
            $response = $this->client->execute($request);
            $data = array(
                "errors" => false,
                "success" => true,
                "message" => sprintf("Your Order Status is %s", $response->result->status),
                "data" => array(
                    "status" => $response->result->status,
                    "meta" => $response
                )
            );

            return $data;
        } catch (Exception $ex) {
            $data = array(
                "errors" => true,
                "success" => false,
                "message" => $ex->getMessage(),
                "data" => array(
                    "meta" => $ex
                )
            );
            return $data;
        }
    }

    public function createWebhook(Request $body)
    {

        try {
            $request = new WebhookCreateRequest();
            $request->body = $body->data;

            $response = $this->client->execute($request);

            $data = array(
                "errors" => false,
                "success" => true,
                "message" => sprintf("Webhook created with id %s", $response->result->id),
                "data" => array(
                    "webhook_id" => $response->result->id,
                    "webhook_url" => $response->result->url,
                    "meta" => $response
                )
            );

            return $data;
        } catch (Exception $ex) {
            $data = array(
                "errors" => true,
                "success" => false,
                "message" => $ex->getMessage(),
                "data" => $ex
            );

            return $data;
        }
    }

    public function webhookListener(Request $request)
    {
        try {

            $data = $request->body;
            $orderId = $data["resource"]["id"];
            $status = $data["resource"]["status"];

            $logs = new Logs;
            $logs->order_id = $orderId;
            $logs->status = $status;
            $logs->meta = json_encode($data);
            $logs->save();

            if (Order::where('id', $orderId)->exists()) {
                Order::where('id', $orderId)->update(['status' => $status]);
            }

            $data = array(
                "errors" => false,
                "success" => true,
                "message" => "successfully logged and updated",
            );

            return $data;

        } catch (Exception $ex) {
            $data = array(
                "errors" => true,
                "success" => false,
                "message" => $ex->getMessage(),
                "data" => $ex
            );

            return $data;
        }
    }
}
