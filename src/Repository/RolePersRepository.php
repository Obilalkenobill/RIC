<?php

namespace App\Repository;

use App\Entity\RolePers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RolePers|null find($id, $lockMode = null, $lockVersion = null)
 * @method RolePers|null findOneBy(array $criteria, array $orderBy = null)
 * @method RolePers[]    findAll()
 * @method RolePers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RolePersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RolePers::class);
    }

    // /**
    //  * @return RolePers[] Returns an array of RolePers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RolePers
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
