<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Init;

/**
 * Class PaymentInitRequest
 *
 * @package Daniil\GlobalPay\Action\Payment\Init
 */
final readonly class PaymentInitRequest
{
    public function __construct(
        /** ID шаблона платежа, выданный специалистами ИП ООО «GLOBAL SOLUTIONS» */
        public string $externalId,
        /** Сумма, подлежащая к списанию (указывается сумма в тийнах Республики Узбекистан) */
        public int    $sum
    ) {
    }
}
