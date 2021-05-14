<?php

namespace App\Controller;

use App\Model\ProjetDTO;
use FOS\RestBundle\View\View;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ProjetController
 * @package App\Controller
 * @Route (path="/api/projet")
 */
class ProjetController extends AbstractFOSRestController
{
    private $repo;
    private $em;
    public function __construct(ProjetRepository $repo, EntityManagerInterface $em){
    $this->repo=$repo;
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
     * @Route (path="/readAll",name="api_projet_readAll")
     */
    public function readAll(){
        return $this->view(["projets"=> $this->repo->findAll()],Response::HTTP_FOUND);
    }

    /**
     * 
     */
    public function create(ProjetDTO $dto){
        $projet=$dto->toEntity();
        return $this->view(["projet" => $projet], Response::HTTP_CREATED);
    }
}
