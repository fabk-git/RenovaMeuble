<?php

namespace App\Controller;

use App\Repository\MeubleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    /**
     * @var MeubleRepository
     */
    private $meubleRepository;

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(MeubleRepository $meubleRepository,
                                PaginatorInterface $paginator)
    {
        $this->meubleRepository = $meubleRepository;
        $this->paginator = $paginator;
    }

    /**
     * @Route("/", name="home")
     */
    public function home(Request $request){
        $meubleList = $this->meubleRepository->findOrderByCreationDate();

        $pagination = $this->paginator->paginate(
            $meubleList,
            $request->query->getInt('page', 1), /*page number*/
            3
        );

        return $this->render("home.html.twig", ['pagination' => $pagination]);
    }


}