<?php
namespace App\Service\Models;

use App\Service\Storage\Database;

class AbiRatingMultiplier implements MultiplierInterface
{
    private $_regNo = "";

    public function __construct(string $regNo)
    {
        $this->setValue($regNo);
    }

    public function setValue(string $value)
    {
        $this->_regNo = $value;
    }

    public function getMultiplier()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $_ENV['ABI_API_ENDPOINT']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['reg' => $this->_regNo]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        curl_close($ch);

        $results = json_decode($server_output);

        if (!$results->success) {
            return 1;
        }

        $sql = 'SELECT rating_factor
                FROM abi_code_rating
                WHERE abi_code = :abi_code';
        $db = new Database();
        $query = $db->prepare($sql);
        $query->execute([":abi_code" => $results->data->abicode]);
        $result = $query->fetchColumn();
        return $result;
    }
}
