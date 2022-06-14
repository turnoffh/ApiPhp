<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/include/Config.php";

// include the base controller file
require_once PROJECT_ROOT_PATH . "/Controller/Api/BaseController.php";

// include the use model file
require_once PROJECT_ROOT_PATH . "/Model/CityModel.php";

// include the country model file
require_once PROJECT_ROOT_PATH . "/Model/CountryModel.php";

// include the Viajero model file
require_once PROJECT_ROOT_PATH . "/Model/ViajeroModel.php";

// include the Usuario model file
require_once PROJECT_ROOT_PATH . "/Model/UsuarioModel.php";
?>