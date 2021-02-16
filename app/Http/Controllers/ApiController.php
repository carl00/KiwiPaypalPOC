<?php

namespace App\Http\Controllers;

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
            if ($body->convert == false) {
                $amount = $body->amount;
            } else {
                $calc = $body->conversion["minutes"] * $body->conversion["rate"];
                $amount = number_format($calc, 2, '.', '');
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

            $data = array(
                "errors" => false,
                "success" => true,
                "message" => $response->result->status,
                "data" => array(
                    "order_id" => $response->result->id,
                    "payment_url" => $response->result->links[1]->href,
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
}
