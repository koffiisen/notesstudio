<?php

/**
 * Class DBConnect : connect to the database using config file (config.php)
 */
class DBConnect
{
    private $conn;

    private $driver;
    private $host;
    private $dbname;
    private $dataSourceName;
    private $user;
    private $pass;


    // Connecting to database
    public function connect()
    {
        require_once 'Config.php';

        $this->driver = DB_DRIVER;
        $this->host = DB_HOST;
        $this->dbname = DB_DATABASE;
        $this->dataSourceName = "$this->driver:host=$this->host;dbname=$this->dbname";
        $this->user = DB_USER;
        $this->pass = DB_PASSWORD;

        try {
            $this->conn = new PDO($this->dataSourceName, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        } catch (PDOException $error) {
            echo $error->getMessage();
            exit;
        }
        // return database handler
        return $this->conn;
    }

    //Destruct database connection
    public function disconnect()
    {
        if ($this->conn != null) {
            $this->conn = null;
        }
    }

    // destructor
    function __destruct()
    {
        $this->disconnect();
    }


}

?>
