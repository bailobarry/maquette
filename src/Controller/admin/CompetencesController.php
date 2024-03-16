<?php

namespace App\Controller\admin;

use App\Entity\Competences;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CompetencesType;
use App\Repository\CompetencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompetencesController extends AbstractController
{
    //#[Route('/competences', name: 'app_competences')]
    /*public function index(): Response
    {
        return $this->render('competences/index.html.twig', [
            'controller_name' => 'CompetencesController',
        ]);
    }*/

    public function afficher(CompetencesRepository $competenceRepository): Response
    {
        $Competences = $competenceRepository->findAll();

        return $this->render('admin/maquettes/competences/index.html.twig', [
            'Competences' => $Competences,
        ]);
    }


    public function ajouter(Request $request, EntityManagerInterface $em)
    {
        $Competence = new Competences();

        $form = $this->createForm(CompetencesType::class, $Competence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($Competence);
            $em->flush();
            $this ->addFlash('Success', 'Compétence enregistré avec succès.');
            return $this->redirectToRoute('competence');
        }

        return $this->render('admin/maquettes/competences/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    public function modifier(Request $request, EntityManagerInterface $em, Competences $Competence)
    {
        $form = $this->createForm(CompetencesType::class, $Competence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this -> addFlash('success', 'Compétence a été modifié avec succès.');
            return $this->redirectToRoute('competence');
        }

        return $this->render('admin/maquettes/competences/modifier.html.twig', [
            'Comptence'=>$Competence, 'form' => $form,
        ]);
    }

    public function supprimer (Competences $Competence, EntityManagerInterface $em){
        $em -> remove($Competence);
        $em -> flush();
        $this -> addFlash('success', 'Compétence a été supprimé avec succès.');
        return $this->redirectToRoute('competence');
    }

}
