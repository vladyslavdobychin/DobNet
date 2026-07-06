<?php

namespace App\Controller;

use App\Services\CreateUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Requests\CreateUserRequest;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class CreateUserAction extends AbstractController
{
    public function __construct(private readonly CreateUserService $createUserService)
    {
    }

    /**
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function __invoke(#[MapRequestPayload] CreateUserRequest $request): JsonResponse
    {
        $result = $this->createUserService->execute($request);

        return new JsonResponse([
            'id' => $result->getId()->toRfc4122(),
            'firstName' => $result->getFirstName()->value(),
            'lastName' => $result->getLastName()->value(),
            'email' => $result->getEmail()->value(),
            'username' => $result->getUsername()->value(),
        ]);
    }
}
