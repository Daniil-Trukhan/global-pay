<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Enum;

/**
 * Тип карты в рамках процессингового центра
 *
 * @package Daniil\GlobalPay\Enum
 */
enum ProcessingType: string
{
    case HUMO = 'HUMO';
    case VM = 'VM';
    case UZCARD = 'UZCARD';
}
