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
    // login, password, contain_title, new_contain_title

    $user = new User();
    $user->setConnection($dbConnection);
    $user->set_login($data["login"]);
    $user->set_password($data["password"]);
    $result = $user->get_user_by_login_and_password();


    if($result){
        $contain->set_contain_author_login($data["login"]);
        $contain->set_contain_title($data["contain_title"]);
        if($contain->rename_contain($data["new_contain_title"])){

            rename("../../contains_storage/". $data["login"] . "/" . $data["contain_title"], "../../contains_storage/" . $data["login"] . "/" . $data["new_contain_title"]);

            http_response_code(200);
            echo json_encode(array("message"=>"Конейнер успешно переименован"));
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=>"Ошибка при изменении названия контейнера"));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка авторизации"));

    }









?>