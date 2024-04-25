<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GestionVentasComprasController extends AbstractController
{

    //Nos mandan la IdDeporte , la IdEvento , la idauth0 y la idSecciones y creamos una entrada con un IDtreansaccion aleatoria



    #[Route('/gestion/ventas/compras', name: 'app_gestion_ventas_compras')]
    public function index(): Response
    {
        return $this->render('gestion_ventas_compras/index.html.twig', [
            'controller_name' => 'GestionVentasComprasController',
        ]);
    }
}
