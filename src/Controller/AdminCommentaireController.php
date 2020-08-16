<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCommentaireController extends AbstractController
{
    /**
     * @Route("/admin/commentaire", name="admin_commentaire_index")
     * @param CommentRepository $commentRepository
     * @return Response
     */
    public function index(CommentRepository $commentRepository)
    {
        return $this->render('admin/commentaire/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }

    /**
     * Permat de modifier un commentaire par laiisé par utilisateur
     * @Route("/admin/commentaire/{id}/edit", name="admin_comment_edit")
     * @param Comment $comment
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public  function edit(Comment $comment, Request $request, EntityManagerInterface $manager) : Response{
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($comment);
            $manager->flush();
            $this->addFlash('success',
                "Les modifications du commentaires <strong>{$comment->getAd()}</strong> ont bien été enregistré !"
            );
           return $this->redirectToRoute('admin_commentaire_index');
        }
        return $this->render('admin/commentaire/edit.html.twig',[
            'form' =>$form->createView(),
            'comments' => $comment,
        ]);
    }

    /**
     * Permet de supprimer un commentaire laissé par un utilisateur
     * @Route("/admin/commentaire/{id}/delete", name="admin_comment_delete")
     * @param Comment $comment
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Comment $comment, EntityManagerInterface $manager) :Response{
        $manager->remove($comment);
        $manager->flush();
        $this->addFlash('success',
            "Le commentaires <strong>{$comment->getAd()}</strong> a bien été suppprimé !"
        );
        return $this->redirectToRoute('admin_commentaire_index');
    }
}
