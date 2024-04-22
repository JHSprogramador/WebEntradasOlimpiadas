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
        // Código del método
        $contador = 0;
        $CantidadPorParte = intval(count($listaUsuarios) / 4);


        $usuariosMesMezclados1 = $listaUsuarios;
        shuffle($usuariosMesMezclados1);
        //primera parte
        for ($contador; $contador < $CantidadPorParte; $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes1(1);
        }
        //segunda parte
        for ($contador; $contador < $CantidadPorParte * 2; $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes1(2);
        }
        //tercera parte
        for ($contador; $contador < $CantidadPorParte * 3; $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes1(3);
        }
        //cuarta parte
        for ($contador; $contador < count($listaUsuarios); $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes1(4);
        }

        $usuariosMesMezclados2 = $usuariosMesMezclados1;
        shuffle($usuariosMesMezclados2);

        $contador = 0;
        //primera parte para segundo mes
        for ($contador; $contador < $CantidadPorParte; $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes2(5);
        }
        //segunda parte para segundo mes
        for ($contador; $contador < $CantidadPorParte * 2; $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes2(6);
        }
        //tercera parte para segundo mes
        for ($contador; $contador < $CantidadPorParte * 3; $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes2(7);
        }
        //cuarta parte para segundo mes
        for ($contador; $contador < count($listaUsuarios); $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes2(8);
        }

        return $usuariosMesMezclados2;
    }
}
