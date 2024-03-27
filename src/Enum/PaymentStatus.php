<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Enum;

/**
 * Class PaymentStatus
 *
 * Enum of payment status
 *
 * @package Daniil\GlobalPay\Enum
 */
enum PaymentStatus: int
{
    case CREATED = 0;
    case PAYED = 5;
}
