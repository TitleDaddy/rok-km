<?php

namespace App\Domain\Commander\Exception;

use App\Common\Exception\AppException;
use Symfony\Component\HttpFoundation\Response;

class InvalidSkillIndexException extends AppException
{
    public function __construct(int $index)
    {
        $this->message = "Skill Index must be between 1 and 5. {$index} Given.";
        $this->code = Response::HTTP_BAD_REQUEST;
    }
}
