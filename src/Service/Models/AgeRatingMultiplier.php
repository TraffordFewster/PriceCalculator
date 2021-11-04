<?php
namespace App\Service\Models;

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
        return 2;
    }
}
