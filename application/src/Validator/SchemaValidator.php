<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\SchemaValidatorException;
use League\OpenAPIValidation\PSR7\Exception\ValidationFailed;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Request;
use League\OpenAPIValidation\PSR7\ValidatorBuilder;

class SchemaValidator implements ValidatorInterface
{
    private ValidatorBuilder $validatorBuilder;
    private string $schemaPath;

    public function __construct(ValidatorBuilder $validatorBuilder, string $schemaPath)
    {
        $this->validatorBuilder = $validatorBuilder;
        $this->schemaPath = $schemaPath;
    }

    public function validate(Request $request): void
    {
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);

        $psrRequest = $psrHttpFactory->createRequest($request);

        $validator = $this->validatorBuilder
            ->fromYamlFile($this->schemaPath)
            ->getServerRequestValidator();

        try {
            $validator->validate($psrRequest);
        } catch (ValidationFailed $validationFailedException) {
            $previous = $validationFailedException->getPrevious();

            if (null === $previous) {
                throw SchemaValidatorException::invalidRequestData($validationFailedException);
            }

            throw SchemaValidatorException::invalidRequestData($previous);
        }
    }
}
