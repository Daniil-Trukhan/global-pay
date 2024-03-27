<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

use IteratorAggregate;
use Ramsey\Collection\Collection;

/**
 * Class PaymentFieldRespDtoCollection
 *
 * @extends Collection<PaymentFieldRespDto>
 * @implements IteratorAggregate<PaymentFieldRespDto>
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final class PaymentFieldRespDtoCollection extends Collection
{
    public function __construct(array $data = [])
    {
        parent::__construct(PaymentFieldRespDto::class, $data);
    }
}
