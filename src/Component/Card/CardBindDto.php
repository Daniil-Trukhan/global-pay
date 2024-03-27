<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Component\Card;

/**
 * Class CardBindDto
 *
 * @package Daniil\GlobalPay\Component\Card
 */
final class CardBindDto
{
    public function __construct(
        /** Номер карты Uzcard или Humo */
        public string $cardNumber,
        /** Срок действия карты в формате «yymm» */
        public string $expiryDate
    ) {
    }
}
