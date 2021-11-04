<?php
namespace App\Service\Models;

use App\Service\Storage\Database;

class PostalRatingMultiplier implements MultiplierInterface
{
    private $postal = "";

    public function __construct(string $postal)
    {
        $this->setValue($postal);
    }

    public function setValue(string $value)
    {
        $areaCode = explode(" ",$value)[0];
        $this->postal = $areaCode;
    }

    public function getMultiplier()
    {
        $sql = 'SELECT rating_factor
                FROM postcode_rating
                WHERE postcode_area = :postcode';
        $db = new Database();
        $query = $db->prepare($sql);
        $query->execute([":postcode" => $this->postal]);
        $result = $query->fetchColumn();
        return $result;
    }
}
