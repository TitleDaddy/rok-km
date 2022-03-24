<?php

namespace App\Domain\ROK\Exception;

use App\Common\Exception\AppException;

class UserProfileDoesntExistException extends AppException
{
    public function __construct(string $gameId)
    {
        $this->message = "A Governor with the ID {$gameId} Doesnt Exist";
    }
}
