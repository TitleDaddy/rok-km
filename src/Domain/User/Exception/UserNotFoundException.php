<?php

namespace App\Domain\User\Exception;

use App\Common\Exception\AppException;

class UserNotFoundException extends AppException
{
    public const STATUS_CODE = 400;

    public function __construct(string $userId)
    {
        parent::__construct("Could not find User {$userId}", self::STATUS_CODE);
    }
}
