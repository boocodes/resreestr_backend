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


    $user->setUserFields(
        $data["firstname"],
        $data["lastname"],
        $data["user_id"],
        $data["mail"],
        $data["password"],
        $data["created"],
        $data["updated"],
        $data["login"],
        $data["workspace_id"]
    );

    if($user->checkFieldByEmptyParametr() && !empty($user->getConnection())){
        http_response_code(200);
        $user->registrateUser();
        echo json_encode(array("message"=>"Пользователь успешно создан"));
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка при создании пользователя"));
    }

?>