<?php

namespace App\Controller;

use App\Entity\Diplomes;
use App\Form\DiplomesType;
use App\Repository\DiplomesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DiplomesController extends AbstractController
{
    //#[Route('/diplomes', name: 'app_diplomes')]
    /*public function index(): Response
    {
        return $this->render('diplomes/index.html.twig', [
            'controller_name' => 'DiplomesController',
        ]);
    }*/

    public function afficher(DiplomesRepository $diplomeRepository): Response
    {
        $diplomes = $diplomeRepository->findAll();

        return $this->render('admin/maquettes/diplomes/index.html.twig', [
            'diplomes' => $diplomes,
        ]);
    }

    public function ajouter(Request $request, EntityManagerInterface $em){
        $diplome  = new Diplomes();
        $formulaire = $this->createForm(DiplomesType::class, $diplome);
        $formulaire -> handleRequest($request);
        if($formulaire -> isSubmitted() && $formulaire -> isValid()){
            $em -> persist($diplome);
            $em -> flush();
            $this ->addFlash('Success', 'Diplôme enregistré avec succès.');
            return $this ->redirectToRoute('diplome');
        }
        return $this -> render('admin/maquettes/diplomes/ajouter.html.twig', ['formulaire' => $formulaire->createView(),]);
    }

    public function modifier(Diplomes $diplome, Request $request, EntityManagerInterface $em){
        $formulaire = $this->createForm(DiplomesType::class, $diplome);
        $formulaire -> handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $em -> flush();
            $this -> addFlash('success', 'Le diplôme a été modifié avec succès.');
            return $this->redirectToRoute('diplome');
        }
        return $this->render('admin/maquettes/diplomes/modifier.html.twig', ['diplome' => $diplome, 'formulaire' => $formulaire]);
    }

    public function supprimer (Diplomes $diplome, EntityManagerInterface $em){
        $em -> remove($diplome);
        $em -> flush();
        $this -> addFlash('success', 'Le diplôme a été supprimé avec succès.');
        return $this->redirectToRoute('diplome');
    }
}
