## API's LIST

1. Create Payment Link

description: This API is used for creating a payment link. We can pass "amount"
directly or can pass a "conversion" object contaning two attributes "minutes"
and "rates", which then will be used to calculate the required amount.

important flag "convert" needs to be passed always
with its value true and false depending upon whether you want to convert or not.

example request body:

{
    "amount": 120.25,
    "conversion": {
        "minutes": 20.34,
        "rate": "0.25"
    },
    "convert": false
}

example response:

{
    "errors": false,
    "success": true,
    "message": "CREATED",
    "data": {
        "order_id": "9TR72342FD000791G",
        "payment_url": "https://www.sandbox.paypal.com/checkoutnow?token=9TR72342FD000791G",
        "meta": {
            "statusCode": 201,
            "result": {
                "id": "9TR72342FD000791G",
                "intent": "CAPTURE",
                "status": "CREATED",
                "purchase_units": [
                    {
                        "reference_id": "test_ref_id1",
                        "amount": {
                            "currency_code": "INR",
                            "value": "120.25"
                        },
                        "payee": {
                            "email_address": "sb-8ndyy5108314@business.example.com",
                            "merchant_id": "JRABHS4FG63GW"
                        }
                    }
                ],
                "create_time": "2021-02-18T21:39:36Z",
                "links": [
                    {
                        "href": "https://api.sandbox.paypal.com/v2/checkout/orders/9TR72342FD000791G",
                        "rel": "self",
                        "method": "GET"
                    },
                    {
                        "href": "https://www.sandbox.paypal.com/checkoutnow?token=9TR72342FD000791G",
                        "rel": "approve",
                        "method": "GET"
                    },
                    {
                        "href": "https://api.sandbox.paypal.com/v2/checkout/orders/9TR72342FD000791G",
                        "rel": "update",
                        "method": "PATCH"
                    },
                    {
                        "href": "https://api.sandbox.paypal.com/v2/checkout/orders/9TR72342FD000791G/capture",
                        "rel": "capture",
                        "method": "POST"
                    }
                ]
            },
            "headers": {
                "": "",
                "Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
                "Content-Length": "753",
                "Content-Type": "application/json",
                "Date": "Thu, 18 Feb 2021 21",
                "Paypal-Debug-Id": "4aa21c83ef975"
            }
        }
    }
}


2. Get Order Details By Id

description : This API is used to fetch the Order details by passing "order_id"

request body: 
{
   "order_id":"3P70193256757541W"
}

response body:

3. Get Order Status By Id:

description: This API is used to fetch the status of the order by passing "order_id"

request body:

response body:

4. Get Order History By Id:

description : This API is used to fetch the history of the respective order by passing "order_id". History is fetched from the logs stored in the database

request body:

response body:

5. Listner API for orders:

Description : This is a listner api, which listens for event triggers for orders, as soon as any of these event triggers:

- When a buyer approves an order i.e when someone clicks on the link created by create payment api and start's initiating the payment->
CHECKOUT.ORDER.APPROVED

- When Paypal Captures an order i.e when the payment is either completed, denied or pending state ->
PAYMENT.CAPTURE.COMPLETED,
PAYMENT.CAPTURE.DENIED,
PAYMENT.CAPTURE.PENDING	

- When a payment is refunded by the merchant -> PAYMENT.CAPTURE.REFUNDED

Based on above triggers, the listener api updates the status of the orders.

request body : this request body is sent by the paypal

response body: 

### Create Webhooks

Description: This is the api to create webhooks.
It requires an hosted "url" which will recieve the event's trigger response and an array of "event types" which are needed to be triggered

request body : {
    "data":{
        "url":"https://ent241d41804b.m.pipedream.net",
        "event_types":[
           {
               "name":"CHECKOUT.ORDER.APPROVED"
           },
           {
               "name":"PAYMENT.CAPTURE.COMPLETED"
           },
           {
               "name":"CHECKOUT.ORDER.COMPLETED"
           },
           {
               "name":"BILLING.SUBSCRIPTION.UPDATED"
           },
            {
               "name":"BILLING.SUBSCRIPTION.SUSPENDED"
           },
            {
               "name":"BILLING.SUBSCRIPTION.CANCELLED"
           },
            {
               "name":"BILLING.SUBSCRIPTION.ACTIVATED"
           },
            {
               "name":"PAYMENT.SALE.COMPLETED"
           }, {
               "name":"PAYMENT.CAPTURE.DENIED"
           },
           {
               "name":"PAYMENT.CAPTURE.PENDING"
           },
           {
               "name":"PAYMENT.CAPTURE.REFUNDED"
           }
        ]
    }
}


