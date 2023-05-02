<?php
    include_once "../headers/post/index.php";
    include_once "../../config/database.php";
    include_once "../../config/User.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();

    $user = new User();
    $user->setConnection($dbConnection);

    $data = json_decode(file_get_contents("php://input"), true);

    $result = $user->updateFirstname("bebrina", "dens", "1234");

    if($result){
        http_response_code(200);
        echo json_encode(array("message"=>$result));
        return true;
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка!"));
        return false;
    }

?>