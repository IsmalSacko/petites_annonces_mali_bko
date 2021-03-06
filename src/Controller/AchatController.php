<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Entity\Annonces;
use App\Entity\Comment;
use App\Form\AchatType;
use App\Form\CommentFormType;
use phpDocumentor\Reflection\Types\This;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AchatController extends AbstractController
{
    /**
     * @Route("/annonce/{slug}/achat", name="achat")
     * @IsGranted("ROLE_USER")
     * @param Annonces $ads
     * @return Response
     */
    public function achat(Annonces $ads, Request $request) :Response
    {
        $achat = new Achat();
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();

            $achat->setAcheteur($user)
                  ->setAnnonce($ads)
                  ->setAmount($ads->getPrice());
           $em = $this->getDoctrine()->getManager();
           $em->persist($achat);
           $em->flush();
           return $this->redirectToRoute('achat_sohow', [
               'id' => $achat->getId(),
               'panier' => true
           ]);
        }
        return $this->render('achat/index.html.twig', [
            'ads' => $ads,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/annonce/achat/{id}", name="achat_sohow")
     * @param Achat $achat
     * @param Request $request
     * @return Response
     */
    public function show(Achat $achat, Request $request) :Response{
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();
            $comment->setAuthor($user)
                ->setAd($achat->getAnnonce());
           $em= $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        $this->addFlash('success',
            "Votre commentaire a bien été pris en compte");
        }
        return $this->render('achat/show.html.twig',[
            'achat' => $achat,
            'form' => $form->createView()
        ]);
    }
}
