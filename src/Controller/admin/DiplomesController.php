<?php

namespace App\Controller\admin;

use App\Entity\Diplomes;
use App\Entity\Ues;
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

        $qb = $diplomeRepository->createQueryBuilder('d');
        $qb
            ->leftJoin('d.parcours', 'p')
            ->leftJoin('d.blocConnaissances', 'bc')
            ->leftJoin('d.blocCompetences', 'bco')
        ;
        $diplomes = $qb->getQuery()->getResult();

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

    public function uesParLicence(EntityManagerInterface $em): Response
    {
        $diplomes = $em->getRepository(Diplomes::class)->findByNomDip('licence');

        $ues = [];
        foreach ($diplomes as $diplome) {
            foreach ($diplome->getParcours() as $parcours) {
                foreach ($parcours->getUes() as $ue) {
                    $ues[] = [
                        'titre' => $ue->getTitre(),
                        'connaissances' => $this->getUeConnaissances($ue),
                        'competences' => $this->getUeCompetences($ue),
                    ];
                }
            }
        }

        return $this->render('client/uesDiplomes.html.twig', [
            'ues' => $ues,
        ]);
    }

    private function getUeConnaissances(Ues $ue): array
    {
        $connaissances = [];
        foreach ($ue->getConnaissances() as $connaissance) {
            $connaissances[] = $connaissance->getDescriptionConn();
        }
        return $connaissances;
    }

    private function getUeCompetences(Ues $ue): array
    {
        $competences = [];
        foreach ($ue->getCompetences() as $competence) {
            $competences[] = $competence->getDescriptionComp();
        }
        return $competences;
    }
}