response body:{
    "errors": false,
    "success": true,
    "message": "Webhook created with id 62S05328W88208146",
    "data": {
        "webhook_id": "62S05328W88208146",
        "webhook_url": "https://ent241d41804b.m.pipedream.net",
        "meta": {
            "statusCode": 201,
            "result": {
                "id": "62S05328W88208146",
                "url": "https://ent241d41804b.m.pipedream.net",
                "event_types": [
                    {
                        "name": "CHECKOUT.ORDER.APPROVED",
                        "description": "An order has been approved by buyer."
                    },
                    {
                        "name": "PAYMENT.CAPTURE.COMPLETED",
                        "description": "A payment capture completes."
                    },
                    {
                        "name": "CHECKOUT.ORDER.COMPLETED",
                        "description": "Webhook event emitted after all the purchase_units have been processed"
                    },
                    {
                        "name": "BILLING.SUBSCRIPTION.UPDATED",
                        "description": "A billing agreement is updated."
                    },
                    {
                        "name": "BILLING.SUBSCRIPTION.SUSPENDED",
                        "description": "A billing agreement is suspended."
                    },
                    {
                        "name": "BILLING.SUBSCRIPTION.CANCELLED",
                        "description": "A billing agreement is canceled."
                    },
                    {
                        "name": "BILLING.SUBSCRIPTION.ACTIVATED",
                        "description": "A billing agreement is activated."
                    },
                    {
                        "name": "PAYMENT.SALE.COMPLETED",
                        "description": "A sale completes."
                    },
                    {
                        "name": "PAYMENT.CAPTURE.DENIED",
                        "description": "A payment capture is denied."
                    },
                    {
                        "name": "PAYMENT.CAPTURE.PENDING",
                        "description": "The state of a payment capture changes to pending."
                    },
                    {
                        "name": "PAYMENT.CAPTURE.REFUNDED",
                        "description": "A merchant refunds a payment capture."
                    }
                ],
                "links": [
                    {
                        "href": "https://api.sandbox.paypal.com/v1/notifications/webhooks/62S05328W88208146",
                        "rel": "self",
                        "method": "GET"
                    },
                    {
                        "href": "https://api.sandbox.paypal.com/v1/notifications/webhooks/62S05328W88208146",
                        "rel": "update",
                        "method": "PATCH"
                    },
                    {
                        "href": "https://api.sandbox.paypal.com/v1/notifications/webhooks/62S05328W88208146",
                        "rel": "delete",
                        "method": "DELETE"
                    }
                ]
            },
            "headers": {
                "": "",
                "Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
                "Content-Length": "1444",
                "Content-Type": "application/json",
                "Date": "Thu, 18 Feb 2021 21",
                "Paypal-Debug-Id": "acb4e8d68a471"
            }
        }
    }
}

- IMPORTANT NOTE: Here I have passed only one url for testing purpose 

- But in practice we will run this API twice one for Orders and other for Subscriptions with respective events and listener urls.

- we have created two different listeners for respective status updations

### Subscription's API

1. Create Product

description : This API is used to create a product, product is required to be created first to define a
plan on it

request body :

response body :


2. Create Plan

description: This API is used to create a plan.

request body :

response body :

3. Get All Plan

description : get all plans created by you

request body :

response body :

4.Get Plan By Id

description : get plan details by "plan_id"

request body :

response body :

5. Create Subscription:

desription : Create a subscription by passing "plan_id"

request body :

response body :

6. Get Subscription Details by Id

description : get subscription plan by id

request body :

response body :

7. Cancel Subscription by id

description : cancel subscription plan by id

request body :

response body :

8. Update Subscription by id

request body :
response body :

9.Listener Api for subscription

description : get subscription plan by id

request body :

response body :

Coupons : Coupons are not available inbuilt by paypal