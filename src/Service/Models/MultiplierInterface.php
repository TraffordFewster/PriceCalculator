<?php

namespace App\Service\Models;

/**
 * MultiplierInterface
 * The Interface for all multipliers
 *
 * @category Multipliers
 * @package  QuoteEngine
 * @author   Trafford Fewster <contact@trafford.dev>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/TraffordFewster/PriceCalculator
 */
interface MultiplierInterface
{
    /**
     * Set Value
     * Used to set the value the multiplier requires
     *
     * @param string $value the used when getting the multiplier.
     *
     * @return void
     */
    public function setValue(string $value);

    /**
     * Get Multiplier
     * Used to get the multiplier after the value is set.
     *
     * @return float the multiplier.
     */
    public function getMultiplier();
}
