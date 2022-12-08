<?php

declare(strict_types=1);

namespace App\Exception;

use League\OpenAPIValidation\Schema\Exception\KeywordMismatch;
use Throwable;
use InvalidArgumentException;

class SchemaValidatorException extends InvalidArgumentException
{
    private const PATTERNS = [
        'required' => 'Data for "%1$s" is missing',
        'pattern' => 'Data %2$s for "%1$s" is invalid for pattern',
        'default' => 'Data for "%1$s" is invalid',
    ];

    public static function invalidRequestData(?Throwable $throwable): self
    {
        if (false === $throwable instanceof KeywordMismatch) {
            return self::createFallbackException($throwable);
        }

        $value = null;
        $field = null;
        $keyword = $throwable->keyword();

        if (true === is_scalar($throwable->data())) {
            $value = (string)$throwable->data();
        }

        if (null !== $throwable->dataBreadCrumb()) {
            $chain = $throwable->dataBreadCrumb()->buildChain();

            $field = implode(' -> ', $chain);
        }

        if (null === $field) {
            return self::createFallbackException($throwable);
        }

        $message = sprintf(self::PATTERNS['default'], $field);

        if (true === isset(self::PATTERNS[$keyword])) {
            $message = sprintf(self::PATTERNS[$keyword], $field, (string)$value);
        }

        return new self(
            $message,
            1645702457
        );
    }

    private static function createFallbackException(?Throwable $throwable): self
    {
        $message = 'Create check request failed.';

        if (true === $throwable instanceof Throwable) {
            $message = $throwable->getMessage();
        }

        return new self(
            $message,
            1645702457
        );
    }
}
