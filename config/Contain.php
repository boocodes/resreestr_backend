<?php
    class Contain{

        private $conn;
        private $table_name = "rosreestr_contain";

        private $contain_title;
        private $contain_description;
        private $contain_link;
        private $contain_private;
        private $contain_white_list;
        private $user_id;
        private $contain_author_login;
        private $branches_count;
        private $default_branch;

        //get connection
        public function setConnection($db){
            $this->conn = $db;
        }

        //getters
        public function getConnection(){
            return $this->conn;
        }

        public function get_contain_while_list(){
            return $this->contain_white_list;
        }
        public function get_contain_author_login(){
            return $this->contain_author_login;
        }
        public function get_contain_link(){
            return $this->contain_link;
        }
        public function get_branches_count(){
            return $this->branches_count;
        }
        public function get_default_branch(){
            return $this->default_branch;
        }

        public function get_contain_title(){
            return $this->contain_title;
        }
        public function get_containPrivate(){
            return $this->contain_private;
        }
        public function get_contain_description(){
            return $this->contain_description;
        }

        //setters
        public function set_contain_description($contain_description){
            $this->contain_description = $contain_description;
        }
        public function set_contain($contain){
            $this->contain = $contain;
        }
        public function set_contain_id($contain_id){
            $this->contain_id = $contain_id;
        }
        public function set_title($title){
            $this->title = $title;
        }
        public function set_contain_title($contain_title){
            $this->contain_title = $contain_title;
        }
        public function set_contain_white_list($contain_white_list){
            $this->contain_white_list = $contain_white_list;
        }
        public function set_user_id($user_id){
            $this->user_id = $user_id;
        }
        public function set_branches_count($branches_count){
            $this->branches_count = $branches_count;
        }
        public function set_default_branch($default_branch){
            $this->default_branch;
        }
        public function set_contain_author_login($contain_author_login){
            $this->contain_author_login = $contain_author_login;
        }
        public function set_contain_private($contain_private){
            $this->contain_private = $contain_private;
        }
        public function set_contain_link($contain_link){
            $this->contain_link = $contain_link;
        }

        //methods
        public function create_contain(){
            $query = "INSERT INTO `rosreestr_contain` (`title`, `contain_link`, `private`, `user_id`, `edited`, `created`, `contain_id`, `description`, `white_user_id_list`, `contain_author_login`, `branches_count`, `default_branch`) VALUES ('".$this->contain_title."', '".$this->contain_link."', '".$this->contain_private."', '".$this->user_id."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, '".$this->contain_description."', '".$this->contain_white_list."', '".$this->contain_author_login."', '".$this->branches_count."', '".$this->default_branch."');";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return "Контейнер успешно создан";
            }
            else{
                return false;
            }
        }

        public function get_contains_by_user_id(){
            $query = "SELECT * FROM `".$this->table_name."` WHERE `user_id`='".$this->user_id."'; ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $contain_count = $stmt->rowCount();

            if($contain_count>0){
                $contains_arr = array();
                $contains_arr["records"] = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $contain_item = array(
                        "title"=>$title,
                        "contain_link"=>$contain_link,
                        "private"=>$private,
                        "user_id"=>$user_id,
                        "edited"=>$edited,
                        "created"=>$created,
                        "contain_id"=>$contain_id,
                        "description"=>$description,
                        "contain_author_login"=>$contain_author_login,
                    );
                    array_push($contains_arr["records"], $contain_item);
                }
                http_response_code(200);
                return $contains_arr["records"];
            }
            else{
                return false;
            }
        }

        public function get_contain_by_user_id_and_title($master_user_id){
            $query = "SELECT * FROM `".$this->table_name."` WHERE `user_id`='".$this->user_id."' AND `title`='".$this->contain_title."'; ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row){
                return $row;
            }
            else{
                return false;
            }

        }

        public function rename_contain($new_contain_title){
            $query = "UPDATE `".$this->table_name."` SET `title`='".$new_contain_title."' WHERE `contain_author_login`='".$this->contain_author_login."' AND `title`='".$this->contain_title."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function delete_contain(){
            $query = "DELETE FROM `".$this->table_name."` WHERE `title` = '".$this->contain_title."' AND `contain_author_login` = '".$this->contain_author_login."'";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }
        public function change_contain_visibility_flag($new_visibility_contain_flag){
            $query = "UPDATE `".$this->table_name."` SET `private`='".$new_visibility_contain_flag."' WHERE `contain_author_login` = '".$this->contain_author_login."' AND `title` = '".$this->contain_title."'";
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