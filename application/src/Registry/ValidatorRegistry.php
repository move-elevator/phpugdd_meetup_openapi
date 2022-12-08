<?php

declare(strict_types=1);

namespace App\Registry;

use App\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;

final class ValidatorRegistry implements ValidatorInterface
{
    private array $validators;

    public function __construct(ValidatorInterface ...$validators)
    {
        $this->validators = $validators;
    }

    public function validate(Request $request): void
    {
        foreach ($this->validators as $validator) {
            $validator->validate($request);
        }
    }
}
