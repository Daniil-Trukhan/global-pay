<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

use Daniil\GlobalPay\Enum\ProcessingType;

/**
 * Class CardRespDto
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final readonly class CardRespDto
{
    /** Сумма оплаты */
    public int $balance;
    /** Номер карты под маской */
    public string $cardNumber;
    /** Срок действия карты */
    public string $expiryDate;
    /** Полное имя держателя карты */
    public string $holderFullName;
    /** Тип карты в рамках процессингового центра (UZCARD, HUMO, VM) */
    public ProcessingType $processingType;
    /** */
    public string $smsNotificationNumber;
    /** Токен карты, с которой произведен платеж */
    public string $token;

    public function __construct(array $data)
    {
        $this->token = (string)$data['token'];
        $this->cardNumber = (string)$data['cardNumber'];
        $this->balance = (int)$data['balance'];
        $this->expiryDate = (string)$data['expiryDate'];
        $this->smsNotificationNumber = (string)$data['smsNotificationNumber'];
        $this->processingType = ProcessingType::tryFrom($data['processingType']);
        $this->holderFullName = (string)$data['holderFullName'];
    }
}
