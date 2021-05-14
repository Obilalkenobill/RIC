<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\RegisterType;
use App\Model\PersonneDTO;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use FOS\RestBundle\View\View;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\ConstraintViolationList;

class SecurityController extends AbstractFOSRestController
{
//    public $serializer ;
//    public $container;
//    public function __construct (ContainerInterface $container)
//    {
//        $this->serializer   = new Serializer(
//            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
//            [new JsonEncoder()]
//        );
//        $this->container=$container;
//    }
    /**
     * @Rest\Post(path="/api/login_check", name="api_login")
     */
    public function loginCheckAction() {
        $user = $this->getUser();
        return new JsonResponse(["username" => $user->getUsername(), "roles" => $user->getRoles()]);
    }
    /**
     * @Route("api/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("api/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    /**
     * @Route("api/activate/{salt}/{id}", name="app_activation")
     */
    public function activate ($salt,? Personne $personne){
        $personneRepo=$this->getDoctrine()->getRepository(Personne::class);
        $personnebis=$personneRepo->findOneBy(['salt' => $salt]);
        if (isset($personnebis) && isset($personne) && $personnebis->getId()==$personne->getId())
        {
            $personne->setIsActive(true);
            $personne->setCreationDate(new \DateTime("now"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/api/register", name="app_register")
     * @Rest\View()
     * @ParamConverter("dto",converter="fos_rest.request_body")
     */
    public function register(ConstraintViolationList $violations,PersonneDTO $dto,UserPasswordEncoderInterface $encoder, MailerInterface $mailer){
     if (sizeof($violations) > 0){
         return $this->view(["errors" => $violations]);
     }
        $salt=uniqid();
        $personne=$dto->toEntity();
        $personne->setSalt($salt);
        $encoded = $encoder->encodePassword($personne, $personne->getPassword());
        $personne->setPassword($encoded);
        $personne->setIsActive(false);
        $em = $this->getDoctrine()->getManager();
        $em->persist($personne);
        $em->flush();
        $email=new Email() ;
        $email->to($personne->getEmail());
        $email->subject('Bienvenue sur le site du referendum à initiative citoyen');
        $email->html('<div><a href="https://localhost:8000/api/activate/'.$personne->getSalt().'/'.$personne->getId().'">Veuillez cliquer sur ce lien pour activer votre compte </a></div>');
        $email->from("arbreplantebuisson@gmail.com");
        $mailer->send($email);
        return $this->view(["personne"=> $personne],Response::HTTP_CREATED);
    }
//        dump("TU PASSERAS PAR LA");
//        if ($req->getContentType() == 'json') {
//            dump("TU PASSERA PAR JSON");
//            $personne = $this->serializer->deserialize($req->getContent(),'App\Entity\Personne','json');
//            try{
//                $salt=uniqid();
//                $personne->setSalt($salt);
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($personne);
//                $em->flush();
//            }
//            catch (\Exception $exception){
//                return Response ();
//            }
//            return new Response();
//        } else {
//            dump("TU PASSERA PAR FORM");
//            $personne = new Personne();
//            $form = $this->createForm(RegisterType::class, $personne);
//            $form->handleRequest($req);
//            if ($form->isSubmitted() && $form->isValid()) {
//                $salt=uniqid();
//                $personne->setSalt($salt);
//                $personne->setIsActive(false);
//                dump($personne);
//                $encoded = $encoder->encodePassword($personne, $personne->getPassword());
//                $personne->setPassword($encoded);
////            $personne->setSalt(uniqid());
//                //les roles doivent commencer par ROLE_
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($personne);
//                $em->flush();
//            $email=new Email() ;
//            $email->to($personne->getEmail());
//            $email->subject('Bienvenue sur le site du referendum à initiative citoyen');
//            $email->html('<div><a href="https://localhost:8000/activate/'.$personne->getSalt().'/'.$personne->getId().'">Veuillez cliquer sur ce lien pour activer votre compte </a></div>');
//            $email->from("arbreplantebuisson@gmail.com");
//            $mailer->send($email);
//            $this->addFlash('success','enregistrement OK');
//                $this->redirectToRoute('home');
//            }
//            return $this->render('security/register.html.twig', [
//                'form' => $form->createView()
//            ]);
//        }
        //hashage pas d'inversion possible vs cryptage inversion possible()
        //password toujours hashé
}
