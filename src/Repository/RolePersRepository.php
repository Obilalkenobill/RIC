<?php

namespace App\Repository;

use App\Entity\Personne;
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
    public function deleteRoleUser(RolePers $role_pers): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $personne_id=$role_pers->getPersonneId()->getId();
        $role_id=$role_pers->getRoleId()->getId();
        $sql = '
          DELETE FROM role_pers WHERE personne_id_id='.$personne_id.' and role_id_id='.$role_id;
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }
    public function deleteUserRoleUser(Personne $personne): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $personne_id=$personne->getId();
        $sql = '
          DELETE FROM role_pers WHERE personne_id_id='.$personne_id;
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }
}
