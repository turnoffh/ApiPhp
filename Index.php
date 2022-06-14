<?php

// require __DIR__ . "\include\bootstrap.php";
require __DIR__ . "/include/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if ((isset($uri[3]) && $uri[3] != 'City') && 
    (isset($uri[3]) && $uri[3] != 'Country') &&
    (isset($uri[3]) && $uri[3] != 'Viajero') &&
    (isset($uri[3]) && $uri[3] != 'Usuario')
    ) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
else{
    switch ($uri[3]){
        case "City":
            require PROJECT_ROOT_PATH . "/Controller/Api/CityController.php";
            $objFeedController = new CityController();
            $strMethodName = $uri[4];
            $objFeedController->{$strMethodName}();
            break;
        case "Country":
            require PROJECT_ROOT_PATH . "/Controller/Api/CountryController.php";
            $objFeedController = new CountryController();
            $strMethodName = $uri[4];
            $objFeedController->{$strMethodName}();
            break;
        case "Viajero":
            require PROJECT_ROOT_PATH . "/Controller/Api/ViajeroController.php";
            $objFeedController = new ViajeroController();
            $strMethodName = $uri[4];
            $objFeedController->{$strMethodName}();
            break;
        case "Usuario":
            require PROJECT_ROOT_PATH . "/Controller/Api/UsuarioController.php";
            $objFeedController = new UsuarioController();
            $strMethodName = $uri[4];
            $objFeedController->{$strMethodName}();
            break;
    }

}
?>