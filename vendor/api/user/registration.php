<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once "../../config/database.php";
    include_once "../../config/User.php";   

    $database = new DataBase();
    $dbConnection = $database->setConnection();

    $user = new User();
    $user->setConnection($dbConnection);

    $data = json_decode(file_get_contents('php://input'), true);

    
    $user->setFirstname($data["firstname"]);
    $user->setLastname($data["lastname"]);
    $user->setMail($data["mail"]);
    $user->setPassword($data["password"]);
    $user->setLogin($data["login"]);
    
    if($user->checkFieldByEmptyParametr() && !empty($user->getConnection())){
        http_response_code(200);
        $result = $user->registrateUser();
        if($result){
            echo json_encode(array("message"=>"Пользователь успешно создан"));
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=>"Ошибка при создании пользователя"));
        }

    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка, пустые данные"));
    }

?>