<?php

declare(strict_types = 1);

namespace App\Api\Action;

use App\Registry\ValidatorRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Throwable;

class AddUserAction
{
    public function __construct(
        private readonly ValidatorRegistry $validatorRegistry
    )
    {

    }

    #[Route(
        '/add-user',
        name: 'add-user',
        methods: ['POST']
    )]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->validatorRegistry->validate($request);

            return JsonResponse::fromJsonString(
                json_encode(
                    [
                        'action' => 'created',
                        'userId' => 'ebb2f2d9-5885-440a-a512-e1ce284dbd76',
                    ],
                    JSON_THROW_ON_ERROR
                ),
                Response::HTTP_CREATED
            );
        } catch (Throwable $throwable) {
            return JsonResponse::fromJsonString(
                json_encode(
                    [
                        'code' => $throwable->getCode(),
                        'message' => $throwable->getMessage(),
                    ],
                    JSON_THROW_ON_ERROR
                ),
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
