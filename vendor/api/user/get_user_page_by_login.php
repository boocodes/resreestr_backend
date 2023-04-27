<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
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