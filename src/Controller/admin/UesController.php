<?php

namespace App\Controller\admin;

use App\Entity\Ues;
use App\Entity\Diplomes;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\UesType;
use App\Entity\Parcours;
use App\Repository\UesRepository;
use App\Repository\DiplomesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UesController extends AbstractController
{
    //#[Route('/ues', name: 'app_ues')]
    /*public function index(): Response
    {
        return $this->render('ues/index.html.twig', [
            'controller_name' => 'UesController',
        ]);
    }*/

    public function afficher(UesRepository $uesRepository): Response
    {
        $ues = $uesRepository->findAll();

        return $this->render('admin/maquettes/ues/index.html.twig', [
            'ues' => $ues,
        ]);
    }

    public function ajouter(Request $request, EntityManagerInterface $em)
    {
        $ues = new Ues();

        $form = $this->createForm(UesType::class, $ues);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ues);
            $em->flush();
            $this ->addFlash('Success', 'l\'UE enregistré avec succès.');
            return $this->redirectToRoute('ues');
        }

        return $this->render('admin/maquettes/ues/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function modifier(Request $request, EntityManagerInterface $em, Ues $ues)
    {
        $form = $this->createForm(UesType::class, $ues);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this -> addFlash('success', 'L\'UE a été modifié avec succès.');
            return $this->redirectToRoute('ues');
        }

        return $this->render('admin/maquettes/ues/modifier.html.twig', [
            'ues'=>$ues, 'form' => $form,
        ]);
    }

    public function supprimer (Ues $ues , EntityManagerInterface $em){
        $em -> remove($ues);
        $em -> flush();
        $this -> addFlash('success', 'L\'UE a été supprimé avec succès.');
        return $this->redirectToRoute('ues');
    }

    public function uesParLicence(EntityManagerInterface $em): Response
    {
        $ues = $this->getUesDataByLicense($em);

        return $this->render('client/uesDiplomes.html.twig', [
            'ues' => $ues,
        ]);
    }

    private function getUesDataByLicense(EntityManagerInterface $em): array
    {
        $ues = [];
        $diplomes = $em->getRepository(Diplomes::class)->findByLmd('licence');

        foreach ($diplomes as $diplome) {
            foreach ($diplome->getParcours() as $parcours) {
                foreach ($parcours->getUes() as $ue) {
                    $ues[] = [
                        'titre' => $ue->getTitre(),
                        'connaissance' => $this->getUeConnaissance($ue),
                        'competence' => $this->getUeCompetence($ue),
                    ];
                }
            }
        }

        return $ues;
    }

    private function getUeConnaissance(Ues $ue): string
    {
        $connaissances = $ue->getConnaissances();
        $knowledgeString = '';
        foreach ($connaissances as $connaissance) {
            $knowledgeString .= $connaissance->getDescriptionConn() . ', ';
        }
        return rtrim($knowledgeString, ', ');
    }

    private function getUeCompetence(Ues $ue): string
    {
        $competences = $ue->getCompetences();
        $competenceString = '';
        foreach ($competences as $competence) {
            $competenceString .= $competence->getDescriptionComp() . ', ';
        }
        return rtrim($competenceString, ', ');
    }

}


