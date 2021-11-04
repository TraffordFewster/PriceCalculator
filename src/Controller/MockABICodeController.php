<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MockABICodeController extends AbstractController
{
    #[Route('/abicode', name: 'abicode', methods: "POST")]
    public function index(): Response
    {
        if (!$_POST['reg']) {
            return $this->json([
                'success' => false,
                'message' => 'Please provide a registration.',
            ]);
        }
        return $this->json([
            'success' => true,
            'data' => [
                'abicode' => '46545255'
            ]
        ]);
    }
}
