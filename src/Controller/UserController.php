<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/users')]
class UserController extends AbstractController
{
    public function __construct(private UserService $userService) {}

    #[Route('', methods: ['GET'], name: 'user_index')]
    public function index(): Response
    {
        $users = $this->userService->getAllUsers();
        return $this->render('user/index.html.twig', ['users' => $users]);
    }

    #[Route('/create', methods: ['GET', 'POST'])]
    public function createView(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $age = (int)$request->request->get('age');
            $user = $this->userService->createUser($name, $email, $age);

            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        return $this->render('user/create.html.twig');
    }

    #[Route('/{id}', methods: ['GET'], name: 'user_show')]
    public function show(string $id): Response
    {
        $user = $this->userService->getUser($id);
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }
        return $this->render('user/show.html.twig', ['user' => $user]);
    }

    #[Route('/{id}/delete', methods: ['POST'], name: 'user_delete')]
    public function delete(string $id, Request $request): Response
    {
        $this->userService->deleteUser($id);
        return $this->redirectToRoute('user_index');
    }

    #[Route('/filter/age/{minAge}', methods: ['GET'])]
    public function filterByAge(int $minAge): Response
    {
        $users = $this->userService->getUsersWithAgeGreaterThan($minAge);
        return $this->render('user/index.html.twig', ['users' => $users]);
    }
}
