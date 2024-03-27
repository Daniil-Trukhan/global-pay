<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

/**
 * Class ServiceRespDto
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final class ServiceRespDto
{
    /**
     *  ServiceRespDto
     *  №    Параметр    Тип    Описание
     *  1    id    Long    Уникальный идентификатор сервиса Мерчанта, посредством которого произведен платеж
     *  2    minAmount    Long    Минимально разрешенная сумма платежа в тийнах
     *  3    maxAmount    Long    Максимально разрешенная сумма платежа в тийнах
     *  4    comission    Long    Комиссия по платежу
     *  5    fixedPrice    Long    Определяет фиксированную сумму оплаты по сервису
     *  6    paymentInstrumentId    Long    Уникальный идентификатор платежного инструмента Мерчанта
     *  7    name    String    Наименование сервиса
     *  8    legalName    String    Полное наименование сервиса
     *  9    uzcardMerchantId    String    Идентификатор Мерчанта в системе Uzcard
     *  10    uzcardTerminalId    String    Идентификатор терминала Мерчанта в системе Uzcard
     *  11    humoMerchantId    String    Идентификатор Мерчанта в системе Huno
     *  12    humoTerminalId    String    Идентификатор терминала Мерчанта в системе Huno
     *  13    url    String    url-адрес мерчанта
     *  14    enabled    Boolean    Статус, определяющий активность сервиса
     *  15    info    Boolean    Определяет возможность получения информации по сервису
     *  16    includeGnk    Boolean    Статус, определяющий фискализацию (если false – совершить принудительную фискализацию платежа)
     *  17    pinfl    String    ПИНФЛ Мерчанта (указывается, если Мерчант – самозанятое лицо)
     *  18    isVMActive    Boolean    Параметр, определяющий активность услуги международных платежей в рамках VISA/MASTERCARD
     *  19    responseFields    ResponseFieldRespDto    Сущность параметров ответов платежа
     *  20    requestFields    RequestFieldRespDto    Сущность параметров запросов платежа
     *  21    provider    ProviderRespDto    Сущность параметров поставщика услуг
     */


    public function __construct(array $data)
    {
//        $this->responseFields = new ResponseFieldRespDto($data['responseFields']);
//        $this->requestFields = $this->mapRequestFields($data['requestFields']);
//        $this->provider = new ProviderRespDto($data['provider']); //
    }
}
