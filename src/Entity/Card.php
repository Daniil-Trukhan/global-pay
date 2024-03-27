<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Entity;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Daniil\GlobalPay\Enum\ProcessingType;

#[ORM\Entity]
class Card
{
      
    /** Баланс карты на момент её подтверждения */
    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?int $balance;
    /** Наименование банка, выпустившего карту и производящий ее обслуживание */
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $bankName;
    /** Номер карты «под маской» */
    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private string $cardNumber;
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $createdAt = null;
    /** Срок действия карты */
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $expiryDate;
    /** Имя и фамилия владельца карты */
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $holderFullName;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $owner;
    /** Тип карты в рамках процессингового центра (UZCARD, HUMO, VM) */
    #[ORM\Column(type: Types::TEXT, nullable: true, enumType: ProcessingType::class)]
    private ?ProcessingType $processingType;
    /**  UUID Подтвержденный токен карты в системе «Global Pay» */
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $token;

    public function getBalance(): ?int
    {
        return $this->balance;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getExpiryDate(): ?string
    {
        return $this->expiryDate;
    }

    public function getHolderFullName(): ?string
    {
        return $this->holderFullName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function getProcessingType(): ?ProcessingType
    {
        return $this->processingType;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setBalance(?int $balance): Card
    {
        $this->balance = $balance;
        return $this;
    }

    public function setBankName(?string $bankName): Card
    {
        $this->bankName = $bankName;
        return $this;
    }

    public function setCardNumber(string $cardNumber): Card
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    public function setCreatedAt(?DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setExpiryDate(?string $expiryDate): Card
    {
        $this->expiryDate = $expiryDate;
        return $this;
    }

    public function setHolderFullName(?string $holderFullName): Card
    {
        $this->holderFullName = $holderFullName;
        return $this;
    }

    public function setId(?int $id): Card
    {
        $this->id = $id;
        return $this;
    }

    public function setOwner(?string $owner): Card
    {
        $this->owner = $owner;
        return $this;
    }

    public function setProcessingType(?ProcessingType $processingType): Card
    {
        $this->processingType = $processingType;
        return $this;
    }

    public function setToken(?string $token): Card
    {
        $this->token = $token;
        return $this;
    }
}
