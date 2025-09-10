<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users')]
class UserApiController extends AbstractController
{
    public function __construct(private UserService $userService) {}

    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->userService->createUser($data['name'], $data['email']);
        return $this->json($user);
    }

    #[Route('', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers();
        return $this->json($users);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        $user = $this->userService->getUser($id);
        return $user ? $this->json($user) : $this->json(['error' => 'User not found'], 404);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(string $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->userService->updateUser($id, $data['name'], $data['email']);
        return $user ? $this->json($user) : $this->json(['error' => 'User not found'], 404);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        $deleted = $this->userService->deleteUser($id);
        return $deleted ? $this->json(['status' => 'deleted']) : $this->json(['error' => 'User not found'], 404);
    }
}