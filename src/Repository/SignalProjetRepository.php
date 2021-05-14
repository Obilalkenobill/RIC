<?php

namespace App\Repository;

use App\Entity\SignalProjet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SignalProjet|null find($id, $lockMode = null, $lockVersion = null)
 * @method SignalProjet|null findOneBy(array $criteria, array $orderBy = null)
 * @method SignalProjet[]    findAll()
 * @method SignalProjet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SignalProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SignalProjet::class);
    }

    // /**
    //  * @return SignalProjet[] Returns an array of SignalProjet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SignalProjet
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
