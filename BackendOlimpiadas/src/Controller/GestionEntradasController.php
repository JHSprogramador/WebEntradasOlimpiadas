<?php

namespace App\Controller;

use App\Entity\UsuariosMeses;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GestionEntradasController extends AbstractController
{
    //GET ENTRA URL(SIN PARAMETRO)   Deportes en periodo correcto    Sale JSON
    //RUTA: /api/olimpiadas/evento
    #[Route('/api/olimpiadas/evento', name: 'get_eventos', methods: ['GET'])]
    public function getEvento(EntityManagerInterface $entityManager): JsonResponse
    {
        return $this->render('gestion_entradas/index.html.twig', [
            'controller_name' => 'GestionEntradasController',
        ]);
    }

    //GET ENTRA URL(CON PARAMETRO ID DEPORTE)    de eventos por id deporte    Sale JSON
    //RUTA: /api/olimpiadas/deporte
    #[Route('/api/olimpiadas/deporte', name: 'get_deportes', methods: ['GET'])]
    public function getDeportes(EntityManagerInterface $entityManager): JsonResponse
    {
        return $this->render('gestion_entradas/index.html.twig', [
            'controller_name' => 'GestionEntradasController',
        ]);
    }
    //GET ENTRA URL(CON PARAMETRO ID USUARIO) Get_ de todö (Evento, deporte, seccion, estadio)
    //segun una id solo si la semana es la del usuario y
    // solo se regresan las del periodo correcto
    //RUTA: /api/olimpiadas/actividades
    #[Route('/api/olimpiadas/actividades', name: 'get_actividades', methods: ['GET'])]
    public function getActividades(EntityManagerInterface $entityManager): JsonResponse
    {
        return $this->render('gestion_entradas/index.html.twig', [
            'controller_name' => 'GestionEntradasController',
        ]);
    }
    //Metodo Comprobar el periodo actual
    public function ComprobarPeriodo(): int{

        return 0;
    }
    //Metodo Recivo una id de usuario, compruebo si la semana actual es correcta para el usuario
    public function ComprobarSemana(UsuariosMeses $usuario): bool{

        return false;
    }

}
