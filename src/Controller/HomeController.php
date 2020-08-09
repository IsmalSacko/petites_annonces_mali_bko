<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Comment;
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
        $comment = new Comment();
        $content = 'Binvenue sur "Petites_Annonces"';
        return $this->render('home/index.html.twig', [
            'content' =>$content,
            'ads' => $annoncesRepository->findAll(),
            'cmt' => $comment
        ]);
    }

}
