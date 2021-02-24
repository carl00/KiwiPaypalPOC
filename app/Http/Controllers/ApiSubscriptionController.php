<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Plan;
use App\Models\Subscription;
use App\PPClient;
use Exception;
use Illuminate\Http\Request;

use PayPalHttp\HttpRequest;

class PlansGetRequest extends HttpRequest
{
    function __construct($planId)
    {
        parent::__construct("/v1/billing/plans/{plan_id}", "GET");
        $this->path = str_replace("{plan_id}", urlencode($planId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }
}

class GetAllPlansRequest extends HttpRequest
{
    function __construct()
    {
        parent::__construct("/v1/billing/plans", "GET");
        $this->headers["Content-Type"] = "application/json";
    }
}

class PlansCreateRequest extends HttpRequest
{
    function __construct()
    {
        parent::__construct("/v1/billing/plans", "POST");
        $this->headers["Content-Type"] = "application/json";
    }


    public function payPalPartnerAttributionId($payPalPartnerAttributionId)
    {
        $this->headers["PayPal-Partner-Attribution-Id"] = $payPalPartnerAttributionId;
    }
    public function prefer($prefer)
    {
        $this->headers["Prefer"] = $prefer;
    }
}

class ProductsCreateRequest extends HttpRequest
{
    function __construct()
    {
        parent::__construct("/v1/catalogs/products", "POST");
        $this->headers["Content-Type"] = "application/json";
    }


    public function payPalPartnerAttributionId($payPalPartnerAttributionId)
    {
        $this->headers["PayPal-Partner-Attribution-Id"] = $payPalPartnerAttributionId;
    }
    public function prefer($prefer)
    {
        $this->headers["Prefer"] = $prefer;
    }
}

class SubscriptionsCreateRequest extends HttpRequest
{
    function __construct()
    {
        parent::__construct("/v1/billing/subscriptions", "POST");
        $this->headers["Content-Type"] = "application/json";
    }


    public function payPalPartnerAttributionId($payPalPartnerAttributionId)
    {
        $this->headers["PayPal-Partner-Attribution-Id"] = $payPalPartnerAttributionId;
    }
    public function prefer($prefer)
    {
        $this->headers["Prefer"] = $prefer;
    }
}

class SubscriptionsGetRequest extends HttpRequest
{
    function __construct($subscriptionId)
    {
        parent::__construct("/v1/billing/subscriptions/{subscription_id}", "GET");
        $this->path = str_replace("{subscription_id}", urlencode($subscriptionId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }
}

class SubscriptionsCancelRequest extends HttpRequest
{
    function __construct($subscriptionId)
    {
        parent::__construct("/v1/billing/subscriptions/{subscription_id}/cancel", "POST");
        $this->path = str_replace("{subscription_id}", urlencode($subscriptionId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }
}

class SubscriptionsUpdateRequest extends HttpRequest
{
    function __construct($subscriptionId)
    {
        parent::__construct("/v1/billing/subscriptions/{subscription_id}", "PATCH");
        $this->path = str_replace("{subscription_id}", urlencode($subscriptionId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }
}

class SubscriptionsActivateRequest extends HttpRequest
{
    function __construct($subscriptionId)
    {
        parent::__construct("/v1/billing/subscriptions/{subscription_id}/activate", "POST");
        $this->path = str_replace("{subscription_id}", urlencode($subscriptionId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }
}

class SubscriptionsReviseRequest extends HttpRequest
{
    function __construct($subscriptionId)
    {
        parent::__construct("/v1/billing/subscriptions/{subscription_id}/revise", "POST");
        $this->path = str_replace("{subscription_id}", urlencode($subscriptionId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }
}

class ApiSubscriptionController extends Controller

{
    public function __construct()
    {
        $this->client = PPClient::client();
        $this->out = new \Symfony\Component\Console\Output\ConsoleOutput();
    }


    public function getPlanDetailsById(Request $body)
        {
            if ($body->plan_id) {
                $planId = $body->plan_id;
            }
            $request = new PlansGetRequest($planId);
            try {
                $response = $this->client->execute($request);
                $data = array(
                    "errors" => false,
                    "success" => true,
                    "message" => sprintf("Fetched Plan detail"),
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

        public function getAllPlans(Request $body)
        {

            $request = new GetAllPlansRequest();
            try {
                $response = $this->client->execute($request);
                $data = array(
                    "errors" => false,
                    "success" => true,
                    "message" => sprintf("Fetched All Plans"),
                    "data" => array(
                        "status" => $response,
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

    public function createPlan(Request $body)
    {
        try {
            $plan = new Plan;

            $request = new PlansCreateRequest();
            $request->prefer('return=representation');
            $request->body = $body->data;

            $response = $this->client->execute($request);

            $planId = $response->result->id;
            $status = $response->result->status;

            //creaing a log for just created order
            $logs = new Logs;
            $logs->plan_id = $planId;
            $logs->status = $status;
            $logs->meta = json_encode($response);
            $logs->save();

            $data = array(
                "errors" => false,
                "success" => true,
                "message" => $status,
                "data" => array(
                    "plan_id" => $planId,
                    "meta" => $response
                )
            );

            $plan->id = $planId;
            $plan->name = $response->result->name;
            $plan->product_id = $response->result->product_id;
            $plan->description = $response->result->description;
            $plan->status = $status;
            $plan->meta = json_encode($response);
            $plan->save();

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

    public function createProduct(Request $body)
    {
        try {
            //$product = new Product;

            $request = new ProductsCreateRequest();
            $request->prefer('return=representation');
            $request->body = $body->data;

            $response = $this->client->execute($request);

            $productId = $response->result->id;
            $status = $response->statusCode;

            //creaing a log for just created order
            // $logs = new Logs;
            // $logs->product_id = $productId;
            // $logs->status = $status;
            // $logs->meta = json_encode($response);
            // $logs->save();

            $data = array(
                "errors" => false,
                "success" => true,
                "message" => $status,
                "data" => array(
                    "product_id" => $productId,
                    "meta" => $response
                )
            );

            // $product->id = $productId;
            // $product->status = $status;
            // $product->meta = json_encode($response);
            // $product->save();

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

    public function createSubscription(Request $body)
    {
        try {
            $subscription = new Subscription;

            $request = new SubscriptionsCreateRequest();
            $request->prefer('return=representation');
            $request->body = $body->data;

            $response = $this->client->execute($request);

            $subscriptionId = $response->result->id;
            $status = $response->result->status;

            //creaing a log for just created order
            $logs = new Logs;
            $logs->subscription_id = $subscriptionId;
            $logs->status = $status;
            $logs->meta = json_encode($response);
            $logs->save();

            $data = array(
                "errors" => false,
                "success" => true,
                "message" => $status,
                "data" => array(
                    "subscription_id" => $subscriptionId,
                    "meta" => $response
                )
            );

            $subscription->id = $subscriptionId;
            $subscription->plan_id = $response->result->plan_id;
            $subscription->start_time = $response->result->start_time;
            $subscription->quantity = $response->result->quantity;
            $subscription->subscriber = json_encode($response->result->subscriber);
            $subscription->create_time = $response->result->create_time;
            $subscription->status = $status;
            $subscription->meta = json_encode($response);
            $subscription->save();

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

    public function getSubscriptionDetailsById(Request $body)
    {
        if ($body->subscription_id) {
            $subscriptionId = $body->subscription_id;
        }
        $request = new SubscriptionsGetRequest($subscriptionId);
        try {
            $response = $this->client->execute($request);
            $data = array(
                "errors" => false,
                "success" => true,
                "message" => sprintf("Fetched Subscription details"),
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

    public function cancelSubscriptionById(Request $body)
    {
        try {
            if ($body->subscription_id) {
                $subscriptionId = $body->subscription_id;
            }
            $request = new SubscriptionsCancelRequest($subscriptionId);
            $request->body = $body->data;

            $response = $this->client->execute($request);
            $data = array(
                "errors" => false,
                "success" => true,
                "message" => sprintf("Subscription Cancelled Successfully"),
                "data" => array(
                    "status" => $response,
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

    public function activateSubscriptionById(Request $body)
    {
        try {
            if ($body->subscription_id) {
                $subscriptionId = $body->subscription_id;
            }
            $request = new SubscriptionsActivateRequest($subscriptionId);
            $request->body = $body->data;

            $response = $this->client->execute($request);
            $data = array(
                "errors" => false,
                "success" => true,
                "message" => sprintf("Subscription Activated Successfully"),
                "data" => array(
                    "status" => $response,
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

    public function reviseSubscriptionById(Request $body)
    {
        try {
            if ($body->subscription_id) {
                $subscriptionId = $body->subscription_id;
            }
            $request = new SubscriptionsReviseRequest($subscriptionId);
            $request->body = $body->data;

            $response = $this->client->execute($request);
            $data = array(
                "errors" => false,
                "success" => true,
                "message" => sprintf("Subscription Revised Successfully"),
                "data" => array(
                    "status" => $response,
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


    public function updateSubscriptionById(Request $body)
    {
        try {
            if ($body->subscription_id) {
                $subscriptionId = $body->subscription_id;
            }
            $request = new SubscriptionsUpdateRequest($subscriptionId);
            $request->body = $body->data;

            $response = $this->client->execute($request);
            $data = array(
                "errors" => false,
                "success" => true,
                "message" => sprintf("Subscription Updated Successfully"),
                "data" => array(
                    "status" => $response,
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

    public function webhookSubscriptionListener(Request $request)
    {
        try {

            $this->out->writeln('Calling listener subscriptions webhook.');
            $json = file_get_contents('php://input');
            $action = json_decode($json, true);
            $subscriptionId = $action["resource"]["id"];
            $status = $action["resource"]["status"];

            $logs = new Logs;
            $logs->subscription_id = $subscriptionId;
            $logs->status = $status;
            $logs->meta = json_encode($action);
            $logs->save();

            if (Subscription::where('id', $subscriptionId)->exists()) {
                Subscription::where('id', $subscriptionId)->update(['status' => $status]);
            }

            $data = array(
                "errors" => false,
                "success" => true,
                "message" => "successfully logged and updated Subscription",
            );

            return $data;
        } catch (Exception $ex) {
            $this->out->writeln('Error Calling listener subscriptions webhook.');
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
