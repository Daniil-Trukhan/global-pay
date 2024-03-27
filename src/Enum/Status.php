<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Enum;

/**
 * Class Status
 *
 * Статус транзакции
 *
 * @package Daniil\GlobalPay\Enum
 */
enum Status: string
{
    case INIT = 'INIT';
    case VALIDATE = 'VALIDATE';
    case APPROVED = 'APPROVED';
    case PARTIAL_REVERT = 'PARTIAL_REVERT';
    case REVERT = 'REVERT';
    case FAILED = 'FAILED';
    case NEED_REVERT = 'NEED_REVERT';
}
