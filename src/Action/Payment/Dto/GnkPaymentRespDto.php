<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

/**
 * Class GnkPaymentRespDto
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final readonly class GnkPaymentRespDto
{
    /** Фискальная подпись чека */
    public string $fiscalSign;
    /** Тип сообщения поясняющий ответ из ГНК */
    public string $message;
    /** url-адрес на QR-код в системе ГНК */
    public string $qrCodeUrl;
    /** Уникальный идентификатор чека транзакции*/
    public int $receiptId;
    /** Параметр, определяющий статус успешности регистрации платежа в системе ГНК */
    public bool $success;
    /** Идентификатор терминала, посредством которого была произведена регистрация транзакции в системе ГНК */
    public string $terminalId;

    public function __construct(array $data)
    {
        $this->receiptId = (int)$data['receiptId'];
        $this->qrCodeUrl = (string)$data['qrcodeUrl'];
        $this->terminalId = (string)$data['terminalId'];
        $this->fiscalSign = (string)$data['fiscalSign'];
        $this->success = (bool)$data['receiptId'];
        $this->message = (string)$data['message'];
    }
}
