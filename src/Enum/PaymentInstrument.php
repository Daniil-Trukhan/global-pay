<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Enum;

/**
 * Разрешенный платежный инструмент в рамках провайдера (PAYNET, MUNIS, DIRECT)
 * @package Daniil\GlobalPay\Enum
 */
enum PaymentInstrument: string
{
    case PAYNET = 'PAYNET';
    case MUNIS = 'MUNIS';
    case DIRECT = 'DIRECT';
}
