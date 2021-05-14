<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Model\PersonneDTO;
use FOS\RestBundle\View\View;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Serializer\SerializerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Repository\PersonneRepository

class PersonneController extends AbstractFOSRestController
{


    /**
     * @Route("/personne/xml", name="personnebis")
     */
    public function indexml(SerializerInterface $serializer): Response
    {

        $repo=$this->getDoctrine()->getRepository(Personne::class);
        $personnes=$repo->findAll();

        $personnes=$serializer->serialize($personnes, 'xml');


        $response = new Response($personnes);
        $response->headers->set('Content-Type', 'xml');

        return $response;
    }
    /**
     * @Route("/api/personne", name="personne")
     * @Rest\View()
     * @return View
     */
    public function index()
    {
        $repo=$this->getDoctrine()->getRepository(Personne::class);
        $personnes=$repo->findAll();
        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
        // return $this->view(["personnes" => $personnes], 200);
    }

    /**
     * @Rest\Get(path="/api/personne", name="personne_getall")
     */
    public function getAll(PersonneRepository $repo)
    {
        return $this->view([
            "Personnes"=>$repo->findAll()
         ]);
    }
    /**
     * @Rest\Post(path="/api/personne/imageverif/{personne}", name="personne_image_verif")
     * @Rest\View()
     * @param EntityManagerInterface $em
     * @param Request $req
     * @return View
     */
    public function pathImageVerif(Request $req, EntityManagerInterface $em, Personne $personne) {

        // if (sizeof($violations) > 0) {
        //     return $this->view(["errors" => $violations]);
        // }
    //    dump($req->files->get('filephotoverif'));
       $filephotoverif=$req->files->get('filephotoverif');
       $filerectocarteid=$req->files->get('filerectocarteid');
       $fileversocarteid=$req->files->get('fileversocarteid');
       
        if( $filephotoverif!=null ){
            $bin=file_get_contents($filephotoverif->getPathname());
            $personne->setphotoverif($bin);
            $personne->setmimeTypephotoverif($filephotoverif->getMimeType());
            $em=$this->getDoctrine()->getManager();
            $em->persist($personne);
        }
        if( $filerectocarteid!=null ){
            $bin=file_get_contents($filerectocarteid->getPathname());
            $personne->setrectocarteid($bin);
            $personne->setmimeTyperectocarteid($filerectocarteid->getMimeType());
            $em=$this->getDoctrine()->getManager();
            $em->persist($personne);
        }
        if( $fileversocarteid!=null ){
            $bin=file_get_contents($fileversocarteid->getPathname());
            $personne->setversocarteid($bin);
            $personne->setmimeTypeversocarteid($fileversocarteid->getMimeType());
            $em=$this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();
        }
        
    }
}
