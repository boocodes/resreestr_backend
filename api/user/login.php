<?php
    include_once "../headers/post/index.php";
    include_once "../../config/database.php";
    include_once "../../config/User.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();

    $user = new User();
    $user->setConnection($dbConnection);


    $data = json_decode(file_get_contents('php://input'), true);

    $user->set_login($data["login"]);
    $user->set_password($data["password"]);
    $result = $user->get_user_by_login_and_password();

    
    if($result){
        http_response_code(200);
        echo json_encode(array("message"=>$result));
        return true;
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Error, user not found"));
        return false;
    }

?>

