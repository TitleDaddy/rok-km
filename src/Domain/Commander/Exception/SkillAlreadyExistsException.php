<?php

namespace App\Domain\Commander\Exception;

use App\Common\Exception\AppException;
use Symfony\Component\HttpFoundation\Response;

class SkillAlreadyExistsException extends AppException
{
    public function __construct(string $name)
    {
        $this->message = "A Skill with the name {$name} already exists.";
        $this->code = Response::HTTP_CONFLICT;
    }
}
