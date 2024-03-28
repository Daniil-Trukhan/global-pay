<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Service;

use Daniil\GlobalPay\Action\Auth\AuthClient;
use Daniil\GlobalPay\Exception\GlobalPayException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class Client
 *
 * @package Daniil\GlobalPay\Service
 */
abstract class Client
{
    protected string $authToken;
    protected string $baseUrl;
    protected string $serviceId;

    /**
     * @throws GlobalPayException
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function __construct(
        protected readonly HttpClientInterface $client,
        private readonly AuthClient            $authClient,
        ParameterBagInterface                  $config
    ) {
        $this->baseUrl = $config->get('global_pay_url');
        $this->serviceId = $config->get('global_pay_service_id');
        $this->auth();
    }

    /**
     * @throws GlobalPayException
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    private function auth(): void
    {
        $authResp = ($this->authClient)();
        $this->authToken = $authResp->getAccessToken();
    }
}
