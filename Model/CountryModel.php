<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class CountryModel extends Database
{
    public function getCountries()
    {
        return $this->select("SELECT CodigoPais, nombre FROM Pais ORDER BY nombre ASC ");
    }
}