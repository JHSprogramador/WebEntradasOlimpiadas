<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LanzadorSorteoController extends AbstractController
{
    #[Route('/lanzador/sorteo', name: 'app_lanzador_sorteo')]
    public function index(): Response
    {
        
    }
}
