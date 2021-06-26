<?php

namespace App\Controller;

use App\Entity\Meuble;
use App\Entity\Panier;
use App\Form\MeubleType;
use App\Repository\MeubleRepository;
use App\Repository\PanierRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MeubleController extends AbstractController{

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var MeubleRepository
     */
    private $meubleRepository;
  
    public function __construct(EntityManagerInterface $manager,
                                 MeubleRepository $meubleRepository,
                                 PanierRepository $panierRepository)
    {
        $this->manager = $manager;
        $this->meubleRepository = $meubleRepository;
        $this->panierRepository = $panierRepository;
    }

    /**
     * @Route("/meubles/create", name="create_meuble")
     * @IsGranted("ROLE_ADMIN")
     */
    public function createMeuble(Request $request){
        $meuble = new Meuble();

        $form = $this->createForm(MeubleType::class, $meuble);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $meuble->setCreatedAt(new DateTime());
            $this->manager->persist($meuble);
            $this->manager->flush();
            return $this->redirectToRoute('list_meuble');
        }

        return $this->render('meubles/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/meubles", name="list_meuble")
     */
    public function listMeuble(Request $request){
        $meubleList = $this->meubleRepository->findAll();
        return $this->render('meubles/list.html.twig', ['meubleList' => $meubleList]);
    }

    /**
     * @Route("/meubles/{id}", name="detail_meuble", requirements={"id"="\d+"})
     */
    public function detailMeuble(Request $request, int $id){
        $meuble = $this->meubleRepository->find($id);
        if($meuble == null){
            throw new HttpException(404);
        }
        return $this->render('meubles/detail.html.twig', ['meuble' => $meuble]);
    }

    /**
     * @Route("/meubles/delete/{id}", name="delete_meuble", requirements={"id"="\d+"})
     */
    public function deleteMeuble(Request $request, int $id){
        $meuble = $this->meubleRepository->find($id);

        $this->manager->remove($meuble);
        $this->manager->flush();

        return $this->redirectToRoute('list_meuble');
    }

    /**
     * @Route("/meubles/update/{id}", name="update_meuble", requirements={"id"="\d+"})
     */
    public function updateMeuble(Request $request, int $id){
        $meuble = $this->meubleRepository->find($id);
        if($meuble == null){
            throw new HttpException(404);
        }

        $form = $this->createForm(MeubleType::class, $meuble);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($meuble);
            $this->manager->flush();
            return $this->redirectToRoute('list_meuble');
        }

        return $this->render('meubles/update.html.twig', ['form' =>$form->createView()]);
    }
 
    /**
     * @Route("/meubles/{id}/addToCart", name="add_to_cart", requirements={"id"="\d+"})
     */
    public function addMeubleToPanier(Request $request, int $id){
        $meuble = $this->meubleRepository->find($id);
        if($meuble == null){
            throw new HttpException(404); 
        }

        $panier = $this->panierRepository->findByUserAndMeuble($this->getUser(), $meuble);
        if($panier == null){
        $panier = new Panier();
        $panier->setMeuble($meuble);
        $panier->setQuantity(1);
        $panier->setUser($this->getUser());
        }
        else{
            $panier->setQuantity($panier->getQuantity() +1);
        }

        $this->manager->persist($panier);
        $this->manager->flush();

        $this->addFlash('notif', 'Votre produit à bien été ajouté au panier !');
        return $this->redirectToRoute('detail_meuble', ['id' => $id]);
    }
}