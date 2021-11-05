<?php
/**
 * Postal Rating Multiplier
 * The Postcode Rating Multiplier class file.
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
 * PostalRatingMultiplier class
 * A simple class using the MultiplierInterface to provide the multiplier for Postal
 * Codes.
 * 
 * @category Multipliers
 * @package  QuoteEngine
 * @author   Trafford Fewster <contact@trafford.dev>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/TraffordFewster/PriceCalculator
 */
class PostalRatingMultiplier implements MultiplierInterface
{
    private $_postal = "";

    /**
     * Constructor
     * The constructor to setup the class.
     * 
     * @param string $postal The postal code number.
     */
    public function __construct(string $postal)
    {
        $this->setValue($postal);
    }

    /**
     * Set Value
     * Sets the value of the areaCode based on a postal code.
     *
     * @param string $value the value to set the registration too
     * 
     * @return void
     */
    public function setValue(string $value)
    {
        $areaCode = explode(" ", $value)[0];
        $this->_postal = $areaCode;
    }

    /**
     * Get Multiplier
     * Gets the multiplier for the area code based on the postal code provided.
     *
     * @return float
     */
    public function getMultiplier()
    {
        $sql = 'SELECT rating_factor
                FROM postcode_rating
                WHERE postcode_area = :postcode';
        $db = new Database();
        $query = $db->prepare($sql);
        $query->execute([":postcode" => $this->_postal]);
        $result = $query->fetchColumn();
        return $result;
    }
}