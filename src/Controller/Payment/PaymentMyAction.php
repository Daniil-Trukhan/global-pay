<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Controller\Payment;

use Daniil\GlobalPay\Repository\PaymentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class PaymentMyAction
 *
 * @package Daniil\GlobalPay\Component\Payment
 */
#[AsController]
final class PaymentMyAction extends AbstractController
{
    #[Route('/payment/my', name: 'payment_my', methods: ['GET'])]
    public function __invoke(PaymentRepository $repository): array
    {
        return $repository->findMy($this->getUser());
    }
}
