<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Entrada;
use App\Entity\Secciones;
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
    //  Booleano que indica si puede o no realizar la compra
    //Descripcion: el usuario no puede comprar mas de 5 entradas se un mismo deporte
    public function comprobarCantidadComprada(Usuario $usuario, ObjectManager $manager, int $cantidad, int $idDeporte): bool{
        
        // Obtener el repositorio de Entrada
        $entradaRepository = $manager->getRepository(Entrada::class);

        // Obtener todas las entradas del usuario para el deporte dado
        $entradasDelUsuarioPorDeporte = $entradaRepository->createQueryBuilder('e')
        ->innerJoin('e.id_seccionEvento', 'se')
        ->innerJoin('se.id_deporteEvento', 'de')
        ->andWhere('e.id_usuario = :usuario')
        ->andWhere('de.id = :idDeporte')
        ->setParameter('usuario', $usuario)
        ->setParameter('idDeporte', $idDeporte)
        ->getQuery()
        ->getResult();

        // Contar el número total de entradas para ese deporte
        $cantidadTotal = count($entradasDelUsuarioPorDeporte);

        // Sumar la cantidad que el usuario está tratando de comprar
        $cantidadTotal += $cantidad;

        // Verificar si la cantidad total supera 5
        if ($cantidadTotal > 5) {
        return false; // El usuario no puede comprar más de 5 entradas para el mismo deporte
        }

        return true;
    }

    //Parametros:
    //  La id Seccion en la que se compra
    //  La cantidad de entrada hecas a esa seccion
    //Salida:
    //  Booleano que indique si existen fuficientes plazas
    //Descripcion: Tendra que contar la cantidad de entradas YA realizadas a una seccion dada y 
    //              si esa cantidad mas la cantidad dada no supera el aforo de esa seccion regresara true

    public function comprobarAforo(ObjectManager $manager, int $idSeccion, int $cantidad): bool{
        $entradaRepository = $manager->getRepository(Entrada::class);

        $query = $entradaRepository->createQueryBuilder('e')
        ->innerJoin('e.id_seccionEvento', 'se')
        ->andWhere('se.id_seccion = :seccion')
        ->serParameter('seccion', $idSeccion)
        ->getQuery()
        ->getResult();

        $cantidadEntradasEnSeccion = count($entradaRepository);

        $cantidadEntradasEnSeccionMasCompra = $cantidad + $cantidadEntradasEnSeccion;

        $seccion = $manager->getRepository(Secciones::class)->find($idSeccion);

        // Obtener el aforo de la sección
        $aforo = $seccion->getAforo();

        if($aforo < $cantidadEntradasEnSeccionMasCompra){
            return false;
        }

        
        return true;
    }
}
