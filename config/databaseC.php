<?php
/**
 * Created by PhpStorm.
 * User: Miro
 * Date: 04.03.15.
 * Time: 00:33
 */

namespace config;


class databaseC {

    // specify your own database credentials
    private $host = "127.0.0.1";
    private $db_name = "Baza_DR";
    private $username = "root";
    private $password = "";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(\PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

} 