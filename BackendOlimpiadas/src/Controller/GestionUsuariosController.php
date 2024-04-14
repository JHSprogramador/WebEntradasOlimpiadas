<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Usuario;
use App\Entity\UsuariosMeses;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class GestionUsuariosController extends AbstractController
{
    //get de todos los usuarios y llo queremos devolver como jsonresponse
    // #[Route('/Usuario', name: 'get_usuarios', methods: ['GET'])]
    // public function getAll(EntityManagerInterface $entityManager): JsonResponse
    // {
    //     $apartamentos = $entityManager->getRepository(Usuario::class)->findAll();
    //     $data = [];
    //     foreach ($apartamentos as $apartamento) {
    //         $data[] = [
    //             'id' => $apartamento->getId(),
    //             'idAuth0' => $apartamento->getIdAuth0(),
    //             'mail' => $apartamento->getMail(),
    //             'name' => $apartamento->getName(),
    //         ];
    //     }

    //     return new JsonResponse($data, 200);
    // }

    
    #[Route('/Usuario/Register', name: 'register_usuario', methods: ['POST'])]
    public function register(EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $usuario = new Usuario();
        $usuario->setIdAuth0($data['idAuth0']);
        $entityManager->persist($usuario);

        // Crear una nueva entidad UsuariosMeses y asignarle las semanas
        $usuariosMeses = new UsuariosMeses();
        $usuariosMeses->setIdUsuario($usuario);

        // Obtener todas las entidades UsuariosMeses existentes
        $allUsuariosMeses = $entityManager->getRepository(UsuariosMeses::class)->findAll();

        // Contar cuántos usuarios hay en cada semana de cada mes
        $counts = [];
        for ($i = 1; $i <= 4; $i++) {
            $counts['mes1'][$i] = 0;
            $counts['mes2'][$i] = 0;
        }
        foreach ($allUsuariosMeses as $um) {
            $counts['mes1'][$um->getMes1()]++;
            $counts['mes2'][$um->getMes2()]++;
        }

        // Asignar las semanas de manera que se minimice el desbalance
        $semanaMes1 = array_search(min($counts['mes1']), $counts['mes1']);
        $semanaMes2 = array_search(min($counts['mes2']), $counts['mes2']);
        $usuariosMeses->setMes1($semanaMes1);
        $usuariosMeses->setMes2($semanaMes2);
        $entityManager->persist($usuariosMeses);

        $entityManager->flush();

        return new JsonResponse(['status' => 'Usuario registrado', 'semanaMes1' => $semanaMes1, 'semanaMes2' => $semanaMes2], 201);
    }

    //devolvemos al usuario con el id y sus semanas 
    #[Route('/Usuario/{id}', name: 'get_usuario', methods: ['GET'])]
    public function getOne(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $usuario = $entityManager->getRepository(Usuario::class)->find($id);
        if (!$usuario) {
            return new JsonResponse(['error' => 'Usuario no encontrado'], 404);
        }

        $usuariosMeses = $entityManager->getRepository(UsuariosMeses::class)->findOneBy(['idUsuario' => $usuario]);
        $data = [
            'id' => $usuario->getId(),
            'idAuth0' => $usuario->getIdAuth0(),
            'mail' => $usuario->getMail(),
            'name' => $usuario->getName(),
            'mes1' => $usuariosMeses->getMes1(),
            'mes2' => $usuariosMeses->getMes2(),
        ];

        return new JsonResponse($data, 200);
    }

    
}
