<?php

namespace App\Controller;

use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class PanierController extends AbstractController{

    /**
     * @var PanierRepository
     */
    private $panierRepository;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(PanierRepository $panierRepository, EntityManagerInterface $manager)
    {
        $this->panierRepository = $panierRepository;
        $this->manager = $manager;
    }

    /**
     * @Route("/cart/empty", name="empty_cart")
     */
    public function emptyCart(Request $request){
        $paniers = $this->getUser()->getPaniers();
        foreach($paniers as $line){
            $this->manager->remove($line);
        }
        $this->manager->flush();

        return $this->redirectToRoute('get_cart');
    }

    /**
     * @Route("/cart{id}/delete", name="delete_panier", requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER")
     */
    public function deletePanier(Request $request, int $id){
        $panier = $this->panierRepository->find($id);
        $this->manager->remove($panier);
        $this->manager->flush();
        return $this->redirectToRoute('get_cart');
    }


    /**
     * @Route("/cart", name="get_cart")
     * @IsGranted("ROLE_USER")
     */
    public function getCart(Request $request){
        $paniers = $this->getUser()->getPaniers();
        $totalAmount = 0;
        foreach($paniers as $line){
            $lineAmount = $line->getMeuble()->getPrix() * $line->getQuantity();
            $line->setLineAmount($lineAmount);
            $totalAmount = $totalAmount + $lineAmount;
        }
        return $this->render("cart/cart.html.twig", [
            "paniers" => $paniers,
            "totalAmount" => $totalAmount
        ]);
    }
}