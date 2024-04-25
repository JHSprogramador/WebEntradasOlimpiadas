<?php

namespace App\Repository;

use App\Entity\UsuariosMeses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UsuariosMeses>
 *
 * @method UsuariosMeses|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsuariosMeses|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsuariosMeses[]    findAll()
 * @method UsuariosMeses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuariosMesesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsuariosMeses::class);
    }

    //    /**
    //     * @return UsuariosMeses[] Returns an array of UsuariosMeses objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UsuariosMeses
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
