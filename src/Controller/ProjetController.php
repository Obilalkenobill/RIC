<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Follow;
use App\Entity\Personne;
use App\Entity\Projet;
use App\Model\ProjetDTO;
use App\Repository\CommentaireRepository;
use App\Repository\FollowRepository;
use FOS\RestBundle\View\View;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProjetController
 * @package App\Controller
 * @Route (path="/api/projet")
 */
class ProjetController extends AbstractFOSRestController
{
    private $repo;
    private $em;
    public function __construct(EntityManagerInterface $em){
    $this->em=$em;
    }
    /**
     * @Route("/projet", name="projet")
     */
    public function index(): Response
    {
        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
        ]);
    }

    /**
     * @Rest\Get (path="/readAll",name="api_projet_readAll")
     * @Rest\View()
     */
    public function readAll(ProjetRepository $repo){
        return $this->view(["projets"=> $repo->findAll()]);
    }
   /**
     * @Rest\Get (path="/{projet}",name="api_projet_getById")
     * @Rest\View()
     */
    public function getProjetById(Projet $projet, ProjetRepository $repo){
        $nbrBullNull=$repo->getNbreBullNull($projet);
        dump($nbrBullNull);
        $projet->setNbrVoteNull($nbrBullNull[0]["COUNT(*)"]);
        $nbrBullPour=$repo->getNbreBullPour($projet);
        $projet->setNbrVotePour($nbrBullPour[0]["COUNT(*)"]);
        $nbrBullContre=$repo->getNbreBullContre($projet);
        $projet->setNbrVoteContre($nbrBullContre[0]["COUNT(*)"]);
        $em = $this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();
        return $this->view([$repo->findOneBy(['id' => $projet->getId()])]);
    }

       /**
     * @Rest\Get (path="/byUser/{personne}",name="api_projet_getByUserId")
     * @Rest\View()
     */
    public function getProjetByUserId(Personne $personne, ProjetRepository $repo){
        $personne_id=$personne->getId();
        $projets=$repo->findProjetByUserRPO($personne_id);
        dump($projets);
        return $this->view( [$projets]);
    }

          /**
     * @Rest\Get (path="/byFollower/{personne}",name="api_projet_getFollower")
     * @Rest\View()
     */
    public function getProjetByFollower(Personne $personne, ProjetRepository $repo){
        $personne_id=$personne->getId();
        $projets=$repo->findProjetByFollower($personne_id);
        dump($projets);
        return $this->view( [$projets]);
    }

    /**
     * @Rest\Get (path="/comment/byProjetID/{projet}",name="api_projet_getComments")
     * @Rest\View()
     */
    public function getCommentByProjet(Projet $projet, ProjetRepository $repo,CommentaireRepository $repoC){
        // $projet_id=$projet->getId();
        // $comments=$repo->findCommentByProjetID($projet_id);
        $comments[]=$repoC->findBy(['projet_id' => $projet]);
        dump($comments);
        return $this->view(["commentaires"=>$comments]);
    }
  /**
     * @Rest\Post("/get/follow", name="appGetFollowByFollow")
     * @Rest\View()
     * @ParamConverter("follow",converter="fos_rest.request_body")
     */
    public function getRoleUserById(Follow $follow, FollowRepository $repo){
        dump($follow);
        $followReturn=$repo->findOneBy(['projet_id'=>$follow->getProjetId(),'personne_id'=>$follow->getPersonneId()]);
        dump($followReturn);
        return $this->view($followReturn);
    }

    /**
     * @Rest\Post("/create", name="appCreateProjet")
     * @Rest\View()
     * @ParamConverter("projet",converter="fos_rest.request_body")
     */
    public function addProjet(Projet $projet, ProjetRepository $repo){
        $projet->setCreationDate(new \DateTime("now"));
        dump($projet);
        $em = $this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();
        return $this->view(Response::HTTP_CREATED);
    }


    /**
     * @Rest\Delete(path="/delete/{projet}", name="delete_projet_byID")
     */
    public function deleteProjet(Projet $projet, ProjetRepository $projetRepo)
    {
       //  $personneRepo=$this->getDoctrine()->getRepository(Personne::class);
       //  $personne=$personneRepo->findOneBy(['id' => $id]);
    //    $projetRepo->deleteUserRoleUser($projet);
        $id=$projet->getId();
        $projetRepo->deleteProjet($id);
        
       return $this->view([
           'deleted',Response::HTTP_ACCEPTED
         ]);
       }

     /**
     * @Rest\Post("/create/follow", name="appCreateFollow")
     * @Rest\View()
     * @ParamConverter("follow",converter="fos_rest.request_body")
     */
    public function addFollow(Follow $follow){
        // $followbis=new Follow();
         dump($follow);
        // $followbis->setPersonneId($follow->getPersonneId());
        // $followbis->setProjetId($follow->getProjetId());
        $em = $this->getDoctrine()->getManager();
        $em->persist($follow);
        $em->flush();
        return $this->view(Response::HTTP_CREATED);
    }

        /**
     * @Rest\Post("/create/comment", name="appCreateComment")
     * @Rest\View()
     * @param EntityManagerInterface $em
     * @param Request $req
     * @return View
     */
    public function addComment(Request $req, CommentaireRepository $repo){
        dump($req);
        $data = json_decode($req->getContent(), true);
        $commentaire=$data["commentaire"];
        $personne_id=$data["personne_id"];
        $projet_id=$data["projet_id"];
        $repo->addCommentRepo($commentaire, $personne_id,$projet_id);
        // $followbis=new Follow();
        // $commentaire->setCreationDate(new \DateTime("now"));
        //  dump($commentaire);
        // // $followbis->setPersonneId($follow->getPersonneId());
        // // $followbis->setProjetId($follow->getProjetId());
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($commentaire);
        // $em->flush();
        // return $this->view(Response::HTTP_CREATED);
    }

        /**
     * @Rest\Post("/delete/follow", name="appDeleteFollow")
     * @Rest\View()
     * @ParamConverter("follow",converter="fos_rest.request_body")
     */
    public function unFollow(Follow $follow,ProjetRepository $repo){
        // $followbis=new Follow();
        $repo->deleteFollow($follow->getProjetId()->getId(),$follow->getPersonneId()->getId());
        return $this->view(Response::HTTP_ACCEPTED);
    }
}
