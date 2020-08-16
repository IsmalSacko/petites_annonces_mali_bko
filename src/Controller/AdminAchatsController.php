<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Entity\Comment;
use App\Form\AchatType;
use App\Form\PanierType;
use App\Repository\AchatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAchatsController extends AbstractController
{
    /**
     * @Route("/admin/achats", name="admin_achat_index")
     * @param AchatRepository $achatRepository
     * @return Response
     */
    public function index(AchatRepository $achatRepository)
    {
        return $this->render('admin/achat/index.html.twig', [
            'achats' => $achatRepository->findAll(),
        ]);
    }

    /**
     * Permet de modifier ou éditer un panier
     * @Route("/admin/achats/{id}/edit", name="admin_achat_edit")
     * @param Achat $achat
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function edit(Achat $achat, Request $request, EntityManagerInterface $manager) : Response{
        $form = $this->createForm(PanierType::class, $achat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($achat);
            $manager->flush();
            $this->addFlash('success',
                "Les modification du panier <strong>n°{$achat->getId()}</strong> ont bien été enrzgistrées"
            );
           return $this->redirectToRoute('admin_achat_index');
        }
        return $this->render('admin/achat/edit.html.twig',[
            'form' =>$form->createView(),
            'achats' =>$achat,
        ]);
    }

    /**
     * Permet supprimer un panier
     * @Route("/admin/achats/{id}/delete", name="admin_achat_delete")
     * @param Achat $achat
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Achat $achat, EntityManagerInterface $manager) : Response{

            $manager->remove($achat);
            $manager->flush();
            $this->addFlash('success',
                "Les modification du panier <strong>n°{$achat->getId()}</strong> ont bien été supprimé !"
            );

        return $this->redirectToRoute('admin_achat_index');
    }
}
