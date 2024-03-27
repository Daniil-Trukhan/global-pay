<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

/**
 * Class PaymentFieldRespDto
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final readonly class PaymentFieldRespDto
{
    /** Уникальный идентификатор PaymentField */
    public int $id;
    /** Наименование */
    public string $name;
    /** Значение */
    public string $value;

    public function __construct(array $data)
    {
        $this->id = (int)$data['id'];
        $this->value = (string)$data['value'];
        $this->name = (string)$data['name'];
    }
}
