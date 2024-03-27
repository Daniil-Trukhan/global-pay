<?php

declare(strict_types=1);


use Daniil\GlobalPay\DependencyInjection\GlobalPayExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class GlobalPayBundle
 *
 * @package Daniil\GlobalPay
 */
final class GlobalPayBundle extends Bundle
{
    /**
     * Overridden to allow for the custom extension alias.
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new GlobalPayExtension();
        }
        return $this->extension;
    }

    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}
