<?php

namespace App\Controller;

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
    #[Route('/evento', name: 'get_eventos', methods: ['GET'])]
    public function getEvento(EntityManagerInterface $entityManager): JsonResponse
    {
        $periodo = $this->ComprobarPeriodo();
        if ($periodo == 0) {
            return new JsonResponse(['error' => 'No hay eventos en este periodo'], Response::HTTP_NOT_FOUND);
        }
        $query = $entityManager->createQuery('SELECT e FROM App\Entity\Eventos e WHERE e.periodo = :periodo'); // la e es de evento (se usa e para abreviar el nombre de la tabla)
        $query->setParameter('periodo', $periodo);
        $eventos = $query->getResult();
        $data = [];
        foreach ($eventos as $evento) {
            $data[] = [
                'id' => $evento->getId(),
                'nombre' => $evento->getNombre(),
                'fecha' => $evento->getFecha(),
                'hora' => $evento->getHora(),
                'periodo' => $evento->getPeriodo(),
                'deporte' => $evento->getDeporte()->getNombre(),
                'seccion' => $evento->getSeccion()->getNombre(),
                'estadio' => $evento->getEstadio()->getNombre()
            ];
        }
        return new JsonResponse($data, Response::HTTP_OK);
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
                'nombre' => $deporte->getNombre(),
                'periodo' => $deporte->getPeriodo()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
    //GET ENTRA URL(CON PARAMETRO ID AUTH0) Get_ de todo (Evento, deporte, seccion, estadio)
    //segun una id solo si la semana es la del usuario y
    // solo se regresan las del periodo correcto
    //RUTA: /actividades
    #[Route('/actividades', name: 'get_actividades', methods: ['GET'])]
    public function getActividades(EntityManagerInterface $entityManager): JsonResponse
    {
        // TODO: Implementar este método
        return new JsonResponse(['error' => 'No hay eventos en este periodo'], Response::HTTP_NOT_FOUND);
    }
    //Metodo Comprobar el periodo actual
    public function ComprobarPeriodo(): int
    {
        $fecha_actual = new \DateTime();

        $numero_semana = $fecha_actual->format("W");

        if ($numero_semana >= 18 && $numero_semana <= 22) {
            return 1;
        } elseif ($numero_semana >= 23 && $numero_semana <= 26) {
            return 2;
        } else {
            return 0;
        }
    }
    //Metodo Recivo una id de usuario, compruebo si la semana actual es correcta para el usuario
    public function ComprobarSemana(UsuariosMeses $usuario): bool
    {


        return false;
    }
}
