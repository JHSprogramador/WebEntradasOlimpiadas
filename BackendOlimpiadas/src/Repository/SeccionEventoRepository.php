<?php

namespace App\Repository;

use App\Entity\SeccionEvento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SeccionEvento>
 *
 * @method SeccionEvento|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeccionEvento|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeccionEvento[]    findAll()
 * @method SeccionEvento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeccionEventoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeccionEvento::class);
    }

    //    /**
    //     * @return SeccionEvento[] Returns an array of SeccionEvento objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SeccionEvento
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
