<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Component\Card;

use OpenApi\Attributes as OA;

/**
 * Class CardConfirmDto
 *
 * @package Daniil\GlobalPay\Component\Card
 */
#[OA\RequestBody(
    description: 'Card Confirm Request',
    required: true,
    content: new OA\MediaType(
        mediaType: 'application/json',
        schema: new OA\Schema(
            properties: [
                new OA\Property(
                    property: 'cardToken',
                    title: 'Card Token',
                    description: 'Card Token',
                    format: 'string',
                    example: '1234567890'
                ),
                new OA\Property(
                    property: 'code',
                    title: 'Confirmation Code',
                    description: 'Confirmation code',
                    format: 'string',
                    example: '1234'
                )
            ]
        )
    )
)]
final readonly class CardConfirmDto
{
    public function __construct(
        /** Токен карты, получаемый на этапе привязки карты к платежному шлюзу. */
        public string $cardToken,
        /** Код подтверждения. */
        public string $code
    )
    {
    }
}
