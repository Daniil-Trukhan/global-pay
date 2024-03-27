<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

/**
 * Class PaymentRevertRespDto
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final readonly class PaymentRevertRespDto
{
    /** Сумма возврата в тийнах */
    public int $amount;
    /** Время и дата произведения возврата */
    public string $createdAt;
    /** Уникальный идентификатор возврата платежа со стороны Мерчанта. */
    public string $externalId;
    /** Время и дата произведения возврата в системе ГНК */
    public string $gnkRevertedAt;
    /** Уникальный идентификатор возврата платежа */
    public int $id;
    /** Время и дата произведения возврата в системе*/
    public string $merchantRevertedAt;

    public function __construct(array $data)
    {
        $this->id = (int)$data['id'];
        $this->createdAt = (string)$data['id'];
        $this->gnkRevertedAt = (string)$data['id'];
        $this->merchantRevertedAt = (string)$data['id'];
        $this->externalId = (string)$data['id'];
        $this->amount = (int)$data['id'];
    }
}
