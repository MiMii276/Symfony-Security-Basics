<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        $roles = $user ? $user->getRoles() : [];
        if (in_array('ROLE_ADMIN', $roles)) {
            $message = 'You are logged in as Admin. You have full access.';
        } elseif (in_array('ROLE_USER', $roles)) {
            $message = 'You are logged in as Regular User. Limited access granted.';
        } else {
            $message = 'Welcome!';
        }

        return $this->render('dashboard/index.html.twig', [
            'message' => $message,
            'username' => $user ? $user->getUserIdentifier() : 'Guest',
        ]);
    }
}
