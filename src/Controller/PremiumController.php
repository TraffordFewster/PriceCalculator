<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PremiumController extends AbstractController
{
    // #[Route('/premium', name: 'premium', methods: "POST")]
    #[Route('/premium', name: 'premium')]
    public function index(): Response
    {
        dump(new \App\Service\Storage\Database);
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PremiumController.php',
        ]);
    }
}
