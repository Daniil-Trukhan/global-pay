<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Card\Confirm;

/**
 * Class CardConfirmRequest
 *
 * @package Daniil\GlobalPay\Action\Card\Confirm
 */
final readonly class CardConfirmRequest
{
    public function __construct(
        /** Токен карты, получаемый на этапе привязки карты к платежному шлюзу. */
        public string $cardToken,
        /** Код подтверждения. */
        public string $code
    ) {
    }
}
