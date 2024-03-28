<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Entity;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Daniil\GlobalPay\Enum\Status;
use OpenApi\Attributes as OA;

#[OA\Schema(title: 'Payment model', description: 'Payment model')]
#[ORM\Entity]
#[ORM\Table(name: 'payment')]
class Payment
{
    #[OA\Property(title: 'Bank response', description: 'Bank response', format: 'string')]
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $bankResponse;

    #[OA\Property(
        title: 'Created date',
        description: 'Created date',
        type: 'string',
        format: 'datetime'
    )]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $createdAt = null;

    #[OA\Property(title: 'External Id', description: 'External Id', format: 'string')]
    #[ORM\ManyToOne]
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $externalId;

    #[OA\Property(title: 'ID', description: 'ID', format: 'int64')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[OA\Property(title: 'Payer', description: 'Payer', format: 'string')]
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $payer;

    #[OA\Property(title: 'Status', description: 'Status', format: 'string', enum:['INIT', 'VALIDATE','APPROVED','PARTIAL_REVERT', 'REVERT', 'FAILED', 'NEED_REVERT'])]
    #[ORM\Column(type: Types::STRING, enumType: Status::class)]
    private Status $status;

    #[OA\Property(title: 'Sum', description: 'Sum', format: 'int64')]
    #[ORM\Column(type: Types::INTEGER)]
    private int $sum;

    #[OA\Property(title: 'Transaction Id', description: 'Transaction Id', format: 'string')]
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

    public function getPayer(): ?string
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

    public function setPayer(?string $payer): Payment
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
