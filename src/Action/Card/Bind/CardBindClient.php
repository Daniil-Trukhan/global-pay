<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Card\Bind;

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
 * Class CardBindClient
 *
 * @package Daniil\GlobalPay\Action\Card\Bind
 */
final class CardBindClient extends Client
{
    private const PATH = '/cards/v1/card';

    /**
     * @param CardBindRequest $request
     * @return CardBindResponse
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws GlobalPayException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function __invoke(CardBindRequest $request): CardBindResponse
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

        return new CardBindResponse($response->toArray());
    }
}
