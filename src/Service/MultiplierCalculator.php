<?php

namespace App\Service;

use App\Service\Models\MultiplierInterface;

/**
 * Multiplier Calculator
 * The Multiplier Calculator can have multiple multipliers and it will add them all
 * together to get you a total multiplier and the details of how it got to that.
 *
 * @category Service
 * @package  QuoteEngine
 * @author   Trafford Fewster <contact@trafford.dev>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/TraffordFewster/PriceCalculator
 */
class MultiplierCalculator
{
    /**
     * Multiplier
     * Stores the multipliers used for a total.
     *
     * @var array
     */
    private array $multipliers = [];
    /**
     * Amount
     * Stores the amount to multiply by
     *
     * @var float
     */
    private float $amount;

    /**
     * Contructor
     * Used to construct the calculator and provide an initial value.
     *
     * @param float $amount
     */
    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }


    /**
     * Add Multiplier
     * Used to add a multiplier to the calculation.
     *
     * @param  MultiplierInterface $multiplier
     *
     * @return void
     */
    public function addMultiplier(MultiplierInterface $multiplier)
    {
        array_push($this->multipliers, $multiplier);
    }

    /**
     * Get Total
     * Will get the total of all the multipliers.
     *
     * @return float
     */
    public function getTotal()
    {
        $total = $this->amount;
        for ($i = 0; $i < count($this->multipliers); $i++) {
            $multi = $this->multipliers[$i];
            $total = round($total * $multi->getMultiplier(), 2);
        }
        return $total;
    }

    /**
     * Will Return an array with the details on how it got the total.
     *
     * @return string
     */
    public function getDetails()
    {
        $total = $this->amount;
        $details = [];
        $details["multipliers"] = [];
        for ($i = 0; $i < count($this->multipliers); $i++) {
            $multi = $this->multipliers[$i];
            $total = round($total * $multi->getMultiplier(), 2);

            $classNameWithNamespace = get_class($multi);
            $className = substr($classNameWithNamespace, strrpos($classNameWithNamespace, '\\') + 1);
            $details["multipliers"][$className] = [
                "multiplier" => floatval($multi->getMultiplier()),
                "newTotal" => $total
            ];
        }
        $details["total"] = $total;
        return $details;
    }
}
