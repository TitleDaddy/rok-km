<?php

namespace App\Domain\Commander\Exception;

use App\Common\Exception\AppException;
use Symfony\Component\HttpFoundation\Response;

class CommanderAlreadyExistsException extends AppException
{
    public function __construct(string $name)
    {
        $this->message = "A Commander with the name {$name} already exists.";
        $this->code = Response::HTTP_CONFLICT;
    }
}
