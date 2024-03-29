<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class ParameterBagResolver
 *
 * @package Daniil\GlobalPay\Service
 */
final readonly class ParameterBagResolver
{
    public function __construct(private ParameterBagInterface $config)
    {
    }

    public function get(string $paramName): string
    {
        $value = $this->config->get($paramName);
        if ($value instanceof \UnitEnum || is_array($value)) {
            return '';
        }
        return (string)$value;
    }
}
