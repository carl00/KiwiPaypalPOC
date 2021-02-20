## API's LIST

# 1. Create Payment Link

description: This API is used for creating a payment link. We can pass "amount"
directly or can pass a "conversion" object contaning two attributes "minutes"
and "rates", which then will be used to calculate the required amount.

important flag "convert" needs to be passed always
with its value true and false depending upon whether you want to convert or not.

path: {{base_url}}/{{api_prefix}}/payment

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
"order_id": "8P2383463P998404G",
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

# 2. Get Order Details By Id

description : This API is used to fetch the Order details by passing "order_id"

path: {{base_url}}/{{api_prefix}}/order

request body:
{
"order_id":"8P2383463P998404G"
}

response body:{
"errors": false,
"success": true,
"message": "Your Order Status is COMPLETED",
"data": {
"status": "COMPLETED",
"meta": {
"statusCode": 200,
"result": {
"id": "8P2383463P998404G",
"intent": "CAPTURE",
"status": "COMPLETED",
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
},
"soft_descriptor": "PAYPAL \*JOHNDOESTES",
"shipping": {
"name": {
"full_name": "John Doe"
},
"address": {
"address_line_1": "Flat no. 507 Wing A Raheja Residency",
"address_line_2": "Film City Road",
"admin_area_2": "Mumbai",
"admin_area_1": "Maharashtra",
"postal_code": "400097",
"country_code": "IN"
}
},
"payments": {
"captures": [
{
"id": "4K647514CH713603H",
"status": "COMPLETED",
"amount": {
"currency_code": "INR",
"value": "120.25"
},
"final_capture": true,
"seller_protection": {
"status": "ELIGIBLE",
"dispute_categories": [
"ITEM_NOT_RECEIVED",
"UNAUTHORIZED_TRANSACTION"
]
},
"seller_receivable_breakdown": {
"gross_amount": {
"currency_code": "INR",
"value": "120.25"
},
"paypal_fee": {
"currency_code": "INR",
"value": "4.83"
},
"net_amount": {
"currency_code": "INR",
"value": "115.42"
}
},
"links": [
{
"href": "https://api.sandbox.paypal.com/v2/payments/captures/4K647514CH713603H",
"rel": "self",
"method": "GET"
},
{
"href": "https://api.sandbox.paypal.com/v2/payments/captures/4K647514CH713603H/refund",
"rel": "refund",
"method": "POST"
},
{
"href": "https://api.sandbox.paypal.com/v2/checkout/orders/8P2383463P998404G",
"rel": "up",
"method": "GET"
}
],
"create_time": "2021-02-20T05:31:28Z",
"update_time": "2021-02-20T05:31:28Z"
}
]
}
}
],
"payer": {
"name": {
"given_name": "John",
"surname": "Doe"
},
"email_address": "sb-7j8uy5108762@personal.example.com",
"payer_id": "GED5L2T99B84A",
"address": {
"country_code": "IN"
}
},
"create_time": "2021-02-20T05:27:36Z",
"update_time": "2021-02-20T05:31:28Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v2/checkout/orders/8P2383463P998404G",
"rel": "self",
"method": "GET"
}
]
},
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Content-Length": "1773",
"Content-Type": "application/json",
"Date": "Sat, 20 Feb 2021 05",
"Paypal-Debug-Id": "ff1df7946d295"
}
}
}
}

# 3. Get Order Status By Id:

description: This API is used to fetch the status of the order by passing "order_id"

path: {{base_url}}/{{api_prefix}}/status

request body:{
"order_id":"8P2383463P998404G"
}

response body:{
"errors": false,
"success": true,
"message": "Your Order Status is COMPLETED",
"data": {
"status": "COMPLETED",
"meta": {
"statusCode": 201,
"result": {
"id": "8P2383463P998404G",
"intent": "CAPTURE",
"status": "COMPLETED",
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
},
"soft_descriptor": "PAYPAL \*JOHNDOESTES",
"shipping": {
"name": {
"full_name": "John Doe"
},
"address": {
"address_line_1": "Flat no. 507 Wing A Raheja Residency",
"address_line_2": "Film City Road",
"admin_area_2": "Mumbai",
"admin_area_1": "Maharashtra",
"postal_code": "400097",
"country_code": "IN"
}
},
"payments": {
"captures": [
{
"id": "4K647514CH713603H",
"status": "COMPLETED",
"amount": {
"currency_code": "INR",
"value": "120.25"
},
"final_capture": true,
"seller_protection": {
"status": "ELIGIBLE",
"dispute_categories": [
"ITEM_NOT_RECEIVED",
"UNAUTHORIZED_TRANSACTION"
]
},
"seller_receivable_breakdown": {
"gross_amount": {
"currency_code": "INR",
"value": "120.25"
},
"paypal_fee": {
"currency_code": "INR",
"value": "4.83"
},
"net_amount": {
"currency_code": "INR",
"value": "115.42"
}
},
"links": [
{
"href": "https://api.sandbox.paypal.com/v2/payments/captures/4K647514CH713603H",
"rel": "self",
"method": "GET"
},
{
"href": "https://api.sandbox.paypal.com/v2/payments/captures/4K647514CH713603H/refund",
"rel": "refund",
"method": "POST"
},
{
"href": "https://api.sandbox.paypal.com/v2/checkout/orders/8P2383463P998404G",
"rel": "up",
"method": "GET"
}
],
"create_time": "2021-02-20T05:31:28Z",
"update_time": "2021-02-20T05:31:28Z"
}
]
}
}
],
"payer": {
"name": {
"given_name": "John",
"surname": "Doe"
},
"email_address": "sb-7j8uy5108762@personal.example.com",
"payer_id": "GED5L2T99B84A",
"address": {
"country_code": "IN"
}
},
"create_time": "2021-02-20T05:27:36Z",
"update_time": "2021-02-20T05:31:28Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v2/checkout/orders/8P2383463P998404G",
"rel": "self",
"method": "GET"
}
]
},
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Content-Length": "1773",
"Content-Type": "application/json",
"Date": "Sat, 20 Feb 2021 05",
"Paypal-Debug-Id": "9f14343f631cb"
}
}
}
}

