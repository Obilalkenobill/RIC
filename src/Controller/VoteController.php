<?php

namespace App\Controller;

use App\Entity\Vote;
use App\Repository\PersonneRepository;
use App\Repository\VoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class VoteController
 * @package App\Controller
 * @Route (path="/api/vote")
 */
class VoteController extends AbstractFOSRestController
{

    /**
     * @Rest\Post("", name="appVotePost")
     * @Rest\View()
     * @ParamConverter("vote",converter="fos_rest.request_body")
     */
    public function vote(Vote $vote){
        $votebis=new Vote();
        $votebis->setCreationDate(new \DateTime("now"));
        $votebis->setPersonneId($vote->getPersonneId());
        $votebis->setAVote($vote->getAVote());
        $votebis->setBullVote($vote->getBullVote());
        $votebis->setProjetId($vote->getProjetId());
        // dump($vote);
        $em = $this->getDoctrine()->getManager();
        // dump("etape 1");
        // $em->persist($vote);
        $em->persist($votebis);
        $em->flush($votebis);
        return $this->view(Response::HTTP_CREATED);
    }

    /**
     * @Rest\Post("/voteByProjUser", name="appVoteByProjUser")
     * @Rest\View()
     * @ParamConverter("vote",converter="fos_rest.request_body")
     */
    public function getVoteUserById(Vote $vote, VoteRepository $voteRepo){
        
        $voteReturn=$voteRepo->findOneBybis($vote->getProjetId()->getId(),$vote->getPersonneId()->getId());
        if($voteReturn===[])
        {
         return null;
        }
        return $this->view($voteReturn);
    }
}
