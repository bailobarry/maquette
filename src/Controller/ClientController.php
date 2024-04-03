<?php

namespace App\Controller;
use App\Entity\Ues;
use App\Entity\Diplomes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClientController extends AbstractController
{
    //#[Route('/client', name: 'app_client')]
    public function index(): Response
    {
        return $this-> render('client/index.html.twig');
    }

    public function uesParLicence(EntityManagerInterface $em): Response
    {
        $ues = $this->getUesDataByLicense($em);

        return $this->render('client/uesLicence.html.twig', [
            'ues' => $ues,
        ]);
    }

    public function voirDetailsUeLicence(EntityManagerInterface $em, int $id): Response
    {
        $ue = $em->getRepository(Ues::class)->find($id);

        if (!$ue) {
            throw $this->createNotFoundException('');
        }

        $statut = $ue->getStatut()->getStatut();
        $parcours = $ue->getParcours()->getNomParc();

        return $this->render('client/voirDetailsUeLicence.html.twig', [
            'ue' => $ue,
            'statut' => $statut,
            'parcours' => $parcours,
        ]);
    }

    public function voirDetailsUeMaster(EntityManagerInterface $em, int $id): Response
    {
        $ue = $em->getRepository(Ues::class)->find($id);

        if (!$ue) {
            throw $this->createNotFoundException('');
        }

        $statut = $ue->getStatut()->getStatut();
        $parcours = $ue->getParcours()->getNomParc();

        return $this->render('client/voirDetailsUeMaster.html.twig', [
            'ue' => $ue,
            'statut' => $statut,
            'parcours' => $parcours,
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
                        'id' => $ue->getId(),
                        'titre' => $ue->getTitre(),
                        'connaissance' => $this->getUeConnaissance($ue),
                        'competence' => $this->getUeCompetence($ue),
                        'statut' => $ue->getStatut()->getStatut(),
                        'parcours' => $parcours->getNomParc(),
                    ];
                }
            }
        }

        return $ues;
    }
    
    private function getUeConnaissance(Ues $ue): string
    {
        $connaissances = $ue->getConnaissances();
        $connaissanceString = '';
        foreach ($connaissances as $connaissance) {
            $connaissanceString .= $connaissance->getDescriptionConn() . ', ';
        }
        return rtrim($connaissanceString, ', ');
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

    public function uesParMaster(EntityManagerInterface $em): Response
    {
        $ues = $this->getUesDataByMaster($em);

        return $this->render('client/uesMaster.html.twig', [
            'ues' => $ues,
        ]);
    }

    private function getUesDataByMaster(EntityManagerInterface $em): array
    {
        $ues = [];
        $diplomes = $em->getRepository(Diplomes::class)->findByLmd('master');

        foreach ($diplomes as $diplome) {
            foreach ($diplome->getParcours() as $parcours) {
                foreach ($parcours->getUes() as $ue) {
                    $ues[] = [
                        'id' => $ue->getId(),
                        'titre' => $ue->getTitre(),
                        'connaissance' => $this->getUeConnaissance($ue),
                        'competence' => $this->getUeCompetence($ue),
                        'statut' => $ue->getStatut()->getStatut(),
                        'parcours' => $parcours->getNomParc(),
                    ];
                }
            }
        }

        return $ues;
    }

}
