<?php

namespace App\Controller\admin;

use App\Entity\Parcours;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ParcoursType;
use App\Repository\ParcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParcoursController extends AbstractController
{
    //#[Route('/parcours', name: 'app_parcours')]
    /*public function index(): Response
    {
        return $this->render('parcours/index.html.twig', [
            'controller_name' => 'ParcoursController',
        ]);
    }*/

    public function afficher(ParcoursRepository $parcoursRepository): Response
    {
        $parcours = $parcoursRepository->findAll();

        return $this->render('admin/maquettes/parcours/index.html.twig', [
            'parcours' => $parcours,
        ]);
    }


    public function ajouter(Request $request, EntityManagerInterface $em)
    {
        $parcours = new Parcours();

        $form = $this->createForm(ParcoursType::class, $parcours);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($parcours);
            $em->flush();
            $this ->addFlash('Success', 'Le parcours enregistré avec succès.');
            return $this->redirectToRoute('parcours');
        }

        return $this->render('admin/maquettes/parcours/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    public function modifier(Request $request, EntityManagerInterface $em, Parcours $parcours)
    {
        $form = $this->createForm(ParcoursType::class, $parcours);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this -> addFlash('success', 'Le parcours a été modifié avec succès.');
            return $this->redirectToRoute('parcours');
        }

        return $this->render('admin/maquettes/parcours/modifier.html.twig', [
            'parcours'=> $parcours, 'form' => $form,
        ]);
    }

    public function supprimer (Parcours $parcours, EntityManagerInterface $em){
        $em -> remove($parcours);
        $em -> flush();
        $this -> addFlash('success', 'Le parcours de compétence a été supprimé avec succès.');
        return $this->redirectToRoute('parcours');
    }

}
