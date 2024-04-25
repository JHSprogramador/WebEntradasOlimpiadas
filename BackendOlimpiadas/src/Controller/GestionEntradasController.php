<?php

namespace App\Controller;

use App\Entity\DeportesEventos;
use App\Entity\Eventos;
use App\Entity\UsuariosMeses;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/olimpiadas', name: 'api_olimpiadas')]
class GestionEntradasController extends AbstractController
{
    //GET ENTRA URL(SIN PARAMETRO)   Deportes en periodo correcto    Sale JSON
    //RUTA: /api/olimpiadas/evento

    #[Route('/eventosPorIdDeporte/{id}', name: 'get_eventos', methods: ['GET'])]
    public function getEventos($id, EntityManagerInterface $entityManager): JsonResponse
    {
        // $id is directly injected from the route parameter
        $id_deporte = $id;
        $eventos = $entityManager->getRepository(Eventos::class)->findBy(['id' => $id_deporte]);
        $data = [];

        foreach ($eventos as $evento) {
            $data[] = [
                'id' => $evento->getId(),
                'nombre' => $evento->getNombreEvento(),
            ];
        }

        return new JsonResponse($data, 200);
    }

    //GET ENTRA URL(CON PARAMETRO ID DEPORTE)    de eventos por id deporte    Sale JSON
    //RUTA: /api/olimpiadas/deporte
    #[Route('/deporte', name: 'get_deportes', methods: ['GET'])]
    public function getDeportes(EntityManagerInterface $entityManager): JsonResponse
    {

        $periodo = $this->ComprobarPeriodo();
        if ($periodo == 0) {
            return new JsonResponse(['error' => 'No hay deportes en este periodo'], Response::HTTP_NOT_FOUND);
        }

        // Devuelve los deportes que coincidan con el periodo
        $deporteCoincidePeriodo = $entityManager->getRepository('App\Entity\Deportes')->findBy(['periodo' => $periodo]);

        $data = [];
        foreach ($deporteCoincidePeriodo as $deporte) {
            $data[] = [
                'id' => $deporte->getId(),
                'nombre' => $deporte->getNombreDeporte(),
                'periodo' => $deporte->getPeriodo()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }














        //nos pasan un id deporte
        //tambien nos pasan una id evento
        //necesitamos saber las secciones y toda su informacion y el estdio al que pertenece donde en deportes eventos coincidan la id deporte y la id evento
        //recibimos la id del deporte y la id del evento por un json





        
        // $deporteId = $deporte->getId();
        // $deportesEventos = $manager->getRepository(DeportesEventos::class)->findBy(['id_deporte' => $deporteId]);
        
    #[Route('/actividades', name: 'get_actividades', methods: ['GET'])]
    public function getActividades(EntityManagerInterface $entityManager): JsonResponse {+

         


        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['idAuth0'])) {
            return new JsonResponse(['error' => 'Falta el idAuth0'], 400);
        }

        if (!isset($data['id_deporte'], $data['id_evento'])) {
            return new JsonResponse(['error' => 'Falta id_deporte o id_evento'], 400);
        }

        $id_deporte = $data['id_deporte'];
        $id_evento = $data['id_evento'];

        // Find DeportesEventos entity where id_deporte and id_evento match
        $deportesEventos = $entityManager->getRepository(DeportesEventos::class)->findOneBy([
            'id_deporte' => $id_deporte,
            'id_evento' => $id_evento
        ]);

        if (!$deportesEventos) {
            return new JsonResponse(['error' => 'No se encontró DeportesEventos con id_deporte e id_evento dados'], 404);
        }

        // Get related Secciones and Estadio
        $secciones = $deportesEventos->getSecciones();
        $estadio = $deportesEventos->getEstadio();

        // Prepare data for response
        $responseData = [
            'secciones' => [],
            'estadio' => null
        ];

        foreach ($secciones as $seccion) {
            $responseData['secciones'][] = [
                'id' => $seccion->getId(),
                // Add other fields of Seccion entity that you want to include in the response
            ];
        }

        if ($estadio) {
            $responseData['estadio'] = [
                'id' => $estadio->getId(),
                // Add other fields of Estadio entity that you want to include in the response
            ];
        }

        return new JsonResponse($responseData, 200);
    }








    //Metodo Comprobar el periodo actual
    public function ComprobarPeriodo(): int
    {
        $fecha_actual = new \DateTime();

        $numero_semana = $fecha_actual->format("W");

        if ($numero_semana >= 17 && $numero_semana <= 22) {
            return 1;
        } elseif ($numero_semana >= 23 && $numero_semana <= 26) {
            return 2;
        } else {
            return 0;
        }
    }
     //Metodo Recibo una id de usuario, compruebo si la semana actual es correcta para el usuario
     public function ComprobarSemana(UsuariosMeses $usuario): bool
     {
         $fecha_actual = new \DateTime();
 
         $numero_semana = $fecha_actual->format("W");
 
         if($usuario->getMes1() == $numero_semana || $usuario->getMes2() == $numero_semana ){
             return true;
         }
 
         return false;
     }
}
