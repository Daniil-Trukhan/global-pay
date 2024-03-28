<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Component\Payment;

use OpenApi\Attributes as OA;

/**
 * Class PaymentMakeDto
 *
 * @package Daniil\GlobalPay\Component\Payment
 */
#[OA\RequestBody(
    description: 'Payment Make Request',
    required: true,
    content: new OA\MediaType(
        mediaType: 'application/json',
        schema: new OA\Schema(
            properties: [
                new OA\Property(
                    property: 'cardId',
                    title: 'Card Id',
                    description: 'Card Id',
                    format: 'int64',
                    example: '123'
                ),
                new OA\Property(
                    property: 'sum',
                    title: 'Sum',
                    description: 'Sum',
                    format: 'int64',
                    example: 10000
                )
            ]
        )
    )
)]
final readonly class PaymentMakeDto
{
    public function __construct(
        /** Id карты */
        public int $cardId,
        /** Сумма платежа */
        public ?int $sum = null,
    ) {
    }
}
