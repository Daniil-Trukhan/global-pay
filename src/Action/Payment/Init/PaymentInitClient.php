<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Init;

use Daniil\GlobalPay\Exception\GlobalPayException;
use Daniil\GlobalPay\Service\Client;
use JsonException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class PaymentInitClient
 *
 * @package Daniil\GlobalPay\Action\Payment\Init
 */
final class PaymentInitClient extends Client
{
    private const PATH = '/payments/v1/payment/init';

    /**
     * @param PaymentInitRequest $request
     * @return PaymentInitResponse
     * @throws GlobalPayException
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws JsonException
     */
    public function __invoke(PaymentInitRequest $request): PaymentInitResponse
    {
        try {
            $response = $this->client->request(
                Request::METHOD_POST,
                $this->baseUrl . self::PATH,
                [
                    'headers' => ['Authorization' => 'Bearer ' . $this->authToken],
                    'json' => $this->toArray($request)
                ]
            );
            $code = $response->getStatusCode();
        } catch (TransportExceptionInterface $e) {
            throw new GlobalPayException($e->getMessage());
        }

        if ($code !== Response::HTTP_OK) {
            throw new GlobalPayException(json_encode($response->toArray(), JSON_THROW_ON_ERROR));
        }

        return new PaymentInitResponse($response->toArray());
    }


    public function toArray(PaymentInitRequest $request): array
    {
        return [
            'externalId' => $request->externalId,
            'serviceId' => $this->serviceId,
            'paymentFields' => [
                [
                    'requestFieldId' => 1,
                    'value' => $request->sum,
                    'name' => 'amount'
                ],
                [
                    'requestFieldId' => 2,
                    'value' => 'UZS',
                    'name' => 'currency'
                ]
            ]
        ];
    }
}
