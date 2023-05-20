<?php

    class Commit {


        private $conn;
        private $table_name = "rosreestr_commits";
        private $title;
        private $id;
        private $branch_id;
        private $link = "net";

        //set connection
        public function set_connection($db){
            $this->conn = $db;
        }

        //getters
        public function get_connection(){
            return $this->conn;
        }
        public function get_title(){
            return $this->title;
        }
        public function get_id(){
            return $this->id;
        }
        public function get_branch_id(){
            return $this->branch_id;
        }
        public function get_link(){
            return $this->link;
        }

        //set
        public function set_title($title){
            $this->title = $title;
        }
        public function set_id($id){
            $this->id = $id;
        }
        public function set_branch_id($branch_id){
            $this->branch_id = $branch_id;
        }
        public function set_link($link){
            $this->link = $link;
        }



        public function create_new_commit(){
            $query = "INSERT INTO `".$this->table_name."`(`title`, `id`, `branch_id`, `link`) VALUES ('".$this->title."', NULL ,'".$this->branch_id."','".$this->link."')";
            echo json_encode($query);
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }


    }







?>