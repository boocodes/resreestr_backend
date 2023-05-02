<?php
    include_once "../headers/post/index.php";
    include_once "../../config/database.php";
    include_once "../../config/User.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();
    
    $user = new User();
    $user->setConnection($dbConnection);
    
    
    $data = json_decode(file_get_contents('php://input'), true);

    

?>