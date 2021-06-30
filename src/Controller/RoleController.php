<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\RolePers;
use App\Repository\RolePersRepository;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class RoleController extends AbstractFOSRestController
{
    /**
     * @Route("/role", name="role")
     */
    public function index(): Response
    {
        return $this->render('role/index.html.twig', [
            'controller_name' => 'RoleController',
        ]);
    }

    /**
     * @Rest\Post("/api/create/role", name="app_create_role")
     * @Rest\View()
     * @ParamConverter("role",converter="fos_rest.request_body")
     */
    public function createRole(Role $role){
        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();
    }
     /**
     * @Rest\Post("/api/set/role", name="app_set_role")
     * @Rest\View()
     * @ParamConverter("role_pers",converter="fos_rest.request_body")
     */
    public function setRole(RolePers $role_pers){
        $em = $this->getDoctrine()->getManager();
        $em->persist($role_pers);
        $em->flush();
        return $this->view(["roles"=> $role_pers],Response::HTTP_CREATED);
      //$repo->setRole($rolePers->getPersonneId(),$rolePers->getRoleId());
    }
       /**
     * @Rest\Get(path="/api/roles", name="roles_getall")
     * @Rest\View()
     * @return View
     */
    public function getAllRoles(RoleRepository $repo)
    {
        return $this->view([
            "roles"=>$repo->findAll()
         ]);
    }
      /**
     * @Rest\Get(path="/api/role/{id}", name="role_getById")
     */
    public function getbyId($id)
    {
        $roleRepo=$this->getDoctrine()->getRepository(Role::class);
        $role=$roleRepo->findOneBy(['id' => $id]);
        return $this->view([
            $role
         ]);
    }
        /**
     * @Rest\Post("/api/roleUserById", name="appRoleUserByID")
     * @Rest\View()
     * @ParamConverter("role_pers",converter="fos_rest.request_body")
     */
    public function getRoleUserBybyId(RolePers $role_pers){
        $roleRepo=$this->getDoctrine()->getRepository(RolePers::class);
        $rolePers=$roleRepo->findOneBy(['role_id'=>$role_pers->getRoleId(),'personne_id'=>$role_pers->getPersonneId()]);
        return $this->view([$rolePers],Response::HTTP_CREATED);
      //$repo->setRole($rolePers->getPersonneId(),$rolePers->getRoleId());
    }
    /**
     * @Rest\Post("/api/delete/role", name="appDeleteRolePers")
     * @Rest\View()
     * @ParamConverter("role_pers",converter="fos_rest.request_body")
     */
    public function deleteRolePers(RolePers $role_pers,RolePersRepository $roleRepo){
      $roleRepo->deleteRoleUser($role_pers);
        return $this->view(["roles"=> $role_pers],Response::HTTP_ACCEPTED);
    }

      /**
     * @Rest\Post("/api/delete/role/role", name="appDeleteRolePersRole")
     * @Rest\View()
     * @ParamConverter("role_pers",converter="fos_rest.request_body")
     */
     public function deleteRolePersRole(RolePers $role_pers,RolePersRepository $roleRepo){
      $roleRepo->deleteRole($role_pers);
        return $this->view(["roles"=> $role_pers],Response::HTTP_ACCEPTED);
    }
}
