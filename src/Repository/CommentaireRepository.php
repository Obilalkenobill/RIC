<?php

namespace App\Repository;

use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }
    public function addCommentRepo($commentaire, $personne_id,$projet_id,$commRefID) 
     {
        $conn = $this->getEntityManager()->getConnection();
        $date=new \DateTime("now");
        $creation_date = $date->format('Y-m-d H:i:s');
        $sql="";
        if($commRefID!=null){
        $sql = '
        INSERT INTO commentaire (projet_id_id, personne_id_id, commentaire, creation_date,commentaire_referent_id_id)
        VALUES ('.$projet_id.','.$personne_id.',"'.$commentaire.'","'.$creation_date.'",'.$commRefID.');';
        }
        else{
            $sql = '
            INSERT INTO commentaire (projet_id_id, personne_id_id, commentaire, creation_date)
            VALUES ('.$projet_id.','.$personne_id.',"'.$commentaire.'","'.$creation_date.'");';
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    public function findCommentByProjetID($projet_id) 
    {
       $conn = $this->getEntityManager()->getConnection();
       $sql = '
      SELECT c.id,c.commentaire,c.creation_date,c.personne_id_id,c.projet_id_id,c.commentaire_referent_id_id,p.login as login FROM commentaire c INNER JOIN personne p ON c.personne_id_id=p.id WHERE c.projet_id_id='.$projet_id.';';
       $stmt = $conn->prepare($sql);
       $stmt->execute();

       // returns an array of arrays (i.e. a raw data set)
       return $stmt->fetchAllAssociative();
   }

   public function updateComment($commentaire,$id){
    $conn = $this->getEntityManager()->getConnection();
    $date=new \DateTime("now");
    $creation_date = $date->format('Y-m-d H:i:s');
    $sql = '
    UPDATE commentaire SET commentaire ="'.$commentaire.'",creation_date="'.$creation_date.'" WHERE  id='.$id.';';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // returns an array of arrays (i.e. a raw data set)
    return $stmt->fetchAllAssociative();
   }
    // /**
    //  * @return Commentaire[] Returns an array of Commentaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commentaire
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
