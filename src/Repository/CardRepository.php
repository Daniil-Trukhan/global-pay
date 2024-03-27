<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Daniil\GlobalPay\Entity\Card;
use Symfony\Component\Security\Core\User\UserInterface;

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
    public function findMy(UserInterface $user): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.owner = :user')
            ->setParameter('user', $user)
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
