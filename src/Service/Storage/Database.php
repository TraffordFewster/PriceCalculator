<?php

namespace App\Service\Storage;

/**
 * Database
 * An extended PDO that initialises with an SQL connection set by the environment.
 *
 * @category Storage
 * @package  QuoteEngine
 * @author   Trafford Fewster <contact@trafford.dev>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/TraffordFewster/PriceCalculator
 */
class Database extends \PDO
{
    /**
     * Contructor
     * Sets up the connection.
     */
    public function __construct()
    {
        parent::__construct(
            $_ENV['SQL_CONNECTION_STRING'],
            $_ENV['SQL_USERNAME'],
            $_ENV['SQL_PASSWORD']
        );
    }
}
