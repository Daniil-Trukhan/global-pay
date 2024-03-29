<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Service;

use Daniil\GlobalPay\Action\Payment\Init\PaymentInitClient;
use Daniil\GlobalPay\Action\Payment\Init\PaymentInitRequest;
use Daniil\GlobalPay\Action\Payment\Perform\PaymentPerformClient;
use Daniil\GlobalPay\Action\Payment\Perform\PaymentPerformRequest;
use Daniil\GlobalPay\Component\Payment\PaymentMakeDto;
use Daniil\GlobalPay\Entity\Card;
use Daniil\GlobalPay\Entity\Payment;
use Daniil\GlobalPay\Exception\GlobalPayException;
use Daniil\GlobalPay\Repository\CardRepository;
use Daniil\GlobalPay\Repository\PaymentRepository;
use DateTime;
use JsonException;
use Ramsey\Uuid\Uuid;
use RuntimeException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class PaymentMakeService
 *
 * @package Daniil\GlobalPay\Service
 */
final readonly class PaymentMakeService
{
    public function __construct(
        private PaymentInitClient    $initClient,
        private PaymentPerformClient $performClient,
        private PaymentRepository    $repository,
        private CardRepository       $cardRepository
    )
    {
    }

    /**
     * @param PaymentMakeDto $dto
     * @return Payment
     * @throws GlobalPayException
     * @throws JsonException
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function __invoke(PaymentMakeDto $dto): Payment
    {
        if ($dto->sum === 0) {
            throw new GlobalPayException('Fill course or sum');
        }

        $initResponse = ($this->initClient)(new PaymentInitRequest(
            externalId: Uuid::uuid4()->toString(),
            sum: $dto->sum * 100 // перевод в тиины
        ));

        /** @var Card $card */
        $card = $this->cardRepository->find($dto->cardId);
        if ($card === null) {
            throw new RuntimeException('Card not found');
        }

        $performResponse = ($this->performClient)(
            new PaymentPerformRequest(
                externalId: $initResponse->getExternalId(),
                id: $initResponse->getId(),
                cardToken: $card->getToken()
            )
        );

        $payment = (new Payment())
            ->setCreatedAt(new DateTime())
            ->setSum($dto->sum)
            ->setPayer($card->getOwner())
            ->setExternalId($performResponse->getExternalId())
            ->setStatus($performResponse->getStatus())
            ->setTransactionId($performResponse->getId())
            ->setBankResponse(json_encode($performResponse, JSON_THROW_ON_ERROR));

        $this->repository->save($payment, true);
        return $payment;
    }

}
