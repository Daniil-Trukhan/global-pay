<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Card\Confirm;

use Daniil\GlobalPay\Enum\ProcessingType;

/**
 * Class CheckStatusResponse
 *
 * @package Daniil\GlobalPay\Action\Card\Confirm
 */
final class CardConfirmResponse
{
    /** Баланс карты на момент её подтверждения */
    private int $balance;
    /** Наименование банка, выпустившего карту и производящий ее обслуживание */
    private string $bankName;
    /** Номер карты «под маской» */
    private string $cardNumber;
    /** Срок действия карты */
    private string $expiryDate;
    /** Имя и фамилия владельца карты */
    private string $holderFullName;
    /** Тип карты в рамках процессингового центра (UZCARD, HUMO, VM) */
    private ProcessingType $processingType;
    /**  UUID Подтвержденный токен карты в системе «Global Pay» */
    private string $token;

    public function __construct(array $data)
    {
        $this->balance = (int)$data['balance'];
        $this->bankName = $data['bankName'];
        $this->cardNumber = $data['cardNumber'];
        $this->expiryDate = $data['expiryDate'];
        $this->holderFullName = $data['holderFullName'];
        $this->token = $data['token'];
        $this->processingType = ProcessingType::from((string)$data['processingType']);
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function getBankName(): string
    {
        return $this->bankName;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function getExpiryDate(): string
    {
        return $this->expiryDate;
    }


    public function getHolderFullName(): string
    {
        return $this->holderFullName;
    }

    public function getProcessingType(): ProcessingType
    {
        return $this->processingType;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
