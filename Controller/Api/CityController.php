<?php
class CityController extends BaseController
{
    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function List()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new CityModel();

                $intLimit = 10;

                if (isset($arrQueryStringParams['limite']) && $arrQueryStringParams['limite']) {
                    $intLimit = $arrQueryStringParams['limite'];
                }
                $arrUsers = $userModel->getCity($intLimit);
                $responseData = json_encode($arrUsers, JSON_UNESCAPED_UNICODE);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    public function CityByCountry()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new CityModel();

                if (isset($arrQueryStringParams['CodPais']) && $arrQueryStringParams['CodPais']) {
                    $CodPais = $arrQueryStringParams['CodPais'];
                }
                $arrUsers = $userModel->CityByCountry($CodPais);
                $responseData = json_encode($arrUsers, JSON_UNESCAPED_UNICODE);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}