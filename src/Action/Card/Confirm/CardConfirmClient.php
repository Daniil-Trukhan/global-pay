<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Card\Confirm;

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
 * Class CardConfirmClient
 *
 * @package Daniil\GlobalPay\Action\Card\Confirm
 */
final class CardConfirmClient extends Client
{
    private const PATH = '/cards/v1/card/confirm/';

    /**
     * @throws GlobalPayException
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws \JsonException
     */
    public function __invoke(CardConfirmRequest $request): CardConfirmResponse
    {
        try {
            $response = $this->client->request(
                Request::METHOD_POST,
                $this->baseUrl . self::PATH . $request->cardToken,
                [
                    'headers' => ['Authorization' => 'Bearer ' . $this->authToken],
                    'json' => ['code' => $request->code]
                ]
            );
            $code = $response->getStatusCode();
        } catch (TransportExceptionInterface $e) {
            throw new GlobalPayException('Transport error ' . $e->getMessage());
        }

        if ($code !== Response::HTTP_OK) {
            throw new GlobalPayException(json_decode($response->getContent(), false, 512, JSON_THROW_ON_ERROR)->detail);
        }

        return new CardConfirmResponse($response->toArray());
    }
}
