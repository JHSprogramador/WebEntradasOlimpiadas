<?php

namespace App\DataFixtures;

use App\Entity\Deportes;
use App\Entity\DeportesEventos;
use App\Entity\Estadios;
use App\Entity\Secciones;
use App\Entity\Eventos;
use App\Entity\SeccionEvento;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    

    public function load(ObjectManager $manager): void
    {

        //DEPORTES
        // Crear y persistir algunos deportes de ejemplo
        $deportesNombres = ['Fútbol', 'Baloncesto', 'Tenis', 'Golf', 'Natación', 'Atletismo', 'Ciclismo', 'Voleibol'];
        $cantidadMitad = count($deportesNombres)/2;
        $contador = 0;

        foreach ($deportesNombres as $nombre) {
            $deporte = new Deportes();
            $deporte->setNombreDeporte($nombre);
            if($contador < $cantidadMitad){
                $deporte->setPeriodo(1);
                $contador++;
            } else {
                $deporte->setPeriodo(2);
            }
            
            $manager->persist($deporte);
        }

        $manager->flush(); //cambiar lo de los periodos
        //END DEPORTES

        //ESTADIOS
        $estadiosNombres = ['Estadio A', 'Estadio B', 'Estadio C', 'Estadio D'];

        foreach ($estadiosNombres as $nombre) {
            $estadio = new Estadios();
            $estadio->setNombreEstadio($nombre);
            $manager->persist($estadio);
        }

        $manager->flush(); //correcto
        //END ESTADIOS

        //EVENTOS
        $deportes = $manager->getRepository(Deportes::class)->findAll();

        $nombresEventos = ['Final femenina', 'Final masculina', 'Semifinal femenina', 'Semifinal masculina', 'Encuentro femenino', 'Encuentro masculino'];
        
        

        // Crear y persistir eventos para cada deporte
        foreach ($nombresEventos as $nombreEvento) {
            $eventos = new Eventos();
            $eventos->setNombreEvento($nombreEvento);
            $manager->persist($eventos);
        }

        $manager->flush(); //correcto

        //END EVENTOS


        //SECCIONES
        $estadios = $manager->getRepository(Estadios::class)->findAll();

        // Crear y persistir secciones para cada estadio
        foreach ($estadios as $estadio) {
            for ($i = 1; $i <= 4; $i++) {
                $seccion = new Secciones();
                $seccion->setNombreSeccion("Sección $i en " . $estadio->getNombreEstadio());
                $seccion->setAforo(rand(1000, 5000)); // Aforo aleatorio entre 1000 y 5000
                $seccion->setIdEstadio($estadio);
                $manager->persist($seccion);
            }
        }


        $manager->flush(); //correcto

        //END SECCIONES

        //DEPORTES_EVENTOS
        $eventos = $manager->getRepository(Eventos::class)->findAll();
        $deportes = $manager->getRepository(Deportes::class)->findAll();

        foreach($deportes as $deporte){
            //sacar tres eventos aleatorios
            $indicesAleatorios = array_rand($eventos, 3);
            $eventosAleatorios = [];
            foreach ($indicesAleatorios as $indice) {
                $eventosAleatorios[] = $eventos[$indice]; //array de eventos
            }

            foreach($eventosAleatorios as $eventoAleatorio){
                //nuevos Deportes_Eventos
                $deporteEvento =  new DeportesEventos();
                $deporteEvento->setIdDeporte($deporte);
                $deporteEvento->setIdEvento($eventoAleatorio);
                $manager->persist($deporteEvento);
                
            }

        }

        //END DEPORTES_EVENTOS


        //SECCION_EVENTO
        // Obtener todos los eventos y secciones
        $estadios = $manager->getRepository(Estadios::class)->findAll();
        $deportes = $manager->getRepository(Deportes::class)->findAll();
        // Iterar sobre cada deporte y asignar sus eventos a todas las secciones del estadio aleatorio
        foreach ($deportes as $deporte) {
            
            $estadioAleatorio = $estadios[array_rand($estadios)];// Obtener un estadio aleatorio

            $secciones = $estadioAleatorio->getSecciones();// Obtener todas las secciones del estadio aleatorio
            $deportesEventos = $deporte->getDeportes();
            foreach ($deportesEventos as $deporteEvento) {
                foreach ($secciones as $seccion) {
                    $seccionEvento = new SeccionEvento();
                    $seccionEvento->setIdDeporteEvento($deporteEvento);
                    $seccionEvento->setIdSeccion($seccion);
                    $seccionEvento->setPrecio(mt_rand(100, 1000) / 10); //precio random entre 10 y 100 con un decimal
                    $manager->persist($seccionEvento);
                }
            }
        }


        $manager->flush(); //cambiar, ahora se unen con Deportes_Eventos, no con eventos

        //END SECCION_EVENTO
    }
}
