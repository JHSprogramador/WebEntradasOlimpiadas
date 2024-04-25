<?php

namespace App\DataFixtures;

use App\Entity\Deportes;
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
        // Crear y persistir algunos deportes de ejemplo
        $deportesNombres = ['Fútbol', 'Baloncesto', 'Tenis', 'Golf', 'Natación', 'Atletismo', 'Ciclismo', 'Voleibol'];

        foreach ($deportesNombres as $nombre) {
            $deporte = new Deportes();
            $deporte->setNombreDeporte($nombre);
            $manager->persist($deporte);
        }

        $manager->flush();

        $estadiosNombres = ['Estadio A', 'Estadio B', 'Estadio C', 'Estadio D'];

        foreach ($estadiosNombres as $nombre) {
            $estadio = new Estadios();
            $estadio->setNombreEstadio($nombre);
            $manager->persist($estadio);
        }

        $manager->flush();


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


        $manager->flush();

        $deportes = $manager->getRepository(Deportes::class)->findAll();

        $nombresEventos = ['Final femenina', 'Final masculina', 'Semifinal femenina', 'Semifinal masculina', 'Encuentro femenino', 'Encuentro masculino'];
        


        // Crear y persistir eventos para cada deporte
        foreach ($deportes as $deporte) {
            $indicesAleatorios = array_rand($nombresEventos, 3);
            $elementosAleatorios = [];
            foreach ($indicesAleatorios as $indice) {
                $elementosAleatorios[] = $nombresEventos[$indice];
            }

            for ($i = 1; $i <= 3; $i++) {
                $evento = new Eventos();
                $nombreAleatorio = $elementosAleatorios[$i - 1];
                $evento->setNombreEvento($nombreAleatorio);
                $evento->setPeriodo(0); // Periodo como 0, luego se setea
                $evento->addIdDeporte($deporte);
                $manager->persist($evento);
            }
        }

        $manager->flush();

        //setear los periodos
        $deportes = $manager->getRepository(Deportes::class)->findAll();
        $eventos = $manager->getRepository(Eventos::class)->findAll();

        $mitadesDeportes = array_chunk($deportes, ceil(count($deportes) / 2));

        // Obtener la primera mitad de los deportes
        $primerMitadDeportes = $mitadesDeportes[0];

        // Obtener la segunda mitad de los deportes
        $segundaMitadDeportes = $mitadesDeportes[1];

        // Obtener los IDs de los deportes de la primera mitad
         $idsPrimerMitadDeportes = array_map(fn($deporte) => $deporte->getId(), $primerMitadDeportes);

        //Para guardar loseventos de la primera mitad de deportes
        $eventosPrimerMitad = [];
        foreach ($eventos as $evento) {
            if (in_array($evento->getIdDeporte(), $idsPrimerMitadDeportes)) {
                $eventosPrimerMitad[] = $evento;

            }
        }
        //seteamos la primera mitad de los eventos su periodo en 1
        foreach ($eventosPrimerMitad as $evento) {
            $evento->setPeriodo(1);
            $manager->persist($evento);
        }



        $manager->flush();


        // Obtener los IDs de los deportes de la segunda mitad
        $idSegundaMitadDeportes = array_map(fn($deporte) => $deporte->getId(), $segundaMitadDeportes);

        //Para guardar los eventos de la segunda mitad de deportes
        $eventosSegundaMitad = [];
        foreach ($eventos as $evento) {
            if (in_array($evento->getIdDeporte(), $idSegundaMitadDeportes)) {
                $eventosSegundaMitad[] = $evento;

            }
        }
        //seteamos la segunda mitad de los eventos su periodo en 1
        foreach ($eventosSegundaMitad as $evento) {
            $evento->setPeriodo(2);
            $manager->persist($evento);
        }

        $manager->flush();
        

        // Obtener todos los eventos y secciones
        $estadios = $manager->getRepository(Estadios::class)->findAll();
        $deportes = $manager->getRepository(Deportes::class)->findAll();

        
        


        // Iterar sobre cada deporte y asignar sus eventos a todas las secciones del estadio aleatorio
        foreach ($deportes as $deporte) {
            
            $estadioAleatorio = $estadios[array_rand($estadios)];// Obtener un estadio aleatorio

            $secciones = $estadioAleatorio->getSecciones();// Obtener todas las secciones del estadio aleatorio
            $eventos = $deporte->getEventos();
            foreach ($eventos as $evento) {
                foreach ($secciones as $seccion) {
                    $seccionEvento = new SeccionEvento();
                    $seccionEvento->setIdEvento($evento);
                    $seccionEvento->setIdSeccion($seccion);
                    //asignar un precio aleatorio si lo deseas
                    $seccionEvento->setPrecio(mt_rand(100, 1000) / 10); //precio random entre 10 y 100 con un decimal
                    $manager->persist($seccionEvento);
                }
            }
        }


        $manager->flush();
    }
}
