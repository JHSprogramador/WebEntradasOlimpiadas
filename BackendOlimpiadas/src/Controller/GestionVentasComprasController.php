<?php

namespace App\Controller;

use App\Entity\DeportesEventos;
use App\Entity\Usuario;
use App\Entity\Entrada;
use App\Entity\Secciones;
use App\Entity\SeccionEvento;
use App\Entity\Transaxxiones;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GestionVentasComprasController extends AbstractController
{

    //Nos mandan la IdDeporte , la IdEvento , la idauth0 y la idSecciones y creamos una entrada con un IDtreansaccion aleatoria

    // Recibimos un json:
    // id deporte
    // id evento
    // id secciones
    // id auth0
    // cantidad

    //genatamos una transacccion con id aleatoria
    //la trasaaccion cuenta con :
    //id
    //fecha

    //guaramos la entraa y la transaccion en la base de datos
    //retornamos un mensaje de exito


    #[Route('/gestion/ventas/compras', name: 'app_gestion_ventas_compras')]
    public function index(Request $request, ObjectManager $manager): Response
    {
        // Obtener el contenido del JSON
        $data = json_decode($request->getContent(), true);
        //recibimo cantidad 
        $cantidad = $data['cantidad'];
        //generamos la idTransaccion
        

        // Obtener el id del deporte
        $idDeporte = $data['idDeporte'];
        //obtenemos al usuario por su aut0
        // $usuario = $manager->getRepository(Usuario::class)->findOneBy(['idAuth0' => $data['idAuth0']]);
        $usuario = $data['idAuth0'];

        // Obtener el id del evento
        $idEvento = $data['idEvento'];
        $idSeccion = $data['idSeccion'];

        if (!$this->comprobarCantidadComprada($usuario, $manager, $cantidad, $idDeporte)) {
            return new Response('No se puede comprar más de 5 entradas para el mismo deporte', 400);
        }
        if (!$this->comprobarAforo($manager, $idSeccion, $cantidad)) {
            return new Response('No hay suficientes plazas disponibles', 400);
        }

        //transacciones
        $idTrasaccion = rand(1000000, 9999999);
        //creamos la transaccion
        $transaccion = new Transaxxiones();
        $transaccion->setId($idTrasaccion);
        $transaccion->getFechaTransaccion(new \DateTime());

        //persist y flush
        $manager->persist($transaccion);
        $manager->flush();

        $deportesEventos = $manager->getRepository(DeportesEventos::class)->findBy(['id_deporte' => $idDeporte, 'id_evento' => $idEvento]);
        $seccionSacada = $manager->getRepository(Secciones::class)->findBy(['id' => $idSeccion]);
        $SeccionEventos = $manager->getRepository(SeccionEvento::class)->findBy(['id_deporteEvento' => Reset($deportesEventos)->getId(), 'id_seccion' => $seccionSacada]);
        $UsuarioAuth0 = $manager->getRepository(Usuario::class)->findBy(['id_auth0' =>  $usuario]);


        //separado
        for ($i = 0; $i < $cantidad; $i++) {
            $entrada = new Entrada();
            $entrada->setIdSeccionEvento($SeccionEventos[0]);
            $entrada->setIdUsuario($UsuarioAuth0[0]);
            $entrada->setIdTransaccion($transaccion);
            //persist y flush
            $manager->persist($entrada);
            
        }
        $manager->flush();
    }


    //Parametros: 
    //  Usuario a comprobar
    //  Cantidad que ha comprado
    //  La id de seccionEvento que va a comprar
    //Salida:
    //  Booleano que indica si puede o no realizar la compra
    //Descripcion: el usuario no puede comprar mas de 5 entradas se un mismo deporte
    public function comprobarCantidadComprada(Usuario $usuario, ObjectManager $manager, int $cantidad, int $idDeporte): bool
    {

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

    public function comprobarAforo(ObjectManager $manager, int $idSeccion, int $cantidad): bool
    {
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

        if ($aforo < $cantidadEntradasEnSeccionMasCompra) {
            return false;
        }

        
        return true;
    }
}
