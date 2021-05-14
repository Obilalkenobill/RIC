<?php

namespace App\Repository;

use App\Entity\SignalCommentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SignalCommentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method SignalCommentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method SignalCommentaire[]    findAll()
 * @method SignalCommentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SignalCommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SignalCommentaire::class);
    }

    // /**
    //  * @return SignalCommentaire[] Returns an array of SignalCommentaire objects
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
    public function findOneBySomeField($value): ?SignalCommentaire
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