# 4. Get Order History By Id:

description : This API is used to fetch the history of the respective order by passing "order_id". History is fetched from the logs stored in the database

path:{{base_url}}/{{api_prefix}}/order/history

request body: {
"order_id":"8P2383463P998404G"
}

response body: {
"errors": false,
"success": true,
"message": " Order Hisory fetched",
"data": {
"status": 200,
"meta": [
{
"id": 19,
"order_id": "8P2383463P998404G",
"plan_id": null,
"subscription_id": null,
"status": "CREATED",
"meta": "{\"statusCode\":201,\"result\":{\"id\":\"8P2383463P998404G\",\"intent\":\"CAPTURE\",\"status\":\"CREATED\",\"purchase_units\":[{\"reference_id\":\"test_ref_id1\",\"amount\":{\"currency_code\":\"INR\",\"value\":\"120.25\"},\"payee\":{\"email_address\":\"sb-8ndyy5108314@business.example.com\",\"merchant_id\":\"JRABHS4FG63GW\"}}],\"create_time\":\"2021-02-20T05:27:36Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/8P2383463P998404G\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/www.sandbox.paypal.com\\/checkoutnow?token=8P2383463P998404G\",\"rel\":\"approve\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/8P2383463P998404G\",\"rel\":\"update\",\"method\":\"PATCH\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/8P2383463P998404G\\/capture\",\"rel\":\"capture\",\"method\":\"POST\"}]},\"headers\":{\"\":\"\",\"Cache-Control\":\"max-age=0, no-cache, no-store, must-revalidate\",\"Content-Length\":\"753\",\"Content-Type\":\"application\\/json\",\"Date\":\"Sat, 20 Feb 2021 05\",\"Paypal-Debug-Id\":\"e38595765c549\"}}",
"created_at": "2021-02-20T05:27:37.000000Z",
"updated_at": "2021-02-20T05:27:37.000000Z"
}
]
}
}

# 5. Listner API for orders:

Description : This is a listner api, which listens for event triggers for orders, as soon as any of these event triggers:

-   When a buyer approves an order i.e when someone clicks on the link created by create payment api and start's initiating the payment->
    CHECKOUT.ORDER.APPROVED

-   When Paypal Captures an order i.e when the payment is either completed, denied or pending state ->
    PAYMENT.CAPTURE.COMPLETED,
    PAYMENT.CAPTURE.DENIED,
    PAYMENT.CAPTURE.PENDING

-   When a payment is refunded by the merchant -> PAYMENT.CAPTURE.REFUNDED

Based on above triggers, the listener api updates the status of the orders.

path: {{base_url}}/{{api_prefix}}/listner/orders

request body : this request body is sent by the paypal

