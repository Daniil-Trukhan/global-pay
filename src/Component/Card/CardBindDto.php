<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Component\Card;

use OpenApi\Attributes as OA;

/**
 * Class CardBindDto
 *
 * @package Daniil\GlobalPay\Component\Card
 */
#[OA\RequestBody(
    description: 'Card Bind Request',
    required: true,
    content: new OA\MediaType(
        mediaType: 'application/json',
        schema: new OA\Schema(
            properties: [
                new OA\Property(
                    property: 'cardNumber',
                    title: 'Card Number',
                    description: 'Card Number',
                    format: 'string',
                    example: '1234567890'
                ),
                new OA\Property(
                    property: 'expiryDate',
                    title: 'Expiry Date',
                    description: 'Expiry Date',
                    format: 'string',
                    example: '2501'
                )
            ]
        )
    )
)]
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
