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
        $test = new \App\Service\Models\AbiRatingMultiplier("PJ63 LXR");
        dump($test);
        dump($test->getMultiplier());
        return $this->json(["yo"=>"2"]);
    }
}
