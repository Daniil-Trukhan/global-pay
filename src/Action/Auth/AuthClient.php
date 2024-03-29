<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Auth;

use Daniil\GlobalPay\Exception\GlobalPayException;
use Daniil\GlobalPay\Service\ParameterBagResolver;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class AuthClient
 *
 * @package Daniil\GlobalPay\Action\Auth
 */
final class AuthClient
{
    private const PATH = '/realms/globalpay/protocol/openid-connect/token';

    private string $authUrl;
    private string $clientId;
    private string $clientSecret;
    private string $grantType;
    private string $password;
    private string $scope;
    private string $username;

    public function __construct(
        protected readonly HttpClientInterface $client,
        ParameterBagResolver                  $config
    )
    {
        $this->authUrl = $config->get('global_pay_auth_url');
        $this->clientId = $config->get('global_pay_client_id');
        $this->grantType = $config->get('global_pay_grant_type');
        $this->scope = $config->get('global_pay_scope');
        $this->clientSecret = $config->get('global_pay_client_secret');
        $this->username = $config->get('global_pay_username');
        $this->password = $config->get('global_pay_password');
    }

    /**
     * @return AuthResponse
     * @throws GlobalPayException
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function __invoke(): AuthResponse
    {
        $data = [
            'grant_type' => $this->grantType,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => $this->username,
            'password' => $this->password,
            'scope' => $this->scope
        ];

        try {
            $response = $this->client->request(
                Request::METHOD_POST,
                $this->authUrl . self::PATH,
                ['body' => $data]
            );
            $code = $response->getStatusCode();
        } catch (TransportExceptionInterface $e) {
            throw new GlobalPayException($e->getMessage());
        }

        if ($code !== Response::HTTP_OK) {
            throw new GlobalPayException();
        }

        return new AuthResponse($response->toArray());
    }
}
