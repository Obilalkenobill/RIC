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
        return $this->view(["projets"=> $repo->findAllbis()]);
    }
   /**
     * @Rest\Get (path="/{projet}",name="api_projet_getById")
     * @Rest\View()
     */
    public function getProjetById(Projet $projet, ProjetRepository $repo){
        $nbrBullNull=$repo->getNbreBullNull($projet);
        $projet->setNbrVoteNull($nbrBullNull[0]["COUNT(*)"]);
        $nbrBullPour=$repo->getNbreBullPour($projet);
        $projet->setNbrVotePour($nbrBullPour[0]["COUNT(*)"]);
        $nbrBullContre=$repo->getNbreBullContre($projet);
        $projet->setNbrVoteContre($nbrBullContre[0]["COUNT(*)"]);
        $em = $this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();
        $projet_ID=$projet->getId();
        return $this->view($repo->findOneBybis($projet_ID));
    }

       /**
     * @Rest\Get (path="/byUser/{personne}",name="api_projet_getByUserId")
     * @Rest\View()
     */
    public function getProjetByUserId(Personne $personne, ProjetRepository $repo){
        $personne_id=$personne->getId();
        $projets=$repo->findProjetByUserRPO($personne_id);
        return $this->view( [$projets]);
    }

          /**
     * @Rest\Get (path="/byFollower/{personne}",name="api_projet_getFollower")
     * @Rest\View()
     */
    public function getProjetByFollower(Personne $personne, ProjetRepository $repo){
        $personne_id=$personne->getId();
        $projets=$repo->findProjetByFollower($personne_id);
        return $this->view( [$projets]);
    }

    /**
     * @Rest\Get (path="/comment/byProjetID/{projet}",name="api_projet_getComments")
     * @Rest\View()
     */
    public function getCommentByProjet(Projet $projet,CommentaireRepository $repoC){
        $projet_id=$projet->getId();
        $comments=$repoC->findCommentByProjetID($projet_id);
        return $this->view(["commentaires"=>$comments]);
    }
  /**
     * @Rest\Post("/get/follow", name="appGetFollowByFollow")
     * @Rest\View()
     * @ParamConverter("follow",converter="fos_rest.request_body")
     */
    public function getFollowUserById(Follow $follow, FollowRepository $repo){
        $followReturn=$repo->findOneBy(['projet_id'=>$follow->getProjetId(),'personne_id'=>$follow->getPersonneId()]);
        $bool=true;
        if($followReturn==[])
        {
          $bool=false;
        }
        return $this->view($bool);
    }

    /**
     * @Rest\Post("/create", name="appCreateProjet")
     * @Rest\View()
     * @ParamConverter("projet",converter="fos_rest.request_body")
     */
    public function addProjet(Request $req, Projet $projet, ProjetRepository $repo){
        $data = json_decode($req->getContent(), true);

        $projet->setCreationDate(new \DateTime("now"));
        $repo->insert($data["titre"],$data["descriptif"],$data["personne_id_id"]);
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
        $data = json_decode($req->getContent(), true);
        $commentaire=$data["commentaire"];
        $personne_id=$data["personne_id_id"];
        $projet_id=$data["projet_id_id"];
        $commRefID=null;
        if(isset($data["commentaire_referent_id_id"])){
            $commRefID=$data["commentaire_referent_id_id"];
        }
        $repo->addCommentRepo($commentaire, $personne_id,$projet_id,$commRefID);
    }

     /**
     * @Rest\Put("/patch/comment", name="appPAtchComment")
     * @Rest\View()
     * @param EntityManagerInterface $em
     * @param Request $req
     * @return View
     */
    public function updateComment(Request $req, CommentaireRepository $repo){
        $data = json_decode($req->getContent(), true);
        $commentaire=$data["commentaire"];
        $id=$data["id"];
        $repo->updateComment($commentaire, $id);
    }

        /**
     * @Rest\Post("/delete/follow", name="appDeleteFollow")
     * @Rest\View()
     * @ParamConverter("follow",converter="fos_rest.request_body")
     */
    public function unFollow(Follow $follow,ProjetRepository $repo){
        // $followbis=new Follow();
        $projet_id=$follow->getProjetId()->getId();
        $personne_id=$follow->getPersonneId()->getId();
        $repo->deleteFollow($projet_id,$personne_id);
        return $this->view(Response::HTTP_ACCEPTED);
    }
}
