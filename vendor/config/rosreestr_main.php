<?php
    class RosreestrMain{

        // main table settings
        private $conn;
        private $table_name = "rosreestr_main";


        // table fields values
        private $firstname;
        private $lastname;
        private $mail;
        private $password;
        private $created;
        private $updated;
        private $login;
        private $workspace_id;

        //get connection

        public function getConnection($db){
            $this->conn = $db;
        }



    }
?>