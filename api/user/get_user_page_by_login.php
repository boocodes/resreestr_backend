<?php
    include_once "../headers/post/index.php";
    include_once "../../config/database.php";
    include_once "../../config/User.php";
    include_once "../../config/Environment.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();

    $user = new User();
    $user->setConnection($dbConnection);


    $data = json_decode(file_get_contents('php://input'), true);

    $user->set_login($data["login"]);
    
    $result = $user->get_userdata_by_login();

    if($result){
        http_response_code(200);
        echo json_encode(array("message"=>$result));
        return true;
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"User not found"));
        return false;
    }


?>