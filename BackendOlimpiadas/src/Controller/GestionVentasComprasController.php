<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\Persistence\ObjectManager;
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

    //Parametros: 
    //  Usuario a comprobar
    //  Cantidad que ha comprado
    //  La id de seccionEvento que va a comprar
    //Salida:
    //  booleano que indica si puede o no realizar la compra
    //Descripcion: el usuario no puede comprar mas de 5 entradas se un mismo deporte
    public function comprobarCantidadComprada(Usuario $usuario, ObjectManager $manager, int $cantidad, int $idDeporte): bool{
        
        

        return false;
    }
}
