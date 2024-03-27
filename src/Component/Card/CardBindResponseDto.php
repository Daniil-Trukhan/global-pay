<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Component\Card;

/**
 * Class CardBindResponseDto
 *
 * @package Daniil\GlobalPay\Component\Card
 */
final class CardBindResponseDto
{
    public function __construct(
        /** Неподтвержденный токен карты в системе «Global Pay» */
        public string $cardToken,
        /** Номер SMS-информирования владельца карты «под маской», на который будет выслан одноразовый OTP-код. */
        public string $smsNotificationNumber
    ) {
    }
}
