<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Repository;

use Daniil\GlobalPay\Entity\Card;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class CardRepository
 *
 * @package Daniil\GlobalPay\Repository
 */
final class CardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Card::class);
    }

    /**
     * @return Card[] Returns an array of Card objects
     */
    public function findByOwner(string $owner): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.owner = :owner')
            ->setParameter('owner', $owner)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function save(Card $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
