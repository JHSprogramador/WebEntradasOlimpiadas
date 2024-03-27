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
    #[Route('/Usuario', name: 'get_usuarios', methods: ['GET'])]
    public function getAll(EntityManagerInterface $entityManager): JsonResponse
    {
        $apartamentos = $entityManager->getRepository(Usuario::class)->findAll();
        $data = [];
        foreach ($apartamentos as $apartamento) {
            $data[] = [
                'id' => $apartamento->getId(),
                'idAuth0' => $apartamento->getIdAuth0(),
                'mail' => $apartamento->getMail(),
                'name' => $apartamento->getName(),
            ];
        }

        return new JsonResponse($data, 200);
    }

    //nos llega un json y queremos sacar creamos un usuario y lo guardamos en la base de datos
    // #[Route('/Usuario', name: 'add_usuario', methods: ['POST'])]
    // public function add(EntityManagerInterface $entityManager): JsonResponse
    // {
    //     $data = json_decode(file_get_contents('php://input'), true);
    //     $usuario = new Usuario();
    //     $usuario->setIdAuth0($data['idAuth0']);
    //     $usuario->setMail($data['mail']);
    //     $usuario->setName($data['name']);
    //     $entityManager->persist($usuario);
    //     $entityManager->flush();

    //     return new JsonResponse(['status' => 'Usuario creado'], 201);
    // }

    
    // #[Route('/Usuario', name: 'add_usuarios', methods: ['POST'])]
    // public function addUsuarios(EntityManagerInterface $entityManager): JsonResponse
    // {
    //     $data = json_decode(file_get_contents('php://input'), true);

    //     foreach ($data['usuarios'] as $usuarioData) {
    //         $usuario = new Usuario();
    //         $usuario->setIdAuth0($usuarioData['idAuth0']);
    //         $usuario->setMail($usuarioData['mail']);
    //         $usuario->setName($usuarioData['name']);
    //         $entityManager->persist($usuario);
    //     }

    //     $entityManager->flush();

    //     return new JsonResponse([], 201);
    // }

    // #[Route('/Usuario/Semana', name: 'get_semana', methods: ['POST'])]
    // public function getSemana(EntityManagerInterface $entityManager): JsonResponse
    // {
    //     $data = json_decode(file_get_contents('php://input'), true);
    //     $usuario = $entityManager->getRepository(Usuario::class)->find($data['id']);

    //     if (!$usuario) {
    //         return new JsonResponse(['error' => 'Usuario no encontrado'], 404);
    //     }

    //     // Aquí necesitarás implementar la lógica para obtener la semana del mes 1 y la semana del mes 2
    //     // para el usuario.
    //     //damos un numero random del 1 al 4 para el mes 1 y otro para el mes 2 pero hay que comprobar que no dejamos todos los usuarios en unaa semana sin que los dejamos de forma repartidas con lo cual hayq ue saber que los usuarios deben distribuise en cadaa mes de forma equitativa

    //     $semanaMes1 =0;
    //     $semanaMes2 =0;



    //     return new JsonResponse(['semanaMes1' => $semanaMes1, 'semanaMes2' => $semanaMes2], 200);
    // }






    //register de un usuario y asignarle las semanas a 0
    // #[Route('/Usuario/Register', name: 'register_usuario', methods: ['POST'])]
    // public function register(EntityManagerInterface $entityManager): JsonResponse
    // {
    //     $data = json_decode(file_get_contents('php://input'), true);
    //     $usuario = new Usuario();
    //     $usuario->setIdAuth0($data['idAuth0']);
    //     $entityManager->persist($usuario);

    //     // Crear una nueva entidad UsuariosMeses y asignarle las semanas
    //     $usuariosMeses = new UsuariosMeses();
    //     $usuariosMeses->setIdUsuario($usuario);
    //     // Aquí necesitarás implementar la lógica para asignar las semanas de manera equitativa
    //     // para el mes 1 y el mes 2.
    //     $semanaMes1 = 0;
    //     $semanaMes2 = 0;
    //     $usuariosMeses->setMes1($semanaMes1);
    //     $usuariosMeses->setMes2($semanaMes2);

    //     $entityManager->persist($usuariosMeses);
    //     $entityManager->flush();

    //     return new JsonResponse(['status' => 'Usuario registrado', 'semanaMes1' => $semanaMes1, 'semanaMes2' => $semanaMes2], 201);
    // }

    // #[Route('/Usuario/Login', name: 'login_usuario', methods: ['POST'])]
    // public function login(EntityManagerInterface $entityManager): JsonResponse
    // {
    //     $data = json_decode(file_get_contents('php://input'), true);
    //     $usuario = $entityManager->getRepository(Usuario::class)->findOneBy(['idAuth0' => $data['idAuth0']]);

    //     if (!$usuario) {
    //         return new JsonResponse(['error' => 'Usuario no encontrado'], 404);
    //     }

    //     $usuariosMeses = $entityManager->getRepository(UsuariosMeses::class)->findOneBy(['idUsuario' => $usuario]);

    //     if (!$usuariosMeses) {
    //         return new JsonResponse(['error' => 'No se encontraron semanas asignadas para el usuario'], 404);
    //     }

    //     $semanaMes1 = $usuariosMeses->getMes1();
    //     $semanaMes2 = $usuariosMeses->getMes2();

    //     return new JsonResponse(['semanaMes1' => $semanaMes1, 'semanaMes2' => $semanaMes2], 200);
    // }

    // //funciona para poder asignar las semanas de forma equitativa
    // //esta funcion se encarga de asignar las semanas de forma equitativa a los usuarios que se registran en la base de datos y lo hace gracias al ID que se le asigna a cada usuario
    // #[Route('/Usuario/Semana', name: 'get_semana', methods: ['POST'])]
    // public function getSemana(EntityManagerInterface $entityManager): JsonResponse
    // {
    //     $data = json_decode(file_get_contents('php://input'), true);
    //     $usuario = $entityManager->getRepository(Usuario::class)->find($data['id']);

    //     if (!$usuario) {
    //         return new JsonResponse(['error' => 'Usuario no encontrado'], 404);
    //     }

    //     $usuariosMeses = $entityManager->getRepository(UsuariosMeses::class)->findOneBy(['idUsuario' => $usuario]);

    //     if (!$usuariosMeses) {
    //         return new JsonResponse(['error' => 'No se encontraron semanas asignadas para el usuario'], 404);
    //     }

    //     $semanaMes1 = $usuariosMeses->getMes1();
    //     $semanaMes2 = $usuariosMeses->getMes2();

    //     return new JsonResponse(['semanaMes1' => $semanaMes1, 'semanaMes2' => $semanaMes2], 200);
    // }
    


    // 1 Recibir el ID de Auth0 del usuario.
    // 2 Crear una nueva instancia de la entidad Usuario y establecer su idAuth0.
    // 3 Crear una nueva instancia de la entidad UsuariosMeses y establecer su idUsuario.
    // 4 Asignar las semanas para los meses 1 y 2 de manera equitativa. Para hacer esto, necesitamos obtener todas las entidades UsuariosMeses existentes, contar cuántos usuarios hay en cada semana de cada mes, y asignar las semanas de manera que se minimice el desbalance.
    // 6 Guardar las nuevas entidades Usuario y UsuariosMeses en la base de datos.

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
    
}
