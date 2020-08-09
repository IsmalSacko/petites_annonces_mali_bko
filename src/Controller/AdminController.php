<?php

namespace App\Controller;

use App\Repository\AnnoncesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/admin", name="admin_ad")
     */
    public function adminAd(AnnoncesRepository $annoncesRepository)
    {
        return $this->render('admin/ad/index.html.twig', [
            'ads' => $annoncesRepository->findAll(),
        ]);
    }
}
