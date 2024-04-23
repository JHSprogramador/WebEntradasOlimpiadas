<?php

namespace App\Repository;

use App\Entity\Estadios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Estadios>
 *
 * @method Estadios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estadios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estadios[]    findAll()
 * @method Estadios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadiosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estadios::class);
    }

    //    /**
    //     * @return Estadios[] Returns an array of Estadios objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Estadios
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
