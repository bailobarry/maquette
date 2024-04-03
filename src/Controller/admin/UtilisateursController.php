<?php

namespace App\Controller\admin;

use App\Entity\Utilisateurs;
use App\Form\UtilisateursType;
use App\Repository\UtilisateursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateursController extends AbstractController
{
    //#[Route('/utilisateurs', name: 'app_utilisateurs')]
    /*public function index(): Response
    {
        return $this->render('utilisateurs/index.html.twig', [
            'controller_name' => 'UtilisateursController',
        ]);
    }*/

    public function afficher(UtilisateursRepository $utilisateursRepository): Response
    {
        $utilisateurs = $utilisateursRepository->findAll();

        return $this->render('admin/utilisateurs/index.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }

    public function ajouter(Request $request, EntityManagerInterface $em)
    {
        $utilisateurs = new Utilisateurs();

        $form = $this->createForm(UtilisateursType::class, $utilisateurs);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($utilisateurs);
            $em->flush();
            $this ->addFlash('Success', 'L\'utilisateur enregistré avec succès.');
            return $this->redirectToRoute('utilisateur');
        }

        return $this->render('admin/utilisateurs/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function modifier(Request $request, EntityManagerInterface $em, Utilisateurs $utilisateurs)
    {
        $form = $this->createForm(UtilisateursType::class, $utilisateurs);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this -> addFlash('success', 'L\'utilisateur a été modifié avec succès.');
            return $this->redirectToRoute('utilisateur');
        }

        return $this->render('admin/utilisateurs/modifier.html.twig', [
            'utilisateurs'=> $utilisateurs, 'form' => $form,
        ]);
    }

    public function supprimer (Utilisateurs $utilisateurs, EntityManagerInterface $em){
        $em -> remove($utilisateurs);
        $em -> flush();
        $this -> addFlash('success', 'L\'utilisateur a été supprimé avec succès.');
        return $this->redirectToRoute('utilisateur');
    }


}