for eg. {"headers":{"host":"enomte1wtiv87su.m.pipedream.net","x-amzn-trace-id":"Root=1-602cd6ad-648952d93adaa5125b83a773","content-length":"1628","accept":"_/_","paypal-transmission-id":"e0f9edb0-70fb-11eb-8d0d-c15a23748878","paypal-transmission-time":"2021-02-17T08:41:07Z","paypal-transmission-sig":"Wk0b4eFoJ5hYWSGI66SsTZrqdp3Kql2YzKewVkQWrgtjAbXr63t9rtv2e5Xysx4YKIiA/6Jv5tBq6Q2/isX0vj8/awvYYYYcOc3dsnt9P9TuKNQR5AMd7zwlaSJVKVxECoMD1s1BAjtRQj1MYD+6Zvi9RtIdlKw2FCbuyO+JzVYh+Drdvn4jRsD1a9IyufRNLLY9ymuHI8CCq50tlAot7CridP7k1rYLtMhhhVYIJU8VekazGscu+DjNOADLFtfRZ7ik1Ma+CSZDQE+bgtVhD4/ENGYBw744OVDwhsLkiKjSpx+8ujpeArqj6MwSaDLX65ShKyh5G7mfkjW9PmtXmg==","paypal-auth-version":"v2","paypal-cert-url":"https://api.sandbox.paypal.com/v1/notifications/certs/CERT-360caa42-fca2a594-1d93a270","paypal-auth-algo":"SHA256withRSA","content-type":"application/json","user-agent":"PayPal/AUHD-214.0-55012593","correlation-id":"48f2bd2f2424c","cal_poolstack":"amqunphttpdeliveryd:UNPHTTPDELIVERY*CalThreadId=0*TopLevelTxnStartTime=177af2694ae*Host=slcsbamqunphttpdeliveryd5117","client_pid":"22974"},"body":{"id":"WH-38T23114G8344784G-0DV77300YM0470134","event_version":"1.0","create_time":"2021-02-17T08:41:04.342Z","resource_type":"checkout-order","resource_version":"2.0","event_type":"CHECKOUT.ORDER.APPROVED","summary":"An order has been approved by buyer","resource":{"create_time":"2021-02-17T08:39:25Z","purchase_units":[{"reference_id":"test_ref_id1","amount":{"currency_code":"INR","value":"120.25"},"payee":{"email_address":"sb-8ndyy5108314@business.example.com","merchant_id":"JRABHS4FG63GW"},"shipping":{"name":{"full_name":"John Doe"},"address":{"address_line_1":"Flat no. 507 Wing A Raheja Residency","address_line_2":"Film City Road","admin_area_2":"Mumbai","admin_area_1":"Maharashtra","postal_code":"400097","country_code":"IN"}}}],"links":[{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/3LY66504BT263611G","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/3LY66504BT263611G","rel":"update","method":"PATCH"},{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/3LY66504BT263611G/capture","rel":"capture","method":"POST"}],"id":"3P70193256757541W","intent":"CAPTURE","payer":{"name":{"given_name":"John","surname":"Doe"},"email_address":"sb-7j8uy5108762@personal.example.com","payer_id":"GED5L2T99B84A","address":{"country_code":"IN"}},"status":"APPROVED"},"links":[{"href":"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-38T23114G8344784G-0DV77300YM0470134","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-38T23114G8344784G-0DV77300YM0470134/resend","rel":"resend","method":"POST"}]},"inferred_body_type":"JSON","method":"POST","url":"https://enomte1wtiv87su.m.pipedream.net/","client_ip":"173.0.82.126","query":{}}

response body: {
"errors": false,
"success": true,
"message": "successfully logged and updated Orders"
}

# Create Webhooks

Description: This is the api to create webhooks.
It requires an hosted "url" which will recieve the event's trigger response and an array of "event types" which are needed to be triggered

path : {{base_url}}/{{api_prefix}}/webhook

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

-   IMPORTANT NOTE: Here I have passed only one url for testing purpose

-   But in practice we will run this API twice one for Orders and other for Subscriptions with respective events and listener urls.

-   we have created two different listeners for respective status updations

# Subscription's API

# 1. Create Product
   description : This API is used to create a product, product is required to be created first to define a plan on it

for more details on creating a [product](https://developer.paypal.com/docs/api/catalog-products/v1/#products).

path: {{base_url}}/{{api_prefix}}/products

request body : {"data":{
"name": "Consultation Minutes",
"description": "Starter Plan for newcomers, suitable for small changes.",
"type": "DIGITAL",
"category": "SOFTWARE"
}}

response body : {
"errors": false,
"success": true,
"message": 201,
"data": {
"product_id": "PROD-1AN91753D1437600Y",
"meta": {
"statusCode": 201,
"result": {
"id": "PROD-1AN91753D1437600Y",
"name": "Consultation Minutes",
"description": "Starter Plan for newcomers, suitable for small changes.",
"type": "DIGITAL",
"category": "SOFTWARE",
"create_time": "2021-02-20T05:48:24Z",
"update_time": "2021-02-20T05:48:24Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/catalogs/products/PROD-1AN91753D1437600Y",
"rel": "self",
"method": "GET"
},
{
"href": "https://api.sandbox.paypal.com/v1/catalogs/products/PROD-1AN91753D1437600Y",
"rel": "edit",
"method": "PATCH"
}
]
},
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Content-Length": "486",
"Content-Type": "application/json",
"Date": "Sat, 20 Feb 2021 05",
"Paypal-Debug-Id": "a66592f520f66"
}
}
}
}

# 2. Create Plan

description: This API is used to create a plan. We have to have a product defined before executing this api.

