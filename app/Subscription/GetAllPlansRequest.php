<?php

namespace App\Subscription;

use PayPalHttp\HttpRequest;

class GetAllPlansRequest extends HttpRequest
{
    function __construct()
    {
        parent::__construct("/v1/billing/plans", "GET");
        $this->headers["Content-Type"] = "application/json";
    }
}