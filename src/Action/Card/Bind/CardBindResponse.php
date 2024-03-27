<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Card\Bind;

/**
 * Class CardBindResponse
 *
 * @package Daniil\GlobalPay\Action\Card\Bind
 */
final readonly class CardBindResponse
{
    /** Неподтвержденный токен карты в системе «Global Pay» */
    private string $cardToken;
    /** Номер SMS-информирования владельца карты «под маской», на который будет выслан одноразовый OTP-код. */
    private string $smsNotificationNumber;

    public function __construct(array $data)
    {
        $this->cardToken = $data['cardToken'];
        $this->smsNotificationNumber = $data['smsNotificationNumber'];
    }


    public function getCardToken(): string
    {
        return $this->cardToken;
    }

    public function getSmsNotificationNumber(): string
    {
        return $this->smsNotificationNumber;
    }
}
