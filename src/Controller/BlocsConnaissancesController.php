<?php

namespace App\Controller;

use App\Entity\BlocsConnaissances;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\BlocsConnaissancesType;
use App\Repository\BlocsConnaissancesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlocsConnaissancesController extends AbstractController
{
    //#[Route('/blocs/connaissances', name: 'app_blocs_connaissances')]
    /*public function index(): Response
    {
        return $this->render('blocs_connaissances/index.html.twig', [
            'controller_name' => 'BlocsConnaissancesController',
        ]);
    }*/

    public function afficher(BlocsConnaissancesRepository $blocConnaissanceRepository): Response 
    {
        $blocConnaissances = $blocConnaissanceRepository ->findAll();

        return $this->render('admin/maquettes/blocs_connaissances/index.html.twig', [
            'blocConnaissances' => $blocConnaissances,
        ]);

    }


    public function ajouter(Request $request, EntityManagerInterface $em)
    {
        $blocConnaissance = new BlocsConnaissances();

        $form = $this->createForm(BlocsConnaissancesType::class, $blocConnaissance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($blocConnaissance);
            $em->flush();
            $this ->addFlash('Success', 'Bloc enregistré avec succès.');
            return $this->redirectToRoute('blocs_connaissances');
        }

        return $this->render('admin/maquettes/blocs_connaissances/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    public function modifier(Request $request, EntityManagerInterface $em, BlocsConnaissances $blocConnaissance)
    {
        $form = $this->createForm(BlocsConnaissancesType::class, $blocConnaissance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this -> addFlash('success', 'Le bloc a été modifié avec succès.');
            return $this->redirectToRoute('blocs_connaissances');
        }

        return $this->render('admin/maquettes/blocs_connaissances/modifier.html.twig', [
            'blocConnaissance'=>$blocConnaissance, 'form' => $form,
        ]);
    }

    public function supprimer (BlocsConnaissances $blocConnaissance, EntityManagerInterface $em){
        $em -> remove($blocConnaissance);
        $em -> flush();
        $this -> addFlash('success', 'Le bloc de compétence a été supprimé avec succès.');
        return $this->redirectToRoute('blocs_connaissances');
    }

}