for more details on creating a [plan](https://developer.paypal.com/docs/api/subscriptions/v1/#plans_create).

path : {{base_url}}/{{api_prefix}}/plans

request body : { "data" : {
"product_id": "PROD-1AN91753D1437600Y",
"name": "Basic",
"description": "Starter Plan for newcomers, suitable for small changes.",
"status": "ACTIVE",
"billing_cycles": [
{
"frequency": {
"interval_unit": "MONTH",
"interval_count": 1
},
"tenure_type": "TRIAL",
"sequence": 1,
"total_cycles": 2,
"pricing_scheme": {
"fixed_price": {
"value": "1000",
"currency_code": "USD"
}
}
},
{
"frequency": {
"interval_unit": "MONTH",
"interval_count": 1
},
"tenure_type": "TRIAL",
"sequence": 2,
"total_cycles": 3,
"pricing_scheme": {
"fixed_price": {
"value": "6",
"currency_code": "USD"
}
}
},
{
"frequency": {
"interval_unit": "MONTH",
"interval_count": 1
},
"tenure_type": "REGULAR",
"sequence": 3,
"total_cycles": 12,
"pricing_scheme": {
"fixed_price": {
"value": "10",
"currency_code": "USD"
}
}
}
],
"payment_preferences": {
"auto_bill_outstanding": true,
"setup_fee": {
"value": "10",
"currency_code": "USD"
},
"setup_fee_failure_action": "CONTINUE",
"payment_failure_threshold": 3
},
"taxes": {
"percentage": "10",
"inclusive": false
}
}}

response body :{
"errors": false,
"success": true,
"message": "ACTIVE",
"data": {
"plan_id": "P-320076624P506394NMAYKF4A",
"meta": {
"statusCode": 201,
"result": {
"id": "P-320076624P506394NMAYKF4A",
"product_id": "PROD-1AN91753D1437600Y",
"name": "Basic",
"status": "ACTIVE",
"description": "Starter Plan for newcomers, suitable for small changes.",
"usage_type": "LICENSED",
"billing_cycles": [
{
"pricing_scheme": {
"version": 1,
"fixed_price": {
"currency_code": "USD",
"value": "1000.0"
},
"create_time": "2021-02-20T05:49:36Z",
"update_time": "2021-02-20T05:49:36Z"
},
"frequency": {
"interval_unit": "MONTH",
"interval_count": 1
},
"tenure_type": "TRIAL",
"sequence": 1,
"total_cycles": 2
},
{
"pricing_scheme": {
"version": 1,
"fixed_price": {
"currency_code": "USD",
"value": "6.0"
},
"create_time": "2021-02-20T05:49:36Z",
"update_time": "2021-02-20T05:49:36Z"
},
"frequency": {
"interval_unit": "MONTH",
"interval_count": 1
},
"tenure_type": "TRIAL",
"sequence": 2,
"total_cycles": 3
},
{
"pricing_scheme": {
"version": 1,
"fixed_price": {
"currency_code": "USD",
"value": "10.0"
},
"create_time": "2021-02-20T05:49:36Z",
"update_time": "2021-02-20T05:49:36Z"
},
"frequency": {
"interval_unit": "MONTH",
"interval_count": 1
},
"tenure_type": "REGULAR",
"sequence": 3,
"total_cycles": 12
}
],
"payment_preferences": {
"service_type": "PREPAID",
"auto_bill_outstanding": true,
"setup_fee": {
"currency_code": "USD",
"value": "10.0"
},
"setup_fee_failure_action": "CONTINUE",
"payment_failure_threshold": 3
},
"taxes": {
"percentage": "10.0",
"inclusive": false
},
"quantity_supported": false,
"create_time": "2021-02-20T05:49:36Z",
"update_time": "2021-02-20T05:49:36Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-320076624P506394NMAYKF4A",
"rel": "self",
"method": "GET",
"encType": "application/json"
},
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-320076624P506394NMAYKF4A",
"rel": "edit",
"method": "PATCH",
"encType": "application/json"
},
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-320076624P506394NMAYKF4A/deactivate",
"rel": "self",
"method": "POST",
"encType": "application/json"
}
]
},
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Content-Length": "1831",
"Content-Type": "application/json",
"Date": "Sat, 20 Feb 2021 05",
"Paypal-Debug-Id": "80cebac3886a3"
}
}
}
}

# 3. Get All Plan

description : get all plans created by you

path : {{base_url}}/{{api_prefix}}/plans

type : GET {rest all are post requests hence mentioned here}

request body : null

