<?php
/**
 * Premium endpoint controller.
 * The controller that manages the endpoint /premium
 * PHP Version 8.0.2
 * 
 * @category Controllers
 * @package  QuoteEngine
 * @author   Trafford Fewster <contact@trafford.dev>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/TraffordFewster/PriceCalculator
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $test = new \App\Service\Models\AbiRatingMultiplier("PJ63 LXR");
        dump($test);
        dump($test->getMultiplier());
        return $this->json(["yo"=>"2"]);
    }
}
