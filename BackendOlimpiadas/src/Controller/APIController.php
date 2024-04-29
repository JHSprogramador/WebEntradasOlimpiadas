<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/messages")
 */
#[Route('/api/messages')]
class APIController extends AbstractController
{
    /**
     * @Route("/public", name="public")
     */
    #[Route('/public', name: 'public', methods: ['GET'])]
    public function publicAction()
    : JsonResponse
    {
        return $this->json(["message" => "The API doesn't require an access token to share this message."], Response::HTTP_OK);
    }

    /**
     * @Route("/protected", name="protected")
     */
    #[Route('/protected', name: 'protected', methods: ['GET'])]
    public function protectedAction()
    : JsonResponse
    {
        return $this->json(["message" => "The API successfully validated your access token."], Response::HTTP_OK);
    }

    /**
     * @Route("/admin", name="admin")
     */
    #[Route('/admin', name: 'admin', methods: ['GET'])]
    public function adminAction(): JsonResponse
    {
        return $this->json(["message" => "The API successfully recognized you as an admin."], Response::HTTP_OK);
    }
}