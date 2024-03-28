<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Controller\Payment;

use Daniil\GlobalPay\Repository\PaymentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

/**
 * Class PaymentMyAction
 *
 * @package Daniil\GlobalPay\Component\Payment
 */
#[AsController]
final class PaymentMyAction extends AbstractController
{
    #[Route('/payment/my', name: 'payment_my', methods: ['GET'])]
    #[OA\Get(
        path: '/payment/my',
        summary: 'Get my payments',
        tags: ['Payment'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'Get my payments',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Payment')
                )
            )
        ]
    )
    ]
    public function __invoke(PaymentRepository $repository): JsonResponse
    {
        $user = $this->getUser();
        return $user !== null ?
            new JsonResponse($repository->findMy($user->getUserIdentifier())) :
            new JsonResponse([]);
    }
}
