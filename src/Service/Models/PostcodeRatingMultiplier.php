<?php
namespace App\Service\Models;

class PostalRatingMultiplier implements MultiplierInterface
{
    private $postal = "";

    public function __construct(string $postal)
    {
        $this->setValue($postal);
    }

    public function setValue(string $value)
    {
        $this->postal = $value;
    }

    public function getMultiplier()
    {
        return 2;
    }
}
