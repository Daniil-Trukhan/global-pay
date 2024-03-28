<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Component\Card;

use OpenApi\Attributes as OA;

/**
 * Class CardBindResponseDto
 *
 * @package Daniil\GlobalPay\Component\Card
 */
#[OA\Schema(title: 'Card Bind Response Dto', description: 'Card Bind Response Dto')]
final class CardBindResponseDto
{
    public function __construct(
        /** Неподтвержденный токен карты в системе «Global Pay» */
        #[OA\Property(title: 'Card Token', description: 'Card Token', format: 'string')]
        public string $cardToken,
        /** Номер SMS-информирования владельца карты «под маской», на который будет выслан одноразовый OTP-код. */
        #[OA\Property(title: 'SMS Notification Number', description: 'SMS Notification Number', format: 'string')]
        public string $smsNotificationNumber
    ) {
    }
}
