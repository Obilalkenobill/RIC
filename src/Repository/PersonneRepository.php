<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Personne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personne[]    findAll()
 * @method Personne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personne::class);
    }


    public function setRole($personne_id,$role_id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
           INSERT INTO role_pers (personne_id_id,role_id_id)
           VALUES (:personne_id,:role_id);
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['personne_id' => $personne_id, 'role_id'=>$role_id]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    public function setROLE_USERtoUserID($UserID){
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
           SELECT id FROM role WHERE label="ROLE_USER"
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        $role_id=$stmt->fetchAllAssociative();
        dump($role_id[0]["id"]);
        $role_id=$role_id[0]["id"];
        $sql = '
        INSERT INTO rolepers (personne_id,role_id) values('.$UserID.','.$role_id.');
         ';
     $stmt = $conn->prepare($sql);
     $stmt->execute();
    }
    // /**
    //  * @return Personne[] Returns an array of Personne objects
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
    public function findOneBySomeField($value): ?Personne
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
