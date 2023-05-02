<?php
    class Contain_branch{

        private $conn;
        private $table_name;

        private $contain_id;
        private $branch_link;
        private $id;
        private $branch_title;

        //get connection
        public function setConnection($db){
            $this->conn = $db;
        }

        //getters
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
        public function createNewBranch(){}

        public function editBranch(){}

        public function deleteBranch(){}

    }

?>