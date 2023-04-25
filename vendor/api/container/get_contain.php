<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once "../../config/database.php";
    include_once "../../config/Contain.php";
    include_once "../../config/User.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();


    $contain = new Contain();
    $contain->setConnection($dbConnection);

    $data = json_decode(file_get_contents('php://input'), true);


    // put user id in contain field
    $contain->setUser_id($data["user_id"]);

    // check if user have permission to get contain
    $user = new User();
    $user->setConnection($dbConnection);
    $user->setUser_id($data["user_id"]);
    $user->setPassword($data["user_password"]);
    
    
    if($user->get_user_permission_by_id()){
        $contain->get_contain_by_user_id();
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка авторизации"));
        return false;
    }



?>