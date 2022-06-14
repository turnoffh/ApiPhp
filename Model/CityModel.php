<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class CityModel extends Database
{
    public function getCity($limit)
    {
        return $this->select("SELECT * FROM Ciudad ORDER BY idCiudad ASC LIMIT " . $limit);
    }
    public function CityByCountry($CountryCode)
    {
        return $this->select("SELECT * FROM Ciudad WHERE CodigoPais = '" . $CountryCode ."' ORDER BY nombre ASC");
    }
}