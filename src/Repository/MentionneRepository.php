<?php

namespace App\Repository;

use App\Entity\Mentionne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mentionne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mentionne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mentionne[]    findAll()
 * @method Mentionne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MentionneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mentionne::class);
    }

    // /**
    //  * @return Mentionne[] Returns an array of Mentionne objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mentionne
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
