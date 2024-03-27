<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Controller\Payment;

use Daniil\GlobalPay\Component\Payment\PaymentMakeDto;
use Daniil\GlobalPay\Exception\GlobalPayException;
use Daniil\GlobalPay\Service\PaymentMakeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class PaymentMakeAction
 *
 * @package Daniil\GlobalPay\Controller\Payment
 */
final class PaymentMakeAction extends AbstractController
{
    #[Route('/payment/make', name: 'payment_make', methods: ['POST'])]
    public function __invoke(PaymentMakeDto $dto, PaymentMakeService $service): JsonResponse
    {
        try {
            return new JsonResponse($service($dto));
        } catch (GlobalPayException $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
