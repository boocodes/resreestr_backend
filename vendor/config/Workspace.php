<?php
    class Workspace{

        private $conn;
        private $table_name = "rosreestr_workspaces";

        private $workspace_id;
        private $containing_id_list;
        private $user_id;
        private $updated;
        private $created;
        private $title;
        private $workspace_link;
        private $private;




        //get connection
        public function setConnection($db){
            $this->conn = $db;
        }

        //getters
        public function getConnection(){
            return $this->conn;
        }
        public function getWorkspace_id(){
            return $this->workspace_id;
        }
        public function getContaining_id_list(){
            return $this->containing_id_list;
        }
        public function getUser_id(){
            return $this->user_id;
        }
        public function getUpdated(){
            return $this->updated;
        }
        public function getCreated(){
            return $this->created;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getWorkspace_link(){
            return $this->workspace_link;
        }
        public function getPrivate(){
            return $this->private;
        }


        //setters
        public function setWorkspace_id($workspace_id){
            $this->workspace_id = $workspace_id;
        }
        public function setContaining_id_list($containing_id_list){
            $this->containing_id_list = $containing_id_list;
        }
        public function setUser_id($user_id){
            $this->user_id = $user_id;
        }
        public function setUpdated($updated){
            $this->updated = $updated;
        }
        public function setCreated($created){
            $this->created = $created;
        }
        public function setTitle($title){
            $this->title = $title;
        }
        public function setWorkspace_link($workspace_link){
            $this->workspace_link = $workspace_link;
        }
        public function setWorkspace_private($private){
            $this->private = $private;
        }


        public function createNewWorkspace(){}

        public function changeWorkspacePrivacyFlag(){}

        public  function changeWorkspaceFields(){}



    }

?>