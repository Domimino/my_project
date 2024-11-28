<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    public function login(Request $request): Response
    {
        // Pokud je uživatel přihlášen, přesměrujte na jinou stránku
        if ($this->getUser()) {
            return $this->redirectToRoute('app_homepage'); // Změňte na svou routu
        }

        return $this->render('security/login.html.twig');
    }
}
