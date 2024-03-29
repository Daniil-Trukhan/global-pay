<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

use IteratorAggregate;
use Ramsey\Collection\Collection;

/**
 * Class PaymentRevertRespDtoCollection
 *
 * @extends Collection<PaymentRevertRespDto>
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final class PaymentRevertRespDtoCollection extends Collection
{
    public function __construct(array $data = [])
    {
        parent::__construct(PaymentRevertRespDto::class, $data);
    }
}
