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
            $query = "INSERT INTO `".$this->table_name."`(`contain_id`, `branch_link`, `id`, `branch_title`, `commits_links`, `branch_size`, `main_language`) VALUES ('".$this->contain_id."','".$this->branch_link."','NULL','".$this->branch_title."','".$this->commits_links."','".$this->branch_size."','".$this->main_language."'); ";
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

    }

?>