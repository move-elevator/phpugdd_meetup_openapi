<?php

declare(strict_types = 1);

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;
use InvalidArgumentException;

/**
 * Example for custom validator
 */
class UserUniqueInZip implements ValidatorInterface
{
    public function validate(Request $request): void
    {
        $requestContent = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        /** @todo Add validate if user is unique in zip code area */

        if('01099' === $requestContent['address']['zip']) {
            throw new InvalidArgumentException('User is not unique in zip code area', 1670356406);
        }
    }
}
