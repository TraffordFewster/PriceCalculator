<?php
/**
 * Age Rating Multiplier
 * The Age Rating Multiplier class file.
 * PHP Version 8.0.2
 * 
 * @category Multipliers
 * @package  QuoteEngine
 * @author   Trafford Fewster <contact@trafford.dev>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/TraffordFewster/PriceCalculator
 */
namespace App\Service\Models;

use App\Service\Storage\Database;

/**
 * AgeRatingMultiplier class
 * A simple class using the MultiplierInterface to provide the multiplier for Age
 * 
 * @category Multipliers
 * @package  QuoteEngine
 * @author   Trafford Fewster <contact@trafford.dev>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/TraffordFewster/PriceCalculator
 */
class AgeRatingMultiplier implements MultiplierInterface
{
    private $_age = "";

    /**
     * Constructor
     * The constructor to setup the class.
     * 
     * @param string $age The age to check.
     */
    public function __construct(string $age)
    {
        $this->setValue($age);
    }

    /**
     * Set Value
     * Sets the value of the age.
     *
     * @param string $value the value to set the registration too
     * 
     * @return void
     */
    public function setValue(string $value)
    {
        $this->_age = $value;
    }

    /**
     * Get Multiplier
     * Gets the multiplier for the age provided.
     *
     * @return float
     */
    public function getMultiplier()
    {
        $sql = 'SELECT rating_factor
                FROM age_rating
                WHERE age = :age';
        $db = new Database();
        $query = $db->prepare($sql);
        $query->execute([":age" => $this->_age]);
        $result = $query->fetchColumn();
        return $result;
    }
}
