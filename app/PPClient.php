<?php

namespace App;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PPClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment()
    {
        $clientId = getenv("PAYPAL_CLIENT_ID") ?: "AV--tXCNVtOQ-TenkEs8PxbKN3j80plkcEFY_9JrlRRyz5IlHdGl6WlCjyMB69DRmarvjTiym3HD8KAl";
        $clientSecret = getenv("PAYPAL_CLIENT_SECRET") ?: "EL3Q7vbzFc1hbBp7IyMIEaw30T1itMI417O5PdLlOAs2EGDBr6wG2d9ZhUhw55SVvUQP6lfYqoChg9E3";
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}
