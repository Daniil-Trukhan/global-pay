<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\CheckStatus;

/**
 * Class CheckStatusRequest
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final readonly class CheckStatusRequest
{
    public function __construct(
        /** id платежа */
        public string $paymentId
    )
    {
    }
}
