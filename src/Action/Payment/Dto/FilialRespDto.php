<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

/**
 * Class FilialRespDto
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final readonly class FilialRespDto
{
    /**
     *  FilialRespDto
     *  №    Параметр    Тип    Описание
     *  1    id    Long    Уникальный идентификатор
     *  2    paymentInstrumentId    Long    Уникальный идентификатор платежного инструмента
     *  3    paymentInstrument    enum    Платежный инструмент, посредством которого была проведена транзакция (PAYNET, MUNIS, DIRECT)
     *  4    titleRu    String    Описание на русском языке
     *  5    titleUz    String    Описание на узбекском языке
     *  6    requestFieldDto    RequestFieldRespDto    Информация по передаваемым параметрам и их значениям
     */
}
