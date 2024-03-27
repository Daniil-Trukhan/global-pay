<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

/**
 * Class CustomerRespDto
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final readonly class CustomerRespDto
{
    /** Уникальный идентификатор пользователя (физ.лицо) */
    public int $id;
    /** Уникальный идентификатор мерчанта */
    public int $merchantId;
    /** Наименование */
    public string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->merchantId = $data['merchantId'];
    }
}
