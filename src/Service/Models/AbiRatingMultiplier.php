<?php

namespace App\Service\Models;

use App\Service\Storage\Database;

/**
 * AbiRatingMultiplier class
 * A simple class using the MultiplierInterface to provide the multiplier for ABI
 * based on a reg.
 *
 * @category Multipliers
 * @package  QuoteEngine
 * @author   Trafford Fewster <contact@trafford.dev>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/TraffordFewster/PriceCalculator
 */
class AbiRatingMultiplier implements MultiplierInterface
{
    /**
     * Registration Number
     * The registration number used to find and ABI code that is checked.
     *
     * @var string
     */
    private string $regNo = "";
    /**
     * Constructor
     * The constructor to setup the class.
     *
     * @param string $regNo The registration number.
     */
    public function __construct(string $regNo)
    {
        $this->setValue($regNo);
    }

    /**
     * Set Value
     * Sets the value of the registration.
     *
     * @param string $value the value to set the registration too
     *
     * @return void
     */
    public function setValue(string $value)
    {
        $this->regNo = $value;
    }

    /**
     * Get Multiplier
     * Gets the multiplier for the ABI based on the registration.
     *
     * @return float
     */
    public function getMultiplier()
    {
        $ch = curl_init();

        /**
         * The mock API just checks if the reg field is provided before returning the following
         * object as JSON
         * [
         *     'success' => true,
         *     'data' => [
         *          'abicode' => '46545255'
         *     ]
         * ]
         */
        curl_setopt($ch, CURLOPT_URL, "https://trafford.dev/mock/abi.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['reg' => $this->regNo]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        curl_close($ch);

        $results = json_decode($server_output);

        $sql = 'SELECT rating_factor
                FROM abi_code_rating
                WHERE abi_code = :abi_code';
        $db = new Database();
        $query = $db->prepare($sql);
        $query->execute([":abi_code" => $results->data->abicode]);
        $result = $query->fetchColumn();
        return $result || 1;
    }
}
