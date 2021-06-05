<?php

namespace App\Repository;

use App\Entity\Projet;
use App\Entity\Vote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Projet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projet[]    findAll()
 * @method Projet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projet::class);
    }

    // /**
    //  * @return Projet[] Returns an array of Projet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Projet
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getNbreBullNull(Projet $projet): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $projet_id=$projet->getId();
        $sql = '
        SELECT COUNT(*)
        FROM vote
        WHERE projet_id='.$projet_id.' AND bull_vote is null;';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    public function getNbreBullPour(Projet $projet)
    {
        $conn = $this->getEntityManager()->getConnection();
        $projet_id=$projet->getId();
        $sql = '
        SELECT COUNT(*)
        FROM vote
        WHERE projet_id='.$projet_id.' AND bull_vote=1;';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }
    public function getNbreBullContre(Projet $projet): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $projet_id=$projet->getId();
        $sql = '
        SELECT COUNT(*)
        FROM vote
        WHERE projet_id='.$projet_id.' AND bull_vote=0;';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }
    public function findProjetByUserRPO($personne_id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT *
        FROM projet
        WHERE personne_id_id='.$personne_id;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }
}
