<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Init;

use Daniil\GlobalPay\Enum\Status;

/**
 * Class PaymentInitResponse
 *
 * @package Daniil\GlobalPay\Action\Payment\Init
 */
final class PaymentInitResponse
{
    /** Уникальный идентификатор платежа (назначается мерчантом) */
    private string $externalId;
    /** Уникальный идентификатор платежа в системе «Global Pay», его следует сохранить для следующего шага */
    private string $id;
    /** Статус */
    private Status $status;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->externalId = $data['externalId'];
        $this->status = Status::from((string)$data['status']);
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}
