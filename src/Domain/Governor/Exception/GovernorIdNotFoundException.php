<?php

namespace App\Domain\Governor\Exception;

use App\Common\Exception\AppException;
use Symfony\Component\HttpFoundation\Response;

class GovernorIdNotFoundException extends AppException
{
    public function __construct(string $id)
    {
        $this->message = "A Governor with the ID {$id} can't be found.";
        $this->code = Response::HTTP_NOT_FOUND;
    }
}
