<?php

namespace App\Controller\admin;

use App\Entity\BlocsCompetences;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\BlocsCompetencesType;
use App\Repository\BlocsCompetencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlocsCompetencesController extends AbstractController
{
   
    /* public function index(Request $request, EntityManagerInterface $em): Response
    {
        $blocsCompetences = $em->getRepository(BlocCompetence::class)->findAll();

        return $this->render('admin/maquette/bloc_competences/index.html.twig', [
            'blocs_competences' => $blocsCompetences,
        ]);
    }*/
    public function afficher(BlocsCompetencesRepository $blocCompetenceRepository): Response
    {
        $blocCompetences = $blocCompetenceRepository->findAll();

        return $this->render('admin/maquettes/blocs_competences/index.html.twig', [
            'blocCompetences' => $blocCompetences,
        ]);
    }


    
    public function ajouter(Request $request, EntityManagerInterface $em)
    {
        $blocCompetence = new BlocsCompetences();

        $form = $this->createForm(BlocsCompetencesType::class, $blocCompetence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($blocCompetence);
            $em->flush();
            $this ->addFlash('Success', 'Bloc enregistré avec succès.');
            return $this->redirectToRoute('blocs_competences');
        }

        return $this->render('admin/maquettes/blocs_competences/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

   
    public function modifier(Request $request, EntityManagerInterface $em, BlocsCompetences $blocCompetence)
    {
        $form = $this->createForm(BlocsCompetencesType::class, $blocCompetence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this -> addFlash('success', 'Le bloc a été modifié avec succès.');
            return $this->redirectToRoute('blocs_competences');
        }

        return $this->render('admin/maquettes/blocs_competences/modifier.html.twig', [
            'blocComptence'=>$blocCompetence, 'form' => $form,
        ]);
    }

    
    public function supprimer (BlocsCompetences $blocCompetence, EntityManagerInterface $em){
        $em -> remove($blocCompetence);
        $em -> flush();
        $this -> addFlash('success', 'Le bloc de compétence a été supprimé avec succès.');
        return $this->redirectToRoute('blocs_competences');
    }
}