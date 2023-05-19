<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername = $authenticationUtils->getLastUsername(),
            'error' => $error = $authenticationUtils->getLastAuthenticationError()
        ,
        ]);
    }

    #[Route('/deconnexion', 'logout')]
    public function logout()
    {
        // Rien à faire, merci Symfony !
    }
}
