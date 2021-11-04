<?php
namespace App\Service\Models;

class AbiRatingMultiplier implements MultiplierInterface
{
    private $regNo = "";

    public function __construct(string $regNo)
    {
        $this->setValue($regNo);
    }

    public function setValue(string $value)
    {
        $this->regNo = $value;
    }

    public function getMultiplier()
    {
        return 2;
    }
}
