<?php

namespace App\Domain\Kingdom\Exception;

use App\Common\Exception\AppException;
use Symfony\Component\HttpFoundation\Response;

class KingdomAlreadyExistsException extends AppException
{
    public function __construct(string $number)
    {
        $this->message = "Kingdom {$number} Already exists.";
        $this->code = Response::HTTP_BAD_REQUEST;
    }
}
