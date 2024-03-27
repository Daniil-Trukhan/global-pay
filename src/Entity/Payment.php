<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Entity;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Daniil\GlobalPay\Enum\Status;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'payment')]
//#[ApiResource(
//    operations: [
//        new Get(
//            requirements: ['id' => '\d+'],
//            security: "object.getPayer() == user or is_granted('ROLE_ADMIN')",
//        ),
//           new GetCollection(
//            normalizationContext: ['groups' => ['payments:read']],
//            security: "is_granted('ROLE_ADMIN')",
//        ),
//    ],
//)]
class Payment
{
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bankResponse;
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $createdAt = null;
    #[ORM\ManyToOne]
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $externalId;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\ManyToOne]
    private UserInterface $payer;
    #[ORM\Column(type: Types::STRING, enumType: Status::class)]
    private Status $status;
    #[ORM\Column(type: Types::INTEGER)]
    private int $sum;
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $transactionId;

    public function getBankResponse(): ?string
    {
        return $this->bankResponse;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPayer(): UserInterface
    {
        return $this->payer;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function setBankResponse(?string $bankResponse): Payment
    {
        $this->bankResponse = $bankResponse;
        return $this;
    }

    public function setCreatedAt(?DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setExternalId(?string $externalId): Payment
    {
        $this->externalId = $externalId;
        return $this;
    }

    public function setId(?int $id): Payment
    {
        $this->id = $id;
        return $this;
    }

    public function setPayer(UserInterface $payer): Payment
    {
        $this->payer = $payer;
        return $this;
    }

    public function setStatus(Status $status): Payment
    {
        $this->status = $status;
        return $this;
    }

    public function setSum(int $sum): Payment
    {
        $this->sum = $sum;
        return $this;
    }

    public function setTransactionId(?string $transactionId): Payment
    {
        $this->transactionId = $transactionId;
        return $this;
    }
}
