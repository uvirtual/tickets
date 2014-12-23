<?php


/**
 * Clase Conexion a base de datos
 */
class ConexionDb
{
    // variables

    protected $_pdo;

    private $dbhost;
    private $dbname;
    private $dbpass;

    public function __construct()
    {
        $this->dbhost = "mysql:host=localhost;dbname=ti";
        $this->dbname = "root";
        $this->dbpass = "";

        try{
            $this->_pdo = new PDO($this->dbhost,$this->dbname,$this->dbpass);
            $this->_pdo->exec("SET CHARACTER SET utf8");
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo 'Error: '. $e->getMessage();
        }
    }

    // recuperamos el valor de pdo.
    public function RtnPdo()
    {
        return $this->_pdo;
    }

    public function __clone()
    {
        trigger_error("No esta permitida la clonación del objeto",E_USER_ERROR);
    }


}


?>