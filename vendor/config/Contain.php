<?php
    class Contain{

        private $conn;
        private $table_name = "rosreestr_contain";

        private $created;
        private $updated;
        private $contain;
        private $contain_id;
        private $title;
        private $contain_link;
        private $private;

        //get connection
        public function setConnection($db){
            $this->conn = $db;
        }

        //getters
        public function getConnection(){
            return $this->conn;
        }
        public function getCreated(){
            return $this->created;
        }
        public function getContain(){
            return $this->contain;
        }
        public function getUpdated(){
            return $this->updated;
        }
        public function getContain_id(){
            return $this->contain_id;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getContain_link(){
            return $this->contain_link;
        }
        public function getPrivate(){
            return $this->private;
        }

        //setters
        public function setCreated($created){
            $this->created = $created;
        }
        public function setUpdated($updated){
            $this->updated = $updated;
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
        public function setContain_link($contain_link){
            $this->contain_link = $contain_link;
        }
        public function setPrivate($private){
            $this->private = $private;
        }

        //methods
        public function createContain(){}

        public function editContain(){}

        public function deleteContain(){}

    }

?>