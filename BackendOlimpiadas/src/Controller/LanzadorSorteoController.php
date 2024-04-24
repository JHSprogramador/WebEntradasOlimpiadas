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
        $cantidadPorParteSegundoMes = intval(count($listaUsuarios) / 4);
        $cantidadPorPartePrimerMes = intval(count($listaUsuarios) / 5);


        $usuariosMesMezclados1 = $listaUsuarios;
        shuffle($usuariosMesMezclados1);
        //primera parte
        for ($contador; $contador < $cantidadPorParteSegundoMes; $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes2(23);
        }
        //segunda parte
        for ($contador; $contador < $cantidadPorParteSegundoMes * 2; $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes2(24);
        }
        //tercera parte
        for ($contador; $contador < $cantidadPorParteSegundoMes * 3; $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes2(25);
        }
        //cuarta parte
        for ($contador; $contador < count($listaUsuarios); $contador++) {
            $usuarioATratar = $usuariosMesMezclados1[$contador];
            $usuarioATratar->setMes2(26);
        }

        $usuariosMesMezclados2 = $usuariosMesMezclados1;
        shuffle($usuariosMesMezclados2);

        $contador = 0;
        //primera parte para primer mes
        for ($contador; $contador < $cantidadPorPartePrimerMes; $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes1(18);
        }
        //segunda parte para primer mes
        for ($contador; $contador < $cantidadPorPartePrimerMes * 2; $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes1(19);
        }
        //tercera parte para primer mes
        for ($contador; $contador < $cantidadPorPartePrimerMes * 3; $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes1(20);
        }
        //cuarta parte para primer mes
        for ($contador; $contador < $cantidadPorPartePrimerMes * 4; $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes1(21);
        }
        //quinta parte para primer mes
        for ($contador; $contador < count($listaUsuarios); $contador++) {
            $usuarioATratar = $usuariosMesMezclados2[$contador];
            $usuarioATratar->setMes1(22);
        }

        return $usuariosMesMezclados2;
    }
}
