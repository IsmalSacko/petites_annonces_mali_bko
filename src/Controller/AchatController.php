<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Entity\Annonces;
use App\Form\AchatType;
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
               'id' => $achat->getId()
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
     * @return Response
     */
    public function show(Achat $achat) :Response{
        return $this->render('achat/show.html.twig',[
            'achat' => $achat,
        ]);
    }
}
