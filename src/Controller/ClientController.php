<?php

namespace App\Controller;

use App\Repository\DiplomesRepository; 
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

    public function listeUesDiplomes(DiplomesRepository $diplomesRepository): Response
    {
        $uesDiplomes = $diplomesRepository->findUesDiplomes();

        return $this->render('client/descriptions.html.twig', [
            'uesDiplomes' => $uesDiplomes,
        ]);
    }

}
