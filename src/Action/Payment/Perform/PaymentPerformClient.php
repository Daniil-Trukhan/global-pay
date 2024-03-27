<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Perform;

use Daniil\GlobalPay\Exception\GlobalPayException;
use Daniil\GlobalPay\Service\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @throws GlobalPayException
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
