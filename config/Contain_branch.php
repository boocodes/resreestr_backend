<?php
    class Contain_branch{

        private $conn;
        private $table_name = 'rosreestr_contain_branch';

        private $contain_id;
        private $branch_link;
        private $id;
        private $branch_title;
        private $commits_links;
        private $main_language;
        private $branch_size;


        //get connection
        public function setConnection($db){
            $this->conn = $db;
        }

        //getters
        public function get_main_language(){
            return $this->main_language;
        }
        public function get_branch_size(){
            return $this->branch_size;
        }
        public function get_commits_links(){
            return $this->commits_links;
        }
        public function getConnection(){
            return $this->conn;
        }
        public function getContain_id(){
            return $this->contain_id;
        }
        public function getBranch_link(){
            return $this->branch_link;
        }
        public function getId(){
            return $this->id;
        }
        public function getBranch_title(){
            return $this->branch_title;
        }

        //setters
        public function set_commits_links($commits_links){
            $this->commits_links = $commits_links;
        }
        public function set_main_language($main_language){
            $this->main_language = $main_language;
        }
        public function set_branch_size($branch_size){
            $this->branch_size = $branch_size;
        }
        public function setContain_id($contain_id){
            $this->contain_id = $contain_id;
        }
        public function setBranch_link($branch_link){
            $this->branch_link = $branch_link;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function setBranch_title($branch_title){
            $this->branch_title = $branch_title;
        }


        // methods
        public function create_new_branch(){
            $query = "INSERT INTO `".$this->table_name."`(`contain_id`, `branch_link`, `id`, `branch_title`, `commits_links`, `branch_size`, `main_language`) VALUES ('".$this->contain_id."','".$this->branch_link."',NULL,'".$this->branch_title."','".$this->commits_links."','".$this->branch_size."','".$this->main_language."'); ";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return "Ветка успешно создана";
            }
            else{
                return false;
            }
        }
        public function create_firts_init_branch($contain_id){
            $query = "INSERT INTO `rosreestr_contain_branch` (`contain_id`, `branch_link`, `id`, `branch_title`, `commits_links`, `branch_size`, `main_language`) VALUES ('".$contain_id."', 'net', NULL, 'init', 'net', '0', 'empty');";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){

                return "Ветка успешно создана";
            }
            else{
                return false;
            }
        }

        public function editBranch(){}

        public function deleteBranch(){}

        public function get_branches_by_contain_id(){
            $query = "SELECT * FROM `".$this->table_name."` WHERE `contain_id`='".$this->contain_id."'; ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $contain_count = $stmt->rowCount();

            if($contain_count>0){
                $branches_arr = array();
                $branches_arr["records"] = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $branch_item = array(
                        "contain_id"=>$contain_id,
                        "branch_link"=>$branch_link,
                        "id"=>$id,
                        "branch_title"=>$branch_title,
                        "commits_links"=>$commits_links,
                        "branch_size"=>$branch_size,
                        "main_language"=>$main_language,
                    );
                    array_push($branches_arr["records"], $branch_item);
                }
                http_response_code(200);
                return $branches_arr["records"];
            }
            else{
                return false;
            }
        }

        public function get_branch_by_title_and_contain_id(){
            $query = "SELECT * FROM `".$this->table_name."` WHERE `contain_id`='".$this->contain_id."' AND `branch_title` = '".$this->branch_title."'; ";

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


        public function get_branch_id_by_title_and_contain_id($branch_title, $contain_id){
            $query = "SELECT * FROM `".$this->table_name."` WHERE `contain_id`='".$contain_id."' AND `branch_title`='".$branch_title."';";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row){
                echo json_encode($row);
                return $row;
            }
            else{
                return false;
            }
        }
    }

?>