<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Service;

use Daniil\GlobalPay\Action\Card\Confirm\CardConfirmClient;
use Daniil\GlobalPay\Action\Card\Confirm\CardConfirmRequest;
use Daniil\GlobalPay\Component\Card\CardConfirmDto;
use Daniil\GlobalPay\Entity\Card;
use Daniil\GlobalPay\Exception\GlobalPayException;
use Daniil\GlobalPay\Repository\CardRepository;
use DateTime;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class CardBindService
 *
 * @package Daniil\GlobalPay\Service
 */
final readonly class CardConfirmService
{
    public function __construct(
        private CardRepository    $repository,
        private CardConfirmClient $confirmClient
    )
    {
    }

    /**
     * @param CardConfirmDto $dto
     * @return Card
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws GlobalPayException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function __invoke(CardConfirmDto $dto): Card
    {
        $globalResp = ($this->confirmClient)(new CardConfirmRequest(cardToken: $dto->cardToken, code: $dto->code));

        $card = (new Card())
            ->setCardNumber($globalResp->getCardNumber())
            ->setCreatedAt(new DateTime())
            ->setBalance($globalResp->getBalance())
            ->setOwner($globalResp->getHolderFullName())
            ->setBankName($globalResp->getBankName())
            ->setToken($globalResp->getToken())
            ->setExpiryDate($globalResp->getExpiryDate())
            ->setHolderFullName($globalResp->getHolderFullName())
            ->setProcessingType($globalResp->getProcessingType());

        $this->repository->save($card, true);
        return $card;
    }
}