response body :{
"errors": false,
"success": true,
"message": "Fetched All Plans",
"data": {
"status": {
"statusCode": 200,
"result": {
"plans": [
{
"id": "P-7BN037656N115813RMAWQODI",
"name": "Basic",
"status": "ACTIVE",
"description": "Starter Plan for newcomers, suitable for small changes.",
"usage_type": "LICENSED",
"create_time": "2021-02-17T12:07:41Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-7BN037656N115813RMAWQODI",
"rel": "self",
"method": "GET",
"encType": "application/json"
}
]
},
{
"id": "P-49W0221732666702DMAXADXI",
"name": "Basic",
"status": "ACTIVE",
"description": "Starter Plan for newcomers, suitable for small changes.",
"usage_type": "LICENSED",
"create_time": "2021-02-18T05:57:49Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-49W0221732666702DMAXADXI",
"rel": "self",
"method": "GET",
"encType": "application/json"
}
]
},
{
"id": "P-54784117B2433041XMAXA4KQ",
"name": "Basic",
"status": "ACTIVE",
"description": "Starter Plan for newcomers, suitable for small changes.",
"usage_type": "LICENSED",
"create_time": "2021-02-18T06:50:18Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-54784117B2433041XMAXA4KQ",
"rel": "self",
"method": "GET",
"encType": "application/json"
}
]
},
{
"id": "P-320076624P506394NMAYKF4A",
"name": "Basic",
"status": "ACTIVE",
"description": "Starter Plan for newcomers, suitable for small changes.",
"usage_type": "LICENSED",
"create_time": "2021-02-20T05:49:36Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-320076624P506394NMAYKF4A",
"rel": "self",
"method": "GET",
"encType": "application/json"
}
]
}
],
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans?page_size=10&page=1",
"rel": "self",
"method": "GET",
"encType": "application/json"
}
]
},
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Content-Length": "1577",
"Content-Type": "application/json",
"Date": "Sat, 20 Feb 2021 05",
"Paypal-Debug-Id": "f4646447a5e6"
}
},
"meta": {
"statusCode": 200,
"result": {
"plans": [
{
"id": "P-7BN037656N115813RMAWQODI",
"name": "Basic",
"status": "ACTIVE",
"description": "Starter Plan for newcomers, suitable for small changes.",
"usage_type": "LICENSED",
"create_time": "2021-02-17T12:07:41Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-7BN037656N115813RMAWQODI",
"rel": "self",
"method": "GET",
"encType": "application/json"
}
]
},
{
"id": "P-49W0221732666702DMAXADXI",
"name": "Basic",
"status": "ACTIVE",
"description": "Starter Plan for newcomers, suitable for small changes.",
"usage_type": "LICENSED",
"create_time": "2021-02-18T05:57:49Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-49W0221732666702DMAXADXI",
"rel": "self",
"method": "GET",
"encType": "application/json"
}
]
},
{
"id": "P-54784117B2433041XMAXA4KQ",
"name": "Basic",
"status": "ACTIVE",
"description": "Starter Plan for newcomers, suitable for small changes.",
"usage_type": "LICENSED",
"create_time": "2021-02-18T06:50:18Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-54784117B2433041XMAXA4KQ",
"rel": "self",
"method": "GET",
"encType": "application/json"
}
]
},
{
"id": "P-320076624P506394NMAYKF4A",
"name": "Basic",
"status": "ACTIVE",
"description": "Starter Plan for newcomers, suitable for small changes.",
"usage_type": "LICENSED",
"create_time": "2021-02-20T05:49:36Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-320076624P506394NMAYKF4A",
"rel": "self",
"method": "GET",
"encType": "application/json"
}
]
}
],
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans?page_size=10&page=1",
"rel": "self",
"method": "GET",
"encType": "application/json"
}
]
},
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Content-Length": "1577",
"Content-Type": "application/json",
"Date": "Sat, 20 Feb 2021 05",
"Paypal-Debug-Id": "f4646447a5e6"
}
}
}
}

# 4.Get Plan By Id

description : get plan details by "plan_id"

path :{{base_url}}/{{api_prefix}}/plan/details

request body: {
"plan_id":"P-320076624P506394NMAYKF4A"
}

