<?php

namespace App\Domain\Governor\Exception;

use App\Common\Exception\AppException;
use Symfony\Component\HttpFoundation\Response;

class GovernorIdAlreadyExistsException extends AppException
{
    public function __construct(string $gameId)
    {
        $this->message = "Governor {$gameId} Already exists.";
        $this->code = Response::HTTP_BAD_REQUEST;
    }
}
