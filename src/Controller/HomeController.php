<?php

namespace App\Controller;

use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AnnoncesRepository $annoncesRepository)
    {
        $content = 'Binvenue sur "PetitsAnnonces"';
        return $this->render('home/index.html.twig', [
            'content' =>$content,
            'ads' => $annoncesRepository->findAll(),
        ]);
    }


}
