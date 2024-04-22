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

    
    #[Route('/usuario/register', name: 'register_usuario', methods: ['POST'])]
    public function register(EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $usuario = new Usuario();
        $usuario->setIdAuth0($data['idAuth0']);
        $usuario->setName($data['name']);
        $usuario->setMail($data['mail']);
        //comprrueba que el usuario no exista
        $usuarioExistente = $entityManager->getRepository(Usuario::class)->findOneBy(['idAuth0' => $usuario->getIdAuth0()]);
        if ($usuarioExistente) {
            return new JsonResponse(['error' => 'Usuario ya registrado'], 409);
        }
        $entityManager->persist($usuario);

        // Crear una nueva entidad UsuariosMeses y asignarle las semanas
        $usuariosMeses = new UsuariosMeses();
        $usuariosMeses->setIdUsuario($usuario);
        
        $usuariosMeses->setMes1(0);
        $usuariosMeses->setMes2(0);
        $entityManager->persist($usuariosMeses);

        $entityManager->flush();

        return new JsonResponse(['status' => 'Usuario registrado'], 201);
    }

    //devolvemos al usuario con el id y sus semanas 
    #[Route('/usuario/{id}', name: 'get_usuario', methods: ['GET'])]
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