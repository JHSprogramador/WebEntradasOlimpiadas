<?php

namespace App\Repository;

use App\Entity\Secciones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Secciones>
 *
 * @method Secciones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Secciones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Secciones[]    findAll()
 * @method Secciones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeccionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Secciones::class);
    }

    //    /**
    //     * @return Secciones[] Returns an array of Secciones objects
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

    //    public function findOneBySomeField($value): ?Secciones
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
