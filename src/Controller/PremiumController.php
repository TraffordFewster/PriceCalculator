<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
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
    /**
     * Premium Endpoint
     * The endpoint accepts post requests with age, postcode and reg number values.
     *
     * @return Response
     */
    #[Route('/premium', name: 'premium', methods: "POST")]
    public function index(Request $request): Response
    {
        $data = [
            "age" => filter_var($request->get("age"), FILTER_SANITIZE_NUMBER_INT),
            "postcode" => filter_var($request->get("postcode"), FILTER_SANITIZE_STRING),
            "regNo" => filter_var($request->get("regNo"), FILTER_SANITIZE_STRING)
        ];

        foreach ($data as $key => $value) {
            if (!$value) {
                throw new UnprocessableEntityHttpException("Please provide a valid $key value!");
            }
        }

        $calculator = new MultiplierCalculator(500);
        $calculator->addMultiplier(new AgeRatingMultiplier($data["age"]));
        $calculator->addMultiplier(new PostalRatingMultiplier($data["postcode"]));
        $calculator->addMultiplier(new AbiRatingMultiplier($data["regNo"]));

        return $this->json($calculator->getDetails());
    }
}
