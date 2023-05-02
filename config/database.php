<?php
    class DataBase {
        private $host = "rosreestr";
        private $db_name = "rosreestr";
        private $username = "root";
        private $password = "";
        public $conn;

        // get db connection
        public function setConnection(){
            try{
                $this->conn = new PDO("mysql:host=". $this->host. ";dbname=". $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }
            catch (PDOException $exception){
                echo "Connection error: ". $exception->getMessage();
            }
            return $this->conn;
        }

    }

?>