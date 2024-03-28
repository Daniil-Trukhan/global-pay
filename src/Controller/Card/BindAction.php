<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Controller\Card;

use Daniil\GlobalPay\Component\Card\CardBindDto;
use Daniil\GlobalPay\Service\CardBindService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Throwable;

/**
 * Class BindAction
 *
 * @package Daniil\GlobalPay\Controller\Card
 */
#[OA\Info(version: '0.1', description: 'Global Pay API', title: 'Global Pay API')]
#[AsController]
final class BindAction extends AbstractController
{
    #[Route('/cards/bind', name: 'cards_bind', methods: ['POST'])]
    #[OA\Post(
        path: '/cards/bind',
        operationId: 'bindCard',
        summary: 'Bind card',
        requestBody: new OA\RequestBody(ref: "#/components/requestBodies/CardBindDto"),
        tags: ['Card'],
        responses: [
            new OA\Response(
                ref: '#/components/schemas/CardBindResponseDto',
                response: Response::HTTP_OK,
                description: 'Card is bound'
            )
        ]
    )
    ]
    public function __invoke(CardBindDto $dto, CardBindService $service): JsonResponse
    {
        try {
            return new JsonResponse($service($dto));
        } catch (Throwable) {
            return new JsonResponse('Something is wrong', Response::HTTP_BAD_REQUEST);
        }
    }
}
