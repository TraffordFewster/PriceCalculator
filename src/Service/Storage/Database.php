<?php
namespace App\Service\Storage;

class Database extends \PDO
{
    public function __construct()
    {
        parent::__construct($_ENV['SQL_CONNECTION_STRING'],$_ENV['SQL_USERNAME'],$_ENV['SQL_PASSWORD']);
    }
}
