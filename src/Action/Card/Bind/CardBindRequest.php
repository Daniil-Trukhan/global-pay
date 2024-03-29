<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Card\Bind;

/**
 * Class CardBindRequest
 *
 * @package Daniil\GlobalPay\Action\Card\CoBindnfirm
 */
final readonly class CardBindRequest
{
    public function __construct(
        /** Номер карты Uzcard или Humo */
        private string $cardNumber,
        /** Срок действия карты в формате «yymm» */
        private string $expiryDate
    )
    {
    }

    public function toArray(): array
    {
        return [
            'cardNumber' => $this->cardNumber,
            'expiryDate' => $this->expiryDate
        ];
    }
}
