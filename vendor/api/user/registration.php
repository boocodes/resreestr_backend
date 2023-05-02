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

    
    $user->set_firstname($data["firstname"]);
    $user->set_lastname($data["lastname"]);
    $user->set_mail($data["mail"]);
    $user->set_password($data["password"]);
    $user->set_login($data["login"]);
    $user->set_avatar_src("https://rosreestr/vendor/images/notExistAvatar.jpg");

    
    //check is login unique
    
    $result = $user->check_if_login_already_exist($data["login"]);

    if($result){
        http_response_code(400);
        echo json_encode(array("message"=>"Login already exist"));
    }
    else{
        if($user->check_field_by_empty_parametr() && !empty($user->getConnection())){
            http_response_code(200);
            $result = $user->registrate_user();
            if($result){
                mkdir("../../contains_storage/".$data["login"], "0777");
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
    }
    
    


?>