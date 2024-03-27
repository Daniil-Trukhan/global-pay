<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

/**
 * Class ResponseFieldRespDto
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final class ResponseFieldRespDto
{
    public function __construct(array $data)
    {
    }
    /**
     *  ResponceFieldRespDto
     *  №    Параметр    Тип    Описание
     *  1    id    Long    Уникальный идентификатор ResponceField
     *  2    fieldName    String    Наименование поля
     *  3    labelRu    String    Описание на русском языке
     *  4    labelUz    String    Описание на узбекском языке
     *  5    order    Int    Порядковый номер ResponceField
     *  6    service    ServiceRespDto    Сущность сервиса Мерчанта
     */
}
