<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GestionEntradasController extends AbstractController
{
    //GET ENTRA URL(SIN PARAMETRO)   Deportes en periodo correcto    Sale JSON
    //RUTA: /api/olimpiadas/evento
    #[Route('/gestion/entradas', name: 'app_gestion_entradas')]
    public function index(): Response
    {
        return $this->render('gestion_entradas/index.html.twig', [
            'controller_name' => 'GestionEntradasController',
        ]);
    }

    //GET ENTRA URL(CON PARAMETRO ID DEPORTE)    de eventos por id deporte    Sale JSON
    //RUTA: /api/olimpiadas/deporte

    //GET ENTRA URL(CON PARAMETRO ID USUARIO) Get_ de todö (Evento, deporte, seccion, estadio)
    //segun una id solo si la semana es la del usuario y
    // solo se regresan las del periodo correcto
    //RUTA: /api/olimpiadas/actividades

    //Metodo Comprobar el periodo actual

    //Metodo Recivo una id de usuario, compruebo si la semana actual es correcta para el usuario


}
