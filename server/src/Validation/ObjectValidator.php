<?php

namespace App\Validation;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ObjectValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function getValidationErrors(object $object): array
    {
        /** @var ConstraintViolationList $errors */
        $errors = $this->validator->validate($object);

        if (count($errors) === 0) {
            return [];
        }

        return array_map(static fn (ConstraintViolation $error) =>
            [
                'fieldPath' => $error->getPropertyPath(),
                'errorMessage' => $error->getMessage(),
                'value' => $error->getInvalidValue()
            ],
            $errors->getIterator()->getArrayCopy()
        );
    }
}
