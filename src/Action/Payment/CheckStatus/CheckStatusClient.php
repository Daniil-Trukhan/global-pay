<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\CheckStatus;

use Daniil\GlobalPay\Action\Payment\Perform\PaymentResponse;
use Daniil\GlobalPay\Exception\GlobalPayException;
use Daniil\GlobalPay\Service\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class CheckStatusClient
 *
 * @package Daniil\GlobalPay\Action\Payment\Init
 */
final class CheckStatusClient extends Client
{
    private const PATH = '/payments/v1/payment/';

    /**
     * @param CheckStatusRequest $request
     * @return PaymentResponse
     * @throws GlobalPayException
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function __invoke(CheckStatusRequest $request): PaymentResponse
    {
        try {
            $response = $this->client->request(
                Request::METHOD_GET,
                $this->baseUrl . self::PATH . $request->paymentId,
                ['headers' => ['Authorization' => 'Bearer ' . $this->authToken]]
            );
            $code = $response->getStatusCode();
        } catch (TransportExceptionInterface $e) {
            throw new GlobalPayException($e->getMessage());
        }

        if ($code !== Response::HTTP_OK) {
            throw new GlobalPayException();
        }

        return new PaymentResponse($response->toArray());
    }
}
