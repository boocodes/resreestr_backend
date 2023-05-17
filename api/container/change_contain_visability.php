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
    // login, password, new_contain_visibility_flag, contain_title

    $user = new User();
    $user->set_login($data["login"]);
    $user->set_password($data["password"]);

    if($user->get_user_by_login_and_password()){
        $contain->set_contain_author_login($data["login"]);
        $contain->set_contain_title($data["contain_title"]);
        if($contain->change_contain_visibility_flag($data["new_contain_visibility_flag"])){
            http_response_code(200);
            echo json_encode(array("message"=>"Успешно изменена приватность контейнера"));
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=>"Ошибка при изменении приаватности контейнера"));
        }

    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка авторизации"));
    }










?>