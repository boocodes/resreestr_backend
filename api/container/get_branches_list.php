<?php
    include_once "../headers/post/index.php";
    include_once "../../config/Contain.php";
    include_once  "../../config/User.php";
    include_once "../../config/database.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();


    $contain = new Contain();
    $contain->setConnection($dbConnection);

    $data = json_decode(file_get_contents('php://input'), true);
    // login, password, contain_title

    $user = new User();
    $user->set_login($data["login"]);
    $user->set_password($data["password"]);

    if($user->get_user_by_login_and_password()){
        $result = $contain->get_branches_list_from_database();
        if($result){
            http_response_code(200);
            echo json_encode(array("message"=>$result));
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=>"Ошибка в получении списка веток"));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка авторизации"));
    }





?>