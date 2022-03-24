<?php

namespace App\Domain\Commander\Exception;

use App\Common\Exception\AppException;
use Symfony\Component\HttpFoundation\Response;

class SkillNotFoundException extends AppException
{
    public function __construct(string $name)
    {
        $this->message = "A Skill with the name {$name} can't be found.";
        $this->code = Response::HTTP_NOT_FOUND;
    }
}
