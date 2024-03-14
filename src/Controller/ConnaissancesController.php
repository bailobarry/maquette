<?php

namespace App\Controller;

use App\Entity\Connaissances;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ConnaissancesType;
use App\Repository\ConnaissancesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ConnaissancesController extends AbstractController
{
    //#[Route('/connaissances', name: 'app_connaissances')]
    /*public function index(): Response
    {
        return $this->render('connaissances/index.html.twig', [
            'controller_name' => 'ConnaissancesController',
        ]);
    }*/

    public function afficher(ConnaissancesRepository $connaissanceRepository): Response
    {
        $Connaissances = $connaissanceRepository->findAll();

        return $this->render('admin/maquettes/connaissances/index.html.twig', [
            'Connaissances' => $Connaissances,
        ]);
    }


    public function ajouter(Request $request, EntityManagerInterface $em)
    {
        $Connaissance = new Connaissances();

        $form = $this->createForm(ConnaissancesType::class, $Connaissance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($Connaissance);
            $em->flush();
            $this ->addFlash('Success', 'Connaissance enregistré avec succès.');
            return $this->redirectToRoute('connaissance');
        }

        return $this->render('admin/maquettes/connaissances/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    public function modifier(Request $request, EntityManagerInterface $em, Connaissances $Connaissance)
    {
        $form = $this->createForm(ConnaissancesType::class, $Connaissance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this -> addFlash('success', 'Connaissance a été modifié avec succès.');
            return $this->redirectToRoute('connaissance');
        }

        return $this->render('admin/maquettes/connaissances/modifier.html.twig', [
            'Connaissance'=>$Connaissance, 'form' => $form,
        ]);
    }


    public function supprimer (Connaissances $Connaissance, EntityManagerInterface $em){
        $em -> remove($Connaissance);
        $em -> flush();
        $this -> addFlash('success', 'Connaissance a été supprimé avec succès.');
        return $this->redirectToRoute('connaissance');
    }
}
