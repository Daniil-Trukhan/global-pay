<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Perform;

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
 * Class PaymentPerformClient
 *
 * @package Daniil\GlobalPay\Action\Payment\Init
 */
final class PaymentPerformClient extends Client
{
    private const PATH = '/payments/v1/payment/perform';

    /**
     * @param PaymentPerformRequest $request
     * @return PaymentResponse
     * @throws GlobalPayException
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function __invoke(PaymentPerformRequest $request): PaymentResponse
    {
        try {
            $response = $this->client->request(
                Request::METHOD_POST,
                $this->baseUrl . self::PATH,
                [
                    'headers' => ['Authorization' => 'Bearer ' . $this->authToken],
                    'json' => $request->toArray()
                ]
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