response body: {
"errors": false,
"success": true,
"message": "Fetched Plan detail",
"data": {
"status": "ACTIVE",
"meta": {
"statusCode": 200,
"result": {
"id": "P-320076624P506394NMAYKF4A",
"product_id": "PROD-1AN91753D1437600Y",
"name": "Basic",
"status": "ACTIVE",
"description": "Starter Plan for newcomers, suitable for small changes.",
"usage_type": "LICENSED",
"billing_cycles": [
{
"pricing_scheme": {
"version": 1,
"fixed_price": {
"currency_code": "USD",
"value": "1000.0"
},
"create_time": "2021-02-20T05:49:36Z",
"update_time": "2021-02-20T05:49:36Z"
},
"frequency": {
"interval_unit": "MONTH",
"interval_count": 1
},
"tenure_type": "TRIAL",
"sequence": 1,
"total_cycles": 2
},
{
"pricing_scheme": {
"version": 1,
"fixed_price": {
"currency_code": "USD",
"value": "6.0"
},
"create_time": "2021-02-20T05:49:36Z",
"update_time": "2021-02-20T05:49:36Z"
},
"frequency": {
"interval_unit": "MONTH",
"interval_count": 1
},
"tenure_type": "TRIAL",
"sequence": 2,
"total_cycles": 3
},
{
"pricing_scheme": {
"version": 1,
"fixed_price": {
"currency_code": "USD",
"value": "10.0"
},
"create_time": "2021-02-20T05:49:36Z",
"update_time": "2021-02-20T05:49:36Z"
},
"frequency": {
"interval_unit": "MONTH",
"interval_count": 1
},
"tenure_type": "REGULAR",
"sequence": 3,
"total_cycles": 12
}
],
"payment_preferences": {
"service_type": "PREPAID",
"auto_bill_outstanding": true,
"setup_fee": {
"currency_code": "USD",
"value": "10.0"
},
"setup_fee_failure_action": "CONTINUE",
"payment_failure_threshold": 3
},
"taxes": {
"percentage": "10.0",
"inclusive": false
},
"quantity_supported": false,
"create_time": "2021-02-20T05:49:36Z",
"update_time": "2021-02-20T05:49:36Z",
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-320076624P506394NMAYKF4A",
"rel": "self",
"method": "GET",
"encType": "application/json"
},
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-320076624P506394NMAYKF4A",
"rel": "edit",
"method": "PATCH",
"encType": "application/json"
},
{
"href": "https://api.sandbox.paypal.com/v1/billing/plans/P-320076624P506394NMAYKF4A/deactivate",
"rel": "self",
"method": "POST",
"encType": "application/json"
}
]
},
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Content-Length": "1831",
"Content-Type": "application/json",
"Date": "Sat, 20 Feb 2021 05",
"Paypal-Debug-Id": "efb7b029f9a04"
}
}
}
}

# 5. Create Subscription:

desription : Create a subscription by passing "plan_id" and objects of details of subscription

for more details on creating a [subscription](https://developer.paypal.com/docs/api/subscriptions/v1/#subscriptions_create).

request body: {
"data" : {
"plan_id": "P-320076624P506394NMAYKF4A",
"shipping_amount": {
"currency_code": "USD",
"value": "10.00"
},
"subscriber": {
"name": {
"given_name": "John",
"surname": "Doe"
},
"email_address": "customer@example.com",
"shipping_address": {
"name": {
"full_name": "John Doe"
},
"address": {
"address_line_1": "2211 N First Street",
"address_line_2": "Building 17",
"admin_area_2": "San Jose",
"admin_area_1": "CA",
"postal_code": "95131",
"country_code": "US"
}
}
},
"application_context": {
"brand_name": "walmart",
"locale": "en-US",
"shipping_preference": "SET_PROVIDED_ADDRESS",
"user_action": "SUBSCRIBE_NOW",
"payment_method": {
"payer_selected": "PAYPAL",
"payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
},
"return_url": "https://example.com/returnUrl",
"cancel_url": "https://example.com/cancelUrl"
}
}
}

response body: {
"errors": false,
"success": true,
"message": "APPROVAL_PENDING",
"data": {
"subscription_id": "I-2FBAXW3SJMBB",
"meta": {
"statusCode": 201,
"result": {
"status": "APPROVAL_PENDING",
"status_update_time": "2021-02-18T21:42:05Z",
"id": "I-2FBAXW3SJMBB",
"plan_id": "P-54784117B2433041XMAXA4KQ",
"start_time": "2021-02-18T21:42:05Z",
"quantity": "1",
"shipping_amount": {
"currency_code": "USD",
"value": "10.0"
},
"subscriber": {
"email_address": "customer@example.com",
"name": {
"given_name": "John",
"surname": "Doe"
},
"shipping_address": {
"name": {
"full_name": "John Doe"
},
"address": {
"address_line_1": "2211 N First Street",
"address_line_2": "Building 17",
"admin_area_2": "San Jose",
"admin_area_1": "CA",
"postal_code": "95131",
"country_code": "US"
}
}
},
"create_time": "2021-02-18T21:42:05Z",
"plan_overridden": false,
"links": [
{
"href": "https://www.sandbox.paypal.com/webapps/billing/subscriptions?ba_token=BA-21M85110KL560442V",
"rel": "approve",
"method": "GET"
},
{
"href": "https://api.sandbox.paypal.com/v1/billing/subscriptions/I-2FBAXW3SJMBB",
"rel": "edit",
"method": "PATCH"
},
{
"href": "https://api.sandbox.paypal.com/v1/billing/subscriptions/I-2FBAXW3SJMBB",
"rel": "self",
"method": "GET"
}
]
},
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Content-Length": "990",
"Content-Type": "application/json",
"Date": "Thu, 18 Feb 2021 21",
"Paypal-Debug-Id": "7b7c1558daa6"
}
}
}
}

# 6. Get Subscription Details by Id

description : get subscription plan by subcription id

path : {{base_url}}/{{api_prefix}}/subscription/details

request body: {
"subscription_id":"I-2FBAXW3SJMBB"
}

