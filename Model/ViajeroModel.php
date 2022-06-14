<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class ViajeroModel extends Database
{
    public function getPerfiles()
    {
        return $this->select("SELECT * FROM PerfilViajero ORDER BY idPerfil ASC ");
    }
    public function getTipoViajero()
    {
        return $this->select("SELECT * FROM TipoViajero ORDER BY idTipoViajero ASC ");
    }
}