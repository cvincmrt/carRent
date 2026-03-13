<?php

namespace App;
use PDO;
use PDOException;

class Database
{
    private string $host = "localhost";
    private string $db_name = "carRent";
    private string $user = "root";
    private string $password = "";
    private string $charset = "utf8mb4";

    private ?PDO $conn = null;

    public function getConnect(){
        if($this->conn === null){
            $dns = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";

            try{
                $this->conn = new PDO($dns,$this->user,$this->password);
            }catch(PDOException $e){
                die("Chyba spojenia".$e->getMessage());
            }
        }
        return $this->conn;
    }
}