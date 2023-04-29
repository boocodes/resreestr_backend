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
        public function get_firstname(){
            return $this->firstname;
        }
        public function get_lastname(){
            return $this->lastname;
        }
        public function get_user_id(){
            return $this->user_id;
        }
        public function get_mail(){
            return $this->mail;
        }
        public function get_password(){
            return $this->password;
        }
        public function get_created(){
            return $this->created;
        }
        public function get_updated(){
            return $this->updated;
        }
        public function get_login(){
            return $this->login;
        }
        public function get_workspace_id(){
            return $this->workspace_id;
        }
        public function get_organisation(){
            return $this->organisation;
        }
        public function get_location(){
            return $this->location;
        }
        public function get_about(){
            return $this->about;
        }
        public function get_url_link_social(){
            return $this->url_link_social;
        }
        public function get_avatar_src(){
            return $this->avatar_src;
        }
        public function get_achievements(){
            return $this->achievements;
        }

        //setters
        public function set_workspace_id($workspace_id){
            $this->workspace_id = $workspace_id;
        }
        public function set_firstname($firstname){
            $this->firstname = $firstname;
        }
        public function set_lastname($lastname){
            $this->lastname = $lastname;
        }
        public function set_user_id($user_id){
            $this->user_id = $user_id;
        }
        public function set_mail($mail){
            $this->mail = $mail;
        }
        public function set_password($password){
            $this->password = $password;
        }
        public function set_updated($updated){
            $this->updated = $updated;
        }
        public function set_login($login){
            $this->login = $login;
        }
        public function set_organisation($organisation){
            $this->organisation = $organisation;
        }
        public function set_location($location){
            $this->location = $location;
        }
        public function set_about($about){
            $this->about = $about;
        }
        public function set_url_link_social($url_link_social){
            $this->url_link_social = $url_link_social;
        }
        public function set_avatar_src($avatar_src){
            $this->avatar_src = $avatar_src;
        }
        public function set_achievements($achievements){
            $this->achievements = $achievements;
        }


        // set fields
        public function set_user_fields($firstname, $lastname, $user_id, $mail, $password,  $login){
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->user_id = $user_id;
            $this->mail = $mail;
            $this->password = $password;
            $this->login = $login;
            return true;
        }

        // check a fields by empty
        public function check_field_by_empty_parametr(){
            if(!empty($this->get_firstname()) &&
                !empty($this->get_lastname()) &&
                !empty($this->get_mail()) &&
                !empty($this->get_password()) &&
                !empty($this->get_login())
            ){
                return true;
            }
            else{
                return false;
            }
        }

        // INSERT INTO `rosreestr_main` (`firstname`, `lastname`, `mail`, `password`, `created`, `updated`, `login`, `workspaces_id`, `user_id`) VALUES ('ncfd', 'ncfd', 'ncfd', 'ncfd', 'ncfd', '2131', 'rewrw', 'rwrwerw', 'rewrwrw');


        //registrate user
        public function registrate_user(){
            $query = "INSERT INTO `".$this->table_name."` (`firstname`, `lastname`, `mail`, `password`, `login`, `organisation`, `location`, `about`, `url_link_social`, `avatar_src`, `achievements`, `modified`, `created`, `user_id`) VALUES ('".$this->firstname."', '".$this->lastname."', '".$this->mail."', '".$this->password."', '".$this->login."', '', '', '', '', '".$this->avatar_src."', '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL);";
            $stmt = $this->conn->prepare($query);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function check_if_login_already_exist($login_search){
            $query = "SELECT *  FROM `".$this->table_name."` WHERE `login`='".$login_search."';";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row){
                return true;
            }
            else{
                return false;
            }

        }


        // get user by login and password
        public function get_user_by_login_and_password(){
            $query = "SELECT * FROM `".$this->table_name."` WHERE login='".$this->login."' AND password='".$this->password."';";
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

        public function get_public_user_data_by_login($login){
            $query = "SELECT * FROM `rosreestr_main` WHERE login='".$login."';";
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

        // update user data methods
        public function update_firstname($firstname, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `firstname`='".$firstname."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return $query;
            }
            else{
                return false;
            }

        }
        public function update_lastname($lastname, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `lastname`='".$lastname."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return $query;
            }
            else{
                return false;
            }
        }
        public function update_mail($mail, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `mail`='".$mail."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return $query;
            }
            else{
                return false;
            }
        }
        public function update_password($passwordNew, $login, $password){
            $query = "UPDATE `".$this->table_name."` SET `password`='".$passwordNew."' WHERE `login`='".$login."' AND `password`='".$password."';";

            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return $query;
            }
            else{
                return false;
            }
        }
        public function update_about($password, $login, $about_new){
            $query = "UPDATE `".$this->table_name."` SET `about`='".$about_new."' WHERE `login`='".$login."' AND `password`='".$this->password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return $query;
            }
            else{
                return false;
            }
        }
        public function update_location($password, $login, $location_new){
            $query = "UPDATE `".$this->table_name." SET `location`='".$location_new."' WHERE `login`='".$login."' AND `password`='".$password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return $query;
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>$query));
                return false;
            }
        }
        public function update_organisation($password, $login, $organisation_new){
            $query = "UPDATE `".$this->table_name." SET `organisation`='".$organisation_new."' WHERE `login`='".$login."' AND `password`='".$password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return $query;
            }
            else{
                return false;
            }
        }
        public function update_avatar_src($password, $login, $avatar_src_new){
            $query = "UPDATE ".$this->table_name." SET `avatar_src`='".$avatar_src_new."' WHERE `login`='".$login."' AND `password`='".$password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                echo json_encode($query);
                return $query;
            }
            else{
                return false;
            }
        }

        public function update_base_user_fields(){
            $query = "UPDATE ".$this->table_name." SET `firstname`='".$this->firstname."', `mail`='".$this->mail."', `about`='".$this->about."', `url_link_social`='".$this->url_link_social."', `organisation`='".$this->organisation."', `location`='".$this->location."' WHERE `login`='".$this->login."' AND `password`='".$this->password."' ;";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function update_achievements($password, $login, $achievements_new){
            $query = "UPDATE `".$this->table_name." SET `achievements`='".$achievements_new."' WHERE `login`='".$login."' AND `password`='".$password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return $query;
            }
            else{
                return false;
            }
        }

        public function update_url_link_social($password, $login, $url_link_social_new){
            $query = "UPDATE ".$this->table_name." SET `location`='".$url_link_social_new."' WHERE `login`='".$login."' AND `password`='".$password."';";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return $query;
            }
            else{
                return false;
            }
        }

        public function get_user_by_id_and_password(){
            $query = "SELECT * FROM ".$this->table_name." WHERE `user_id`='".$this->user_id."' AND `password`='$this->password'; ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row){
                return true;
            }
            else{
                return false;
            }
        }
        public function get_user_id_by_login(){
            $query = "SELECT `user_id` FROM `".$this->table_name."` WHERE `login`='".$this->login."'; ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row){
                return $row["user_id"];
            }
            else{
                return false;
            }
        }

        public function get_userdata_by_login(){
            $query = "SELECT `firstname`, `lastname`, `mail`, `login`, `organisation`, `location`, `about`, `url_link_social`, `avatar_src`, `achievements` FROM `".$this->table_name."` WHERE `login`='".$this->login."';";
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


    }
?>