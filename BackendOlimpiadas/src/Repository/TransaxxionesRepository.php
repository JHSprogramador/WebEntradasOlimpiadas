<?php

namespace App\Repository;

use App\Entity\Transaxxiones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Transaxxiones>
 *
 * @method Transaxxiones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transaxxiones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transaxxiones[]    findAll()
 * @method Transaxxiones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransaxxionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaxxiones::class);
    }

    //    /**
    //     * @return Transaxxiones[] Returns an array of Transaxxiones objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Transaxxiones
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
