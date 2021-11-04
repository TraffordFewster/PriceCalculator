<?php
namespace App\Service\Models;

use App\Service\Storage\Database;

class AgeRatingMultiplier implements MultiplierInterface
{
    private $age = "";

    public function __construct(string $age)
    {
        $this->setValue($age);
    }

    public function setValue(string $value)
    {
        $this->age = $value;
    }

    public function getMultiplier()
    {
        $sql = 'SELECT rating_factor
                FROM age_rating
                WHERE age = :age';
        $db = new Database();
        $query = $db->prepare($sql);
        $query->execute([":age" => $this->age]);
        $results = $query->fetchColumn();
        return $results;
    }
}
