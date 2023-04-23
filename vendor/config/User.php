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
        private $achievements;
        private $about;
        private $location;
        private $organisation;
        private $url_link_social;
        private $avatar_src;
        private $workspace_id;

        //get connection
        public function setConnection($db){
            $this->conn = $db;
        }

        //getters
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
        public function getOrganisation(){
            return $this->organisation;
        }
        public function getLocation(){
            return $this->location;
        }
        public function getAbout(){
            return $this->about;
        }
        public function getUrlLinkSocial(){
            return $this->url_link_social;
        }
        public function getAvatarSrc(){
            return $this->avatar_src;
        }
        public function getAchievements(){
            return $this->achievements;
        }

        //setters
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
        public function setOrganisation($organisation){
            $this->organisation = $organisation;
        }
        public function setLocation($location){
            $this->location = $location;
        }
        public function setAbout($about){
            $this->about = $about;
        }
        public function setUrlLinkSocial($url_link_social){
            $this->url_link_social = $url_link_social;
        }
        public function setAvatarSrc($avatar_src){
            $this->avatar_src = $avatar_src;
        }
        public function setAchievements($achievements){
            $this->achievements = $achievements;
        }


        // set fields
        public function setUserFields($firstname, $lastname, $user_id, $mail, $password, $created, $updated, $login, $workspace_id, $organisation, $location, $about, $url_link_social, $avatar_src, $achievements){
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->user_id = $user_id;
            $this->mail = $mail;
            $this->password = $password;
            $this->created = $created;
            $this->updated = $updated;
            $this->login = $login;
            $this->workspace_id = $workspace_id;
            $this->organisation = $organisation;
            $this->location = $location;
            $this->about = $about;
            $this->url_link_social = $url_link_social;
            $this->avatar_src = $avatar_src;
            $this->achievements = $achievements;
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
                !empty($this->getWorkspace_id()) &&
                !empty($this->getOrganisation()) &&
                !empty($this->getLocation()) &&
                !empty($this->getAbout()) &&
                !empty($this->getUrlLinkSocial()) &&
                !empty($this->getAvatarSrc()) &&
                !empty($this->getAchievements())
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

        public function getPublicUserDataByLogin($login){
            $query = "SELECT * FROM `rosreestr_main` WHERE login='".$login."';";
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

        // update user data methods
        public function updateFirstname($firstname, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `firstname`='".$firstname."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                http_response_code(200);
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>$query));
                return false;
            }

        }
        public function updateLastname($lastname, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `lastname`='".$lastname."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                http_response_code(200);
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>$query));
                return false;
            }
        }
        public function updateMail($mail, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `mail`='".$mail."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                http_response_code(200);
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>$query));
                return false;
            }
        }
        public function updatePassword($passwordNew, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `password`='".$passwordNew."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                http_response_code(200);
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>$query));
                return false;
            }
        }
        public function updateAbout($password, $login, $about_new){
            $query = "UPDATE `".$this->table_name."` SET `about`='".$about_new."' WHERE `login`='".$login."' AND `password`='".$this->password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                http_response_code(200);
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>$query));
                return false;
            }
        }
        public function updateLocation($password, $login, $location_new){
            $query = "UPDATE `".$this->table_name." SET `location`='".$location_new."' WHERE `login`='".$login."' AND `password`='".$password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                http_response_code(200);
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>$query));
                return false;
            }
        }
        public function updateOrganisation($password, $login, $organisation_new){
            $query = "UPDATE `".$this->table_name." SET `organisation`='".$organisation_new."' WHERE `login`='".$login."' AND `password`='".$password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                http_response_code(200);
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>$query));
                return false;
            }
        }
        public function updateAvatarSrc($password, $login, $avatar_src_new){
            $query = "UPDATE `".$this->table_name." SET `avatar_src`='".$avatar_src_new."' WHERE `login`='".$login."' AND `password`='".$password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                http_response_code(200);
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>$query));
                return false;
            }
        }
        public function updateAchievements($password, $login, $achievements_new){
            $query = "UPDATE `".$this->table_name." SET `achievements`='".$achievements_new."' WHERE `login`='".$login."' AND `password`='".$password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                http_response_code(200);
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>$query));
                return false;
            }
        }

        public function updateUrlLinkSocial($password, $login, $url_link_social_new){
            $query = "UPDATE `".$this->table_name." SET `location`='".$url_link_social_new."' WHERE `login`='".$login."' AND `password`='".$password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                http_response_code(200);
                echo json_encode(array("message"=>$query));
                return true;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>$query));
                return false;
            }
        }

        public function getWorkspaceByUserId($login, $password, $user_id){
            $query = "SELECT * FROM `".$this->table_name."` WHERE login='".$login."' AND password='".$password."';";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);


            if($row){
               $query = "SELECT * FROM '".$this->workspace_table_name."' WHERE `user_id`='".$user_id."'";
               $stmt = $this->conn->prepare($query);
               if($stmt->execute()){
                   $row = $stmt->fetch(PDO::FETCH_ASSOC);
                   http_response_code(200);
                   echo json_encode(array("message"=>$row));
               }
               else{
                   http_response_code(400);
                   echo json_encode(array("message"=>"Ошибка авторизации"));
               }
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>"Ошибка авторизации"));
            }
        }




    }
?>