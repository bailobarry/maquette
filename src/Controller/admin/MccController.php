<?php

namespace App\Controller\admin;

use App\Entity\MCCRNE;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\MccType;
use App\Repository\MCCRNERepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MccController extends AbstractController
{
    //#[Route('/mcc', name: 'app_mcc')]
    /*public function index(): Response
    {
        return $this->render('mcc/index.html.twig', [
            'controller_name' => 'MccController',
        ]);
    }*/

    public function afficher(MCCRNERepository $mccRepository): Response
    {
        $mcc = $mccRepository->findAll();

        return $this->render('admin/maquettes/modalites_controles/index.html.twig', [
            'mcc' => $mcc,
        ]);
    }


    public function ajouter(Request $request, EntityManagerInterface $em)
    {
        $mcc = new MCCRNE();

        $form = $this->createForm(MccType::class, $mcc);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($mcc);
            $em->flush();
            $this ->addFlash('Success', 'mcc enregistré avec succès.');
            return $this->redirectToRoute('mcc');
        }

        return $this->render('admin/maquettes/modalites_controles/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    public function modifier(Request $request, EntityManagerInterface $em, MCCRNE $mcc)
    {
        $form = $this->createForm(MccType::class, $mcc);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this -> addFlash('success', 'mcc a été modifié avec succès.');
            return $this->redirectToRoute('mcc');
        }

        return $this->render('admin/maquettes/modalites_controles/modifier.html.twig', [
            'mcc'=>$mcc, 'form' => $form,
        ]);
    }


    public function supprimer (MCCRNE $mcc, EntityManagerInterface $em){
        $em -> remove($mcc);
        $em -> flush();
        $this -> addFlash('success', 'mcc a été supprimé avec succès.');
        return $this->redirectToRoute('mcc');
    }


}
