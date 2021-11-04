<?php
namespace App\Service\Models;

interface MultiplierInterface
{
    public function setValue(string $value);
    public function getMultiplier();
}