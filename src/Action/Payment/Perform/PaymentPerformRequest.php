<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Perform;

/**
 * Class PaymentPerformRequest
 *
 * @package Daniil\GlobalPay\Action\Payment\Perform
 */
final readonly class PaymentPerformRequest
{
    public function __construct(
        /** Уникальный идентификатор платежа в системе «Global Pay», назначенный Мерчантом на этапе создания платежа */
        private string $externalId,
        /** Идентификационный номер платежа в системе «Global Pay» возвращается Мерчанту в случае успешного создания платежа */
        private string $id,
        /** Токен карты, в системе «Global Pay» возвращается Мерчанту на этапе подтверждения карты */
        private string $cardToken
    )
    {
    }

    public function toArray(): array
    {
        return [
            'externalId' => $this->externalId,
            'id' => $this->id,
            'cardToken' => $this->cardToken
        ];
    }
}
