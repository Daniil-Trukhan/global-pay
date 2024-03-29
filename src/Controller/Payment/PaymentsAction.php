<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Controller\Payment;

use Daniil\GlobalPay\Repository\PaymentRepository;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class PaymentsAction
 *
 * @package Daniil\GlobalPay\Component\Payment
 */
#[AsController]
final class PaymentsAction extends AbstractController
{
    #[Route('/payment/{payer}', name: 'payments', methods: ['GET'])]
    #[OA\Get(
        path: '/payment/{payer}',
        summary: 'Get payments',
        tags: ['Payment'],
        parameters: [
            new OA\Parameter(name: 'payer', in: 'query', required: true, schema: new OA\Schema(format: 'string'))
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'Get payments',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Payment')
                )
            )
        ]
    )
    ]
    public function __invoke(string $payer, PaymentRepository $repository): JsonResponse
    {
        return new JsonResponse($repository->findByPayer($payer));
    }
}
