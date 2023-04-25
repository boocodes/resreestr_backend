<?php
    class Contain{

        private $conn;
        private $table_name = "rosreestr_contain";

        private $contain_title;
        private $contain_description;
        private $contain_link;
        private $contain_private;
        private $user_id;

        //get connection
        public function setConnection($db){
            $this->conn = $db;
        }

        //getters
        public function getConnection(){
            return $this->conn;
        }


        public function getContain_link(){
            return $this->contain_link;
        }
        public function getContain_title(){
            return $this->contain_title;
        }
        public function getContainPrivate(){
            return $this->contain_private;
        }
        public function getContain_description(){
            return $this->contain_description;
        }

        //setters
        public function setContain_description($contain_description){
            $this->contain_description = $contain_description;
        }
        public function setContain($contain){
            $this->contain = $contain;
        }
        public function setContain_id($contain_id){
            $this->contain_id = $contain_id;
        }
        public function setTitle($title){
            $this->title = $title;
        }
        public function setContain_title($contain_title){
            $this->contain_title = $contain_title;
        }
        public function setUser_id($user_id){
            $this->user_id = $user_id;
        }
        public function setContain_private($contain_private){
            $this->contain_private = $contain_private;
        }
        public function setContain_link($contain_link){
            $this->contain_link = $contain_link;
        }

        //methods
        public function createContain(){
            $query = "INSERT INTO `rosreestr_contain` (`title`, `contain_link`, `private`, `user_id`, `edited`, `created`, `contain_id`, `description`) VALUES ('".$this->contain_title."', '".$this->contain_link."', '".$this->contain_private."', '".$this->user_id."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, '".$this->contain_description."');";

            $stmt = $this->conn->prepare($query);

            if($stmt->execute()){
                http_response_code(200);
                echo json_encode(array("message"=>"Контейнер успешно создан"));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>"Ошибка при создании контейнера"));
                return false;
            }
        }

        public function get_contain_by_user_id(){
            $query = "SELECT * FROM `rosreestr_contain` WHERE `user_id`='$this->user_id';";
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
                    );
                    array_push($contains_arr["records"], $contain_item);
                }
                http_response_code(200);
                echo json_encode(array("message"=>$contains_arr));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>"Ошибка, контейнер не найден"));
                return false;
            }

        }

        public function editContain(){}

        public function deleteContain(){}

    }

?>