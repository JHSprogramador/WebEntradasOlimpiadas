<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Usuario;
use App\Entity\UsuariosMeses;

#[Route('/api', name: 'api')]
class LanzadorSorteoController extends AbstractController
{
    #[Route('/lanzador/sorteo', name: 'get_sorteo', methods: ['GET'])]
    public function doSorteo(EntityManagerInterface $entityManager): JsonResponse
    {
        $usuariosMesesRepository = $entityManager->getRepository(UsuariosMeses::class);
        $listaUsuarios = $usuariosMesesRepository->findAll();

        //if(date("d")==31 && date("m")==03 && date("Y")==2024){
        $usuariosTratados = $this->HacerSorteo($listaUsuarios);
        //}
        foreach ($usuariosTratados as $usuarioTratado) {
            $entityManager->persist($usuarioTratado);
        }
        $entityManager->flush();

        return new JsonResponse(['status' => '200']);
    }

    public function HacerSorteo(array $listaUsuarios): array
    {
        $contador = 0;
        $cantidadPorParte = intval(count($listaUsuarios) / 4);
        $cantidadPorParteSegundoMes = intval(count($listaUsuarios) / 5);


        $usuariosMesMezclados1 = $listaUsuarios;
        shuffle($usuariosMesMezclados1);
        //primera parte
        for ($contador; $contador < $cantidadPorParte; $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes1(14);
        }
        //segunda parte
        for ($contador; $contador < $cantidadPorParte * 2; $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes1(15);
        }
        //tercera parte
        for ($contador; $contador < $cantidadPorParte * 3; $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes1(16);
        }
        //cuarta parte
        for ($contador; $contador < count($listaUsuarios); $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes1(17);
        }

        $usuariosMesMezclados2 = $usuariosMesMezclados1;
        shuffle($usuariosMesMezclados2);

        $contador = 0;
        //primera parte para segundo mes
        for ($contador; $contador < $cantidadPorParteSegundoMes; $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes2(18);
        }
        //segunda parte para segundo mes
        for ($contador; $contador < $cantidadPorParteSegundoMes * 2; $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes2(19);
        }
        //tercera parte para segundo mes
        for ($contador; $contador < $cantidadPorParteSegundoMes * 3; $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes2(20);
        }
        //cuarta parte para segundo mes
        for ($contador; $contador < $cantidadPorParteSegundoMes * 4; $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes2(21);
        }
        //quinta parte para segundo mes
        for ($contador; $contador < count($listaUsuarios); $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes2(22);
        }

        return $usuariosMesMezclados2;
    }
}
