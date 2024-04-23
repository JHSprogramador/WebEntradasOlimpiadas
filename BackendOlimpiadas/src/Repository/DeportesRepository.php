<?php

namespace App\Repository;

use App\Entity\Deportes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Deportes>
 *
 * @method Deportes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deportes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deportes[]    findAll()
 * @method Deportes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeportesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deportes::class);
    }

    //    /**
    //     * @return Deportes[] Returns an array of Deportes objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Deportes
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
