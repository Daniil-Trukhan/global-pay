<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Dto;

use IteratorAggregate;
use Ramsey\Collection\Collection;

/**
 * Class MerchantPaymentRespFieldRespDtoCollection
 *
 * @extends Collection<MerchantPaymentRespFieldRespDto>
 *
 * @package Daniil\GlobalPay\Action\Payment\CheckStatus
 */
final class MerchantPaymentRespFieldRespDtoCollection extends Collection
{
    public function __construct(array $data = [])
    {
        parent::__construct(MerchantPaymentRespFieldRespDto::class, $data);
    }
}
