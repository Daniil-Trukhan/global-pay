<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

/**
 * Class MerchantPaymentRespFieldRespDto
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final readonly class MerchantPaymentRespFieldRespDto
{
    /** Уникальный идентификатор поля ответа мерчанта */
    public string $key;
    /** Описание на русском языке */
    public string $labelRu;
    /** Описание на узбекском языке */
    public string $labelUz;
    /** Значение */
    public string $value;

    public function __construct(array $data)
    {
        $this->key = (string)$data['key'];
        $this->labelRu = (string)$data['labelRu'];
        $this->labelUz = (string)$data['labelUz'];
        $this->value = (string)$data['value'];
    }
}
