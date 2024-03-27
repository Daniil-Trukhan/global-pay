<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Payment\Perform;

use Daniil\GlobalPay\Action\Payment\Dto\CardRespDto;
use Daniil\GlobalPay\Action\Payment\Dto\CustomerRespDto;
use Daniil\GlobalPay\Action\Payment\Dto\GnkPaymentRespDto;
use Daniil\GlobalPay\Action\Payment\Dto\MerchantPaymentRespFieldRespDto;
use Daniil\GlobalPay\Action\Payment\Dto\MerchantPaymentRespFieldRespDtoCollection;
use Daniil\GlobalPay\Action\Payment\Dto\PaymentFieldRespDto;
use Daniil\GlobalPay\Action\Payment\Dto\PaymentFieldRespDtoCollection;
use Daniil\GlobalPay\Action\Payment\Dto\PaymentRevertRespDto;
use Daniil\GlobalPay\Action\Payment\Dto\PaymentRevertRespDtoCollection;
use Daniil\GlobalPay\Action\Payment\Dto\ServiceRespDto;
use Daniil\GlobalPay\Enum\ProcessingType;
use Daniil\GlobalPay\Enum\Status;

/**
 * Class PaymentPerformResponse
 *
 * @package Daniil\GlobalPay\Action\Payment\Perform
 */
final class PaymentResponse
{
    /** Сумма платежа в тийнах */
    private int $amount;
    /** Время подтверждения платежа */
    private string $approvedAt;
    /** Сущность карты плательщика */
    private CardRespDto $card;
    /** Время создания платежа */
    private string $createdAt;
    /** Информация по пользователю (если пользователь физ. лицо) */
    private ?CustomerRespDto $customer;
    /** Уникальный идентификатор платежа (назначается мерчантом) */
    private string $externalId;
    /** Сущность ответа со стороны GNK */
    private GnkPaymentRespDto $gnkFields;
    /** Время отправки данных в ГНК */
    private string $gnkPerformedAt;
    /** UUID Уникальный идентификатор платежа в системе «Global Pay», его следует сохранить для следующего шага */
    private string $id;
    /** Список данных из пула мерчанта */
    private ?MerchantPaymentRespFieldRespDtoCollection $merchantPaymentRespFields;
    /** Время проведения платежа в рамках пула мерчанта (актуально только для PAYNET и MUNIS) */
    private ?string $merchantPerformedAt;
    /** Список данных по платежу */
    private ?PaymentFieldRespDtoCollection $paymentFields;
    /** Список данных по возвратам */
    private ?PaymentRevertRespDtoCollection $paymentReverts;
    /** Идентификатор процессингового центра */
    private string $processingId;
    /** Тип процессингового центра (UZCARD, HUMO, VM) */
    private ProcessingType $processingType;
    /** Сущность сервиса поставщика услуг */
    private ?ServiceRespDto $service;
    /** Статус транзакции (INIT, VALIDATE, APPROVED, PARTIAL_REVERT, REVERT, FAILED, NEED_REVERT) */
    private Status $status;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->externalId = $data['externalId'];
        $this->processingId = $data['processingId'];
        $this->amount = (int)$data['amount'];
        $this->status = Status::tryFrom($data['status']);
        $this->processingType = ProcessingType::tryFrom($data['processingType']);
        $this->createdAt = $data['createdAt'];
        $this->approvedAt = $data['approvedAt'];
        $this->gnkPerformedAt = $data['gnkPerformedAt'];
        $this->merchantPerformedAt = $data['merchantPerformedAt'];
        $this->card = new CardRespDto($data['card']);
        $this->service = array_key_exists('service', $data) ? new ServiceRespDto($data['service']) : null;
        $this->customer = array_key_exists('customer', $data) ? new CustomerRespDto($data['customer']) : null;
        $this->gnkFields = new GnkPaymentRespDto($data['gnkFields']);
        $this->paymentReverts = $this->mapPaymentReverts($data['paymentReverts']);
        $this->paymentFields = $this->mapPaymentFields($data['paymentFields']);
        $this->merchantPaymentRespFields = array_key_exists('merchantPaymentRespFields', $data) ?
            $this->mapMerchantPaymentRespFields($data['merchantPaymentRespFields']) : null;
    }

    private function mapPaymentReverts(?array $data): ?PaymentRevertRespDtoCollection
    {
        $result = new PaymentRevertRespDtoCollection();
        foreach ($data as $item) {
            $result->add(new PaymentRevertRespDto($item));
        }
        return $result->count() > 0 ? $result : null;
    }

    private function mapPaymentFields(?array $data): ?PaymentFieldRespDtoCollection
    {
        $result = new PaymentFieldRespDtoCollection();
        foreach ($data as $item) {
            $result->add(new PaymentFieldRespDto($item));
        }
        return $result->count() > 0 ? $result : null;
    }

    private function mapMerchantPaymentRespFields(?array $data): ?MerchantPaymentRespFieldRespDtoCollection
    {
        $result = new MerchantPaymentRespFieldRespDtoCollection();
        foreach ($data as $item) {
            $result->add(new MerchantPaymentRespFieldRespDto($item));
        }
        return $result->count() > 0 ? $result : null;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getApprovedAt(): string
    {
        return $this->approvedAt;
    }

    public function getCard(): CardRespDto
    {
        return $this->card;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getCustomer(): CustomerRespDto
    {
        return $this->customer;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function getGnkFields(): GnkPaymentRespDto
    {
        return $this->gnkFields;
    }

    public function getGnkPerformedAt(): string
    {
        return $this->gnkPerformedAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMerchantPaymentRespFields(): ?MerchantPaymentRespFieldRespDtoCollection
    {
        return $this->merchantPaymentRespFields;
    }

    public function getMerchantPerformedAt(): ?string
    {
        return $this->merchantPerformedAt;
    }

    public function getPaymentFields(): ?PaymentFieldRespDtoCollection
    {
        return $this->paymentFields;
    }

    public function getPaymentReverts(): ?PaymentRevertRespDtoCollection
    {
        return $this->paymentReverts;
    }

    public function getProcessingId(): string
    {
        return $this->processingId;
    }

    public function getProcessingType(): ProcessingType
    {
        return $this->processingType;
    }

    public function getService(): ServiceRespDto
    {
        return $this->service;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}
