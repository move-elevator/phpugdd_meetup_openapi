<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface ValidatorInterface
{
    public function validate(Request $request): void;
}
