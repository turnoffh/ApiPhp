<?php
class UsuarioController extends BaseController
{
    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function RegisterUser()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UsuarioModel();
                $data = json_decode(file_get_contents('php://input'), true);
                $responseData = json_encode($userModel->registrarUsuario($data), JSON_UNESCAPED_UNICODE);
                
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
    public function Login()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $userModel = new UsuarioModel();
                $data = json_decode(file_get_contents('php://input'), true);
                $responseData = json_encode($userModel->validarUsuario($data), JSON_UNESCAPED_UNICODE);
                
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