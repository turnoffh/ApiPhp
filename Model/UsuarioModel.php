<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class UsuarioModel extends Database
{
    public function registrarUsuario($arrUser)
    {
        try{
            //Creamos el usuario en la tabla usuarios
            $consultaSQL = "INSERT INTO Usuarios (nombre, email, idPais, idCiudad, telefono, edad, estadoCivil,  password, idTipoViajero, username)";
            $consultaSQL .= " values ('" .$arrUser['nombre']. "','" .$arrUser['email']. "'," .$arrUser['idPais']. "," .$arrUser['idCiudad']. ",'" .$arrUser['telefono']. "','" .$arrUser['edad']. "','" .$arrUser['estadoCivil']. "','" .password_hash($arrUser['password'], PASSWORD_DEFAULT). "'," .$arrUser['idTipoViajero']. ",'".$arrUser['username ']."')";
            //obtenemos el insert id al crear el usuario
            $insertId = $this->insert($consultaSQL);
            //relacionamos el usuario creado con cada perfil seleccionado
            $arry = explode(",",$arrUser['Perfiles']);
            foreach($arry as $p){
                $qry = "INSERT INTO RelPerfilUsuario (idPerfil,idUsuario) values (" . $p . "," . $insertId .")";
                $this->insert($qry);
            }
            $result = [
                "Error" => false,
                "Mensaje" => "Usuario Creado con Exito"
            ];
            return $result;
        }
        catch (Exception $ex){
            $result = [
                'Error' => true,
                'Mensaje' => $ex->getMessage()
            ];
            return $result;
        }
    }
    public function validarUsuario($arrUser)
    {
        try{
            $consulta = sprintf("SELECT * FROM Usuarios WHERE email='%s';",
                                $arrUser['email']);
            $result = $this->connection->query($consulta);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            
            if ($row && password_verify($arrUser['password'], $row['password'])) {
                $response = [
                    'Error' => false,
                    'Mensaje' => "Autenticacion Exitosa"
                ];
                //eliminamos el pwd hasheado
                unset($row['password']);
                //concatenamos la respuesta del usuario con la bd
                $response = $response + $row;
                //agregamos los perfiles asociados al usuario
                $consulta = "SELECT idPerfil FROM RelPerfilUsuario WHERE idUsuario = ". $row['idUsuario'];
                $result = $this->connection->query($consulta);
                $perfiles ="";
                while ($row = $result->fetch_row()) {
                    $perfiles = $perfiles . $row[0] . "," ;
                }
                $perfiles = rtrim($perfiles,",");
                //los concatenamos a la respuesta:
                $response = $response + [
                    'Perfiles' => $perfiles
                ];
                
            } else {
                $response = [
                    'Error' => false,
                    'Mensaje' => "Autenticacion Fallida"
                ];
            }
           
            
            return $response;
            

        }
        catch (Exception $ex){
            $response = [
                'Error' => true,
                'Mensaje' => $ex->getMessage()
            ];
            return $response;
        }
    }
}