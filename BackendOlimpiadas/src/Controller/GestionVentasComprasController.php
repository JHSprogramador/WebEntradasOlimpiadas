<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Entrada;
use App\Entity\Secciones;
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
    #[Route('/gestion/ventas/compras', name: 'app_gestion_ventas_compras')]
        public function index(Request $request, ObjectManager $manager): Response
        {
            // Obtener el contenido del JSON
            $content = $request->getContent();
            $data = json_decode($content, true);
    
            // Obtener los datos del JSON
            $idDeporte = $data['idDeporte'];
            $idEvento = $data['idEvento'];
            $idSecciones = $data['idSecciones'];
            $idAuth0 = $data['idAuth0'];
            $cantidad = $data['cantidad'];
    
            // Obtener el usuario a partir del idAuth0
            $usuarioRepository = $manager->getRepository(Usuario::class);
            $usuario = $usuarioRepository->findOneBy(['idAuth0' => $idAuth0]);
    
            // Comprobar si el usuario puede comprar más entradas para el deporte dado
            if (!$this->comprobarCantidadComprada($usuario, $manager, $cantidad, $idDeporte)) {
                return $this->json(['error' => 'El usuario no puede comprar más de 5 entradas para el mismo deporte'], 400);
            }
    
            // Obtener la sección a partir del idSecciones
            $seccionesRepository = $manager->getRepository(Secciones::class);
            $seccion = $seccionesRepository->find($idSecciones);
    
            // Comprobar si hay suficientes plazas en la sección
            if (!$this->comprobarAforo($manager, $idSecciones, $cantidad)) {
                return $this->json(['error' => 'No hay suficientes plazas disponibles en la sección'], 400);
            }
    
            // Generar una transacción con id aleatorio
            $transaccion = new Transaxxiones();
            $transaccion->setId(uniqid());
            $transaccion->setFechaTransaccion(new \DateTime());
    
            // Crear una nueva entrada
            $entrada = new Entrada();
            $entrada->setIdUsuario($usuario);
            $entrada->setIdSeccionEvento($seccion);
            $entrada->setIdTransaccion($transaccion);
    
            // Guardar la entrada y la transacción en la base de datos
            $manager->persist($entrada);
            $manager->persist($transaccion);
            $manager->flush();
    
            // Retornar un mensaje de éxito
            return $this->json(['success' => 'Entrada creada correctamente'], 200);
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