response body: {
"errors": false,
"success": true,
"message": "Fetched Subscription details",
"data": {
"status": "CANCELLED",
"meta": {
"statusCode": 200,
"result": {
"status": "CANCELLED",
"status_change_note": "Testing",
"status_update_time": "2021-02-18T21:48:45Z",
"id": "I-2FBAXW3SJMBB",
"plan_id": "P-54784117B2433041XMAXA4KQ",
"start_time": "2021-02-18T21:42:05Z",
"quantity": "1",
"shipping_amount": {
"currency_code": "USD",
"value": "10.0"
},
"subscriber": {
"email_address": "sb-flr0k5150019@personal.example.com",
"payer_id": "2GRYK9AY6RNE4",
"name": {
"given_name": "John",
"surname": "Doe"
},
"shipping_address": {
"name": {
"full_name": "John Doe"
},
"address": {
"address_line_1": "2211 N First Street",
"address_line_2": "Building 17",
"admin_area_2": "San Jose",
"admin_area_1": "CA",
"postal_code": "95131",
"country_code": "US"
}
}
},
"billing_info": {
"outstanding_balance": {
"currency_code": "USD",
"value": "0.0"
},
"cycle_executions": [
{
"tenure_type": "TRIAL",
"sequence": 1,
"cycles_completed": 0,
"cycles_remaining": 2,
"current_pricing_scheme_version": 1,
"total_cycles": 2
},
{
"tenure_type": "TRIAL",
"sequence": 2,
"cycles_completed": 0,
"cycles_remaining": 3,
"current_pricing_scheme_version": 1,
"total_cycles": 3
},
{
"tenure_type": "REGULAR",
"sequence": 3,
"cycles_completed": 0,
"cycles_remaining": 12,
"current_pricing_scheme_version": 1,
"total_cycles": 12
}
],
"last_payment": {
"amount": {
"currency_code": "USD",
"value": "11.0"
},
"time": "2021-02-18T21:46:54Z"
},
"failed_payments_count": 0
},
"create_time": "2021-02-18T21:42:05Z",
"update_time": "2021-02-18T21:48:45Z",
"plan_overridden": false,
"links": [
{
"href": "https://api.sandbox.paypal.com/v1/billing/subscriptions/I-2FBAXW3SJMBB",
"rel": "self",
"method": "GET"
}
]
},
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Content-Length": "1465",
"Content-Type": "application/json",
"Date": "Sat, 20 Feb 2021 05",
"Paypal-Debug-Id": "adf7cb320c89d"
}
}
}
}

# 7. Cancel Subscription by id

description : cancel subscription plan by passing subscription id and reason for
cancellation

path : {{base_url}}/{{api_prefix}}/subscription/cancel

request body: {
"subscription_id":"I-2FBAXW3SJMBB",
"data":{"reason":"Testing"}
}

response body: {
"errors": false,
"success": true,
"message": "Subscription Cancelled Successfully",
"data": {
"status": {
"statusCode": 204,
"result": null,
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Date": "Thu, 18 Feb 2021 21",
"Paypal-Debug-Id": "9549b3b0dda1b"
}
},
"meta": {
"statusCode": 204,
"result": null,
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Date": "Thu, 18 Feb 2021 21",
"Paypal-Debug-Id": "9549b3b0dda1b"
}
}
}
}

# 8. Update Subscription by id

description: Update Subscription terms by passing subscription id and update object array.

for more details on updating a [subscription](https://developer.paypal.com/docs/api/subscriptions/v1/#subscriptions_patch).

path:
{{base_url}}/{{api_prefix}}/subscription/update

request body :{
"subscription_id":"I-2FBAXW3SJMBB",
"data":[{
"op": "replace",
"path": "/plan/billing_cycles/@sequence==1/pricing_scheme/fixed_price",
"value": {
"currency_code": "USD",
"value": "50.00"
}
}]
}
response body :{
"errors": false,
"success": true,
"message": "Subscription Updated Successfully",
"data": {
"status": {
"statusCode": 204,
"result": null,
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Date": "Thu, 18 Feb 2021 21",
"Paypal-Debug-Id": "3aac9642522c"
}
},
"meta": {
"statusCode": 204,
"result": null,
"headers": {
"": "",
"Cache-Control": "max-age=0, no-cache, no-store, must-revalidate",
"Date": "Thu, 18 Feb 2021 21",
"Paypal-Debug-Id": "3aac9642522c"
}
}
}
}

# 9. Listener Api for subscription

Description : This is a listner api, which listens for event triggers for subsription, as soon as any of these event triggers:

-   When a merchant update's the subscription terms->
    BILLING.SUBSCRIPTION.UPDATED"

-   When a merchant suspends the subscription ->
    BILLING.SUBSCRIPTION.SUSPENDED

-   When a billing agreement is cancelled -> BILLING.SUBSCRIPTION.CANCELLED

