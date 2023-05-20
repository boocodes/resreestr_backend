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
//            echo json_encode($query);
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function get_commits_list_by_branch_id(){
            $query = "SELECT * FROM `".$this->table_name."` WHERE `branch_id`='".$this->branch_id."'; ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $commit_count = $stmt->rowCount();

            if($commit_count>0){
                $commits_arr = array();
                $commits_arr["records"] = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $commit_item = array(
                        "title"=>$title,
                        "id"=>$id,
                        "branch_id"=>$branch_id,
                        "link"=>$link,
                    );
                    array_push($commits_arr["records"], $commit_item);
                }
                http_response_code(200);
                return $commits_arr["records"];
            }
            else{
                return false;
            }
        }


    }







?>