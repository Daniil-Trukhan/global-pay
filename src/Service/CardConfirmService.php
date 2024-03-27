<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Service;

use DateTime;
use Daniil\GlobalPay\Action\Card\Confirm\CardConfirmClient;
use Daniil\GlobalPay\Action\Card\Confirm\CardConfirmRequest;
use Daniil\GlobalPay\Component\Card\CardConfirmDto;
use Daniil\GlobalPay\Entity\Card;
use Daniil\GlobalPay\Exception\GlobalPayException;
use Daniil\GlobalPay\Repository\CardRepository;
use Symfony\Component\Security\Core\User\UserInterface;

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
    ) {
    }

    /**
     * @param CardConfirmDto $dto
     * @return Card
     * @throws GlobalPayException
     */
    public function __invoke(CardConfirmDto $dto, UserInterface $user): Card
    {
        $globalResp = ($this->confirmClient)(new CardConfirmRequest(cardToken: $dto->cardToken, code: $dto->code));

        $card = (new Card())
            ->setCardNumber($globalResp->getCardNumber())
            ->setCreatedAt(new DateTime())
            ->setCreatedBy($user)
            ->setBalance($globalResp->getBalance())
            ->setOwner($user)
            ->setBankName($globalResp->getBankName())
            ->setToken($globalResp->getToken())
            ->setExpiryDate($globalResp->getExpiryDate())
            ->setHolderFullName($globalResp->getHolderFullName())
            ->setProcessingType($globalResp->getProcessingType());

        $this->repository->save($card, true);
        return $card;
    }
}
