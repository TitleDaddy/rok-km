<?php

namespace App\Common\Validation;

use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validation;

class ValidationHelper
{
    public static function validateObject(array $data, Collection $constraint): ?array
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($data, $constraint, []);
        $errors = [];

        foreach ($violations as $violation) {
            /** @var ConstraintViolationInterface $violation */
            $field = (new PropertyPath($violation->getPropertyPath()))->getElement(0);
            $message = $violation->getMessage();
            $field = ucfirst($field);
            $errors[] = "{$field}: {$message}";
        }

        if (! count($errors)) {
            return null;
        }

        return $errors;
    }
}
