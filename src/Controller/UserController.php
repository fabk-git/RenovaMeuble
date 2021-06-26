<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends AbstractController{

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var UserPasswordHasherInterface
     */
    private $encoder;

    public function __construct(EntityManagerInterface $manager, UserPasswordHasherInterface $encoder)
    {
        $this->manager = $manager;
        $this->encoder = $encoder;
    }

    /**
     * @Route("/register", name="register_user")
     */
    public function registerUser(Request $request){   
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user->setRoles(["ROLE_USER"]);
            $encoderPassword = $this->encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($encoderPassword);

            $this->manager->persist($user);
            $this->manager->flush();
            return $this->redirectToRoute('app_login');
        }

        return $this->render('users/create_user.html.twig', ['form' => $form->createView()]);  

    }
 
    /**
     * @Route("/admin/register", name="register_admin")
     * @IsGranted("ROLE_ADMIN")
     */
    public function registerAdmin(Request $request){
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user->setRoles(["ROLE_ADMIN"]);
            $encoderPassword = $this->encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($encoderPassword);

            $this->manager->persist($user);
            $this->manager->flush();
            return $this->redirectToRoute('app_login');
        }

        return $this->render('users/create_user.html.twig', ['form' => $form->createView()]);  

    }

}