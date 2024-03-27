<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

/**
 * Class ProviderRespDto
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final readonly class ProviderRespDto
{
    /**
     * ProviderRespDto
     *  №    Параметр    Тип    Описание
     *  1    id    long    Уникальный идентификатор провайдера в системе «Global Pay», где провайдер – юридическое лицо
     *  2    legalName    String    Наименование провайдера (юр. лицо)
     *  3    name    String    Полное наименование провайдера (юр. лицо)
     *  4    enabled    Boolean    Статус, определяющий активность провайдера
     *  5    addressRegistry    String    Адрес провайдена
     *  6    inn    String    ИНН провайдера
     *  7    paymentInstrument    enum    Разрешенный платежный инструмент в рамках провайдера (PAYNET, MUNIS, DIRECT)
     *  8    paymentInstrumentId    Long    Уникальный идентификатор платежного инструмента
     *  9    services    Set<ServiceRespDto>    Информация по сервисам провайдера
     */
    public function __construct(array $data)
    {
    }
}
