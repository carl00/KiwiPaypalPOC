<?php

namespace App;
use PayPalHttp\HttpRequest;

class WebhookCreateRequest extends HttpRequest
{
    function __construct()
    {
        parent::__construct("/v1/notifications/webhooks", "POST");
        $this->headers["Content-Type"] = "application/json";
    }
}
