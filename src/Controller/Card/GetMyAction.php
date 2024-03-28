<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Controller\Card;

use Daniil\GlobalPay\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

/**
 * Class GetMyAction
 *
 * @package Daniil\GlobalPay\Controller
 */
#[AsController]
final class GetMyAction extends AbstractController
{
    #[Route('/cards/my', name: 'cards_my', methods: ['GET'])]
    #[OA\Get(
        path: '/cards/my',
        summary: 'Get my cards',
        tags: ['Card'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'Get my card',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Card')
                )
            )
        ]
      )
    ]
    public function __invoke(CardRepository $repository, Security $security): JsonResponse
    {
        $user = $security->getUser();
        return $user !== null ?
            new JsonResponse($repository->findMy($security->getUser()?->getUserIdentifier())) :
            new JsonResponse([]);
    }
}