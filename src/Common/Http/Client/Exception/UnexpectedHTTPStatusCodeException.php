<?php

namespace App\Common\Http\Client\Exception;

use Exception;

class UnexpectedHTTPStatusCodeException extends Exception
{
    public function __construct(array $statusCodesExpected, int $statusCodeReceived)
    {
        $expected = implode(', ', $statusCodesExpected);
        $message = "Invalid Status Code Received. Expected one of ({$expected}). Received {$statusCodeReceived}";
        parent::__construct($message);
    }
}
