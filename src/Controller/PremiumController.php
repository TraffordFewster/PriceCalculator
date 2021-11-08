<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MultiplierCalculator;
use App\Service\Models\AbiRatingMultiplier;
use App\Service\Models\AgeRatingMultiplier;
use App\Service\Models\PostalRatingMultiplier;

/**
 * Symfony Controller for /premium
 * A Symfony controller that manages the endpoint /premium
 *
 * @category Controllers
 * @package  QuoteEngine
 * @author   Trafford Fewster <contact@trafford.dev>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/TraffordFewster/PriceCalculator
 */
class PremiumController extends AbstractController
{
    // #[Route('/premium', name: 'premium', methods: "POST")]
    /**
     * Premium Endpoint
     * The endpoint accepts post requests with age, postcode and reg number values.
     *
     * @return Response
     */
    #[Route('/premium', name: 'premium')]
    public function index(): Response
    {
        $data = [
            "age" => 20,
            "postcode" => "PE3 8AF",
            "regNo" => "PJ63 LXR"
        ];

        $calculator = new MultiplierCalculator(500);
        $calculator->addMultiplier(new AgeRatingMultiplier($data["age"]));
        $calculator->addMultiplier(new PostalRatingMultiplier($data["postcode"]));
        $calculator->addMultiplier(new AbiRatingMultiplier($data["regNo"]));

        // dump($calculator->getTotal());
        // dump($calculator->getDetails());

        return $this->json($calculator->getDetails());
    }
}
