<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Controller\Card;

use Daniil\GlobalPay\Repository\CardRepository;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class GetCardsAction
 *
 * @package Daniil\GlobalPay\Controller
 */
#[AsController]
final class GetCardsAction extends AbstractController
{
    #[Route('/cards/{owner}', name: 'cards', methods: ['GET'])]
    #[OA\Get(
        path: '/cards/{owner}',
        summary: 'Get cards',
        tags: ['Card'],
        parameters: [
            new OA\Parameter(name: 'owner', in: 'query', required: true, schema: new OA\Schema(format: 'string'))
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'Get cards',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Card')
                )
            )
        ]
    )
    ]
    public function __invoke(string $owner, CardRepository $repository): JsonResponse
    {
        return new JsonResponse($repository->findByOwner($owner));
    }
}