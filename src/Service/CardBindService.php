<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Service;

use Daniil\GlobalPay\Action\Card\Bind\CardBindClient;
use Daniil\GlobalPay\Action\Card\Bind\CardBindRequest;
use Daniil\GlobalPay\Component\Card\CardBindDto;
use Daniil\GlobalPay\Component\Card\CardBindResponseDto;
use Daniil\GlobalPay\Exception\GlobalPayException;

/**
 * Class CardBindService
 *
 * @package Daniil\GlobalPay\Service
 */
final readonly class CardBindService
{
    public function __construct(private CardBindClient $confirmClient)
    {
    }

    /**
     * @throws GlobalPayException
     */
    public function __invoke(CardBindDto $dto): CardBindResponseDto
    {
        $globalResp = ($this->confirmClient)(
            new CardBindRequest(cardNumber: $dto->cardNumber, expiryDate: $this->modifyExpiryDate($dto->expiryDate))
        );

        return (new CardBindResponseDto(
            cardToken: $globalResp->getCardToken(),
            smsNotificationNumber: $globalResp->getSmsNotificationNumber()
        ));
    }

    private function modifyExpiryDate(string $expiryDate): string
    {
        return $expiryDate[2] . $expiryDate[3] . $expiryDate[0] . $expiryDate[1];
    }
}
