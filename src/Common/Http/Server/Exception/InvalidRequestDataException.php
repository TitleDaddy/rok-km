<?php

namespace App\Common\Http\Server\Exception;

use App\Common\Exception\AppException;

class InvalidRequestDataException extends AppException
{
    public const STATUS_CODE = 400;

    public function __construct(string $error, int $code = self::STATUS_CODE)
    {
        parent::__construct($error, $code);
    }
}
