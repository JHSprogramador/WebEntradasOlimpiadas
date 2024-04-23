<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GestionEntradasController extends AbstractController
{
    #[Route('/gestion/entradas', name: 'app_gestion_entradas')]
    public function index(): Response
    {
        return $this->render('gestion_entradas/index.html.twig', [
            'controller_name' => 'GestionEntradasController',
        ]);
    }
}
