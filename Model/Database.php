<?php
class Database
{
    protected $connection = null;

    public function __construct()
    {
        try {
            
            $this->connection  =  new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME) ;
            // if ($this->connection->connect_error) {
            //     echo "Connection failed: " . $this->connection->connect_error;
            //   }
            // else{
            //     printf("Connected successfully");
            // }
              
            if (!$this->connection ->set_charset("utf8")) {
                 echo "Error loading character set utf8: ". $this->connection ->error;
            }
            if ( mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");   
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }			
    }

    public function select($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
            $stmt->close();

            return  $result;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }
    public function insert($query ="")
    {
        try
        {
            $sentencia =  $this->connection->prepare($query);
            if($sentencia === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
            $sentencia->execute();
            $insertId = mysqli_insert_id($this->connection);
            $sentencia->close();
            return $insertId;
        }
        catch(Exception $ex){
            throw New Exception( $ex->getMessage() );
        }
    }

    private function executeStatement($query = "")
    {
        try {
            $stmt = $this->connection->prepare( $query );

            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }

            $stmt->execute();

            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }	
    }
}