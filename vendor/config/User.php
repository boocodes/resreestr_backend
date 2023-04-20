<?php
    class User{

        // main table settings
        private $conn;
        private $table_name = "rosreestr_main";


        // table fields values
        private $firstname;
        private $lastname;
        private $user_id;
        private $mail;
        private $password;
        private $created;
        private $updated;
        private $login;
        private $workspace_id;

        //get connection
        public function setConnection($db){
            $this->conn = $db;
        }

        //setters
        public function getConnection(){
            return $this->conn;
        }
        public function getFirstname(){
            return $this->firstname;
        }
        public function getLastname(){
            return $this->lastname;
        }
        public function getUser_id(){
            return $this->user_id;
        }
        public function getMail(){
            return $this->mail;
        }
        public function getPassword(){
            return $this->password;
        }
        public function getCreated(){
            return $this->created;
        }
        public function getUpdated(){
            return $this->updated;
        }
        public function getLogin(){
            return $this->login;
        }
        public function getWorkspace_id(){
            return $this->workspace_id;
        }
        public function setWorkspace_id($workspace_id){
            $this->workspace_id = $workspace_id;
        }
        public function setFirstname($firstname){
            $this->firstname = $firstname;
        }
        public function setLastname($lastname){
            $this->lastname = $lastname;
        }
        public function setUser_id($user_id){
            $this->user_id = $user_id;
        }
        public function setMail($mail){
            $this->mail = $mail;
        }
        public function setPassword($password){
            $this->password = $password;
        }
        public function setUpdated($updated){
            $this->updated = $updated;
        }
        public function setLogin($login){
            $this->login = $login;
        }


        // set fields
        public function setUserFields($firstname, $lastname, $user_id, $mail, $password, $created, $updated, $login, $workspace_id){
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->user_id = $user_id;
            $this->mail = $mail;
            $this->password = $password;
            $this->created = $created;
            $this->updated = $updated;
            $this->login = $login;
            $this->workspace_id = $workspace_id;
            return true;
        }

        // check a fields by empty
        public function checkFieldByEmptyParametr(){
            if(!empty($this->getFirstname()) &&
                !empty($this->getLastname()) &&
                !empty($this->getUser_id()) &&
                !empty($this->getMail()) &&
                !empty($this->getPassword()) &&
                !empty($this->getCreated()) &&
                !empty($this->getUpdated()) &&
                !empty($this->getLogin()) &&
                !empty($this->getWorkspace_id())
            ){
                return true;
            }
            else{
                return false;
            }
        }

        // INSERT INTO `rosreestr_main` (`firstname`, `lastname`, `mail`, `password`, `created`, `updated`, `login`, `workspaces_id`, `user_id`) VALUES ('ncfd', 'ncfd', 'ncfd', 'ncfd', 'ncfd', '2131', 'rewrw', 'rwrwerw', 'rewrwrw');


        //registrate user
        public function registrateUser(){

            $query = "INSERT INTO `". $this->table_name."` (`firstname`, `lastname`, `mail`, `password`, `created`, `updated`, `login`, `workspaces_id`, `user_id`) VALUES ('".$this->firstname."', '".$this->lastname."', '".$this->mail."', '".$this->password."', '".$this->created."', '".$this->updated."', '".$this->login."', '".$this->workspace_id."', '".$this->user_id."');";

            $stmt = $this->conn->prepare($query);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }


        // get user by login and password
        public function getUserByLoginAndPassword($login, $password){
            $query = "SELECT * FROM `rosreestr_main` WHERE login='".$login."' AND password='".$password."';";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);


            if($row){
                http_response_code(200);
                echo json_encode(array("message"=>$row));
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>"Пользователь не найден"));
            }
        }


        public function updateFirstname($firstname, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `firstname`='".$firstname."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                echo json_encode(array("message"=>$query));
                return false;
            }

        }
        public function updateLastname($lastname, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `lastname`='".$lastname."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                echo json_encode(array("message"=>$query));
                return false;
            }
        }
        public function updateMail($mail, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `mail`='".$mail."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                echo json_encode(array("message"=>$query));
                return false;
            }
        }
        public function updatePassword($passwordNew, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `password`='".$passwordNew."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                echo json_encode(array("message"=>$query));
                return false;
            }
        }





    }
?>