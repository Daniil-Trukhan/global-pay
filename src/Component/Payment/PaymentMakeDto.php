<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Component\Payment;

use Daniil\GlobalPay\Entity\Card;

/**
 * Class PaymentMakeDto
 *
 * @package Daniil\GlobalPay\Component\Payment
 */
final readonly class PaymentMakeDto
{
    public function __construct(
        /** Карта Uzcard или Humo */
        public Card $card,
        /** Сумма платежа */
        public ?int $sum = null,
    ) {
    }
}
