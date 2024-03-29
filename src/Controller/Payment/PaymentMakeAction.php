<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Controller\Payment;

use Daniil\GlobalPay\Component\Payment\PaymentMakeDto;
use Daniil\GlobalPay\Service\PaymentMakeService;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

/**
 * Class PaymentMakeAction
 *
 * @package Daniil\GlobalPay\Controller\Payment
 */
final class PaymentMakeAction extends AbstractController
{
    #[Route('/payment/make', name: 'payment_make', methods: ['POST'])]
    #[OA\Post(
        path: '/payment/make',
        operationId: 'paymentMake',
        summary: 'Make payment',
        requestBody: new OA\RequestBody(ref: "#/components/requestBodies/PaymentMakeDto"),
        tags: ['Payment'],
        responses: [
            new OA\Response(
                ref: '#/components/schemas/Payment',
                response: Response::HTTP_OK,
                description: 'Make payment'
            ),
            new OA\Response(
                response: Response::HTTP_BAD_REQUEST,
                description: 'Bad request'
            )
        ]
    )
    ]
    public function __invoke(PaymentMakeDto $dto, PaymentMakeService $service): JsonResponse
    {
        try {
            return new JsonResponse($service($dto));
        } catch (Throwable $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
