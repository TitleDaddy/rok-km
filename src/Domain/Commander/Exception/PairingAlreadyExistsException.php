<?php

namespace App\Domain\Commander\Exception;

use App\Common\Exception\AppException;
use Symfony\Component\HttpFoundation\Response;

class PairingAlreadyExistsException extends AppException
{
    public function __construct(string $primaryCommanderName, string $secondaryCommanderName)
    {
        $this->message = "A Pairing with primary commander {$primaryCommanderName} and secondary {$secondaryCommanderName} already exists.";
        $this->code = Response::HTTP_CONFLICT;
    }
}
