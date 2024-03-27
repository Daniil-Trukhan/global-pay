<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Component\Card;

/**
 * Class CardConfirmDto
 *
 * @package Daniil\GlobalPay\Component\Card
 */
final readonly class CardConfirmDto
{
    public function __construct(
        /** Токен карты, получаемый на этапе привязки карты к платежному шлюзу. */
        public string $cardToken,
        /** Код подтверждения. */
        public string $code
    ) {
    }
}