-   When a billing agreement is reactivated after suspension -> BILLING.SUBSCRIPTION.ACTIVATED

-   When a payment of subscription is completed -> PAYMENT.SALE.COMPLETED

Based on above triggers, the listener api updates the status of the orders.

path : {{base_url}}/{{api_prefix}}/listner/subscriptions

request body : this request body is sent by the paypal

for eg. {"headers":{"host":"ent241d41804b.m.pipedream.net","x-amzn-trace-id":"Root=1-602ee0fb-7adeabf47b8eaa304e7dadaf","content-length":"2057","accept":"_/_","paypal-transmission-id":"30312dc0-7233-11eb-921d-51214e1b4ea4","paypal-transmission-time":"2021-02-18T21:49:34Z","paypal-transmission-sig":"OopB3kxBZ2ietpQwaRzOgsLASHvUvixh29Ia54ezvmgT4VUwAouL4lpl+32ccxqmfT/DM59zClQHzl0xA0oYolm8T8X2BTeU5OD5NkmledEsmd2bXMpuKcUhlbZu364cnXSoa+FMsM79QcIVtZGFgOfYLBREp8wgingVxejy7yEgQVl13Jftcz7LAkgV6V4yuNI15tunxlx7C+PG4sjDYw8BCjVT3k7DhBxkTa/D6+GsYEbnJcq4dsmbDYSC2CSqR0lWK59Uyxo4iDovu4TXvXciQAL2sZJdrcgpV8g/y77y1u+7RSAaP1ygoWJSzOd5sPnM++46Bqd9JtHuU9BXaA==","paypal-auth-version":"v2","paypal-cert-url":"https://api.sandbox.paypal.com/v1/notifications/certs/CERT-360caa42-fca2a594-1d93a270","paypal-auth-algo":"SHA256withRSA","content-type":"application/json","user-agent":"PayPal/AUHD-214.0-55012593","correlation-id":"9549b3b0dda1b","cal_poolstack":"amqunphttpdeliveryd:UNPHTTPDELIVERY*CalThreadId=0*TopLevelTxnStartTime=177b71ed66c*Host=slcsbamqunphttpdeliveryd5114","client_pid":"31030"},"body":{"id":"WH-0RL642254C974970S-65P736108L5111220","event_version":"1.0","create_time":"2021-02-18T21:49:07.585Z","resource_type":"subscription","resource_version":"2.0","event_type":"BILLING.SUBSCRIPTION.CANCELLED","summary":"Subscription cancelled","resource":{"status_change_note":"Testing","quantity":"1","subscriber":{"name":{"given_name":"John","surname":"Doe"},"email_address":"sb-flr0k5150019@personal.example.com","payer_id":"2GRYK9AY6RNE4","shipping_address":{"name":{"full_name":"John Doe"},"address":{"address_line_1":"2211 N First Street","address_line_2":"Building 17","admin_area_2":"San Jose","admin_area_1":"CA","postal_code":"95131","country_code":"US"}}},"create_time":"2021-02-18T21:42:05Z","plan_overridden":false,"shipping_amount":{"currency_code":"USD","value":"10.0"},"start_time":"2021-02-18T21:42:05Z","update_time":"2021-02-18T21:48:45Z","billing_info":{"outstanding_balance":{"currency_code":"USD","value":"0.0"},"cycle_executions":[{"tenure_type":"TRIAL","sequence":1,"cycles_completed":0,"cycles_remaining":2,"current_pricing_scheme_version":1,"total_cycles":2},{"tenure_type":"TRIAL","sequence":2,"cycles_completed":0,"cycles_remaining":3,"current_pricing_scheme_version":1,"total_cycles":3},{"tenure_type":"REGULAR","sequence":3,"cycles_completed":0,"cycles_remaining":12,"current_pricing_scheme_version":1,"total_cycles":12}],"last_payment":{"amount":{"currency_code":"USD","value":"11.0"},"time":"2021-02-18T21:46:54Z"},"failed_payments_count":0},"links":[{"href":"https://api.sandbox.paypal.com/v1/billing/subscriptions/I-2FBAXW3SJMBB","rel":"self","method":"GET","encType":"application/json"}],"id":"I-2FBAXW3SJMBB","plan_id":"P-54784117B2433041XMAXA4KQ","status":"CANCELLED","status_update_time":"2021-02-18T21:48:45Z"},"links":[{"href":"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-0RL642254C974970S-65P736108L5111220","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-0RL642254C974970S-65P736108L5111220/resend","rel":"resend","method":"POST"}]},"inferred_body_type":"JSON","method":"POST","url":"https://ent241d41804b.m.pipedream.net/","client_ip":"173.0.82.126","query":{}}

response body: {
"errors": false,
"success": true,
"message": "successfully logged and updated Subscription"
}

# COUPONS

## Coupons : Coupons are not available inbuilt by paypal
