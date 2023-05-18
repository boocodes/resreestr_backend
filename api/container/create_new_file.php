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
    // login, password, contain_title, branch_title, new_comment_title, file_value, file_name, previous_comment_title

    $user = new User();
    $user->set_login($data["login"]);
    $user->set_password($data["password"]);

//    if(1){
//        echo json_encode(array("message"=>"../../contains_storage/" . $data["login"] . "/" . $data["contain_title"] . "/" . $data["branch_title"]));
//        if(file_exists("../../contains_storage" . $data["login"] . "/" . $data["contain_title"] . "/" . $data["branch_title"])){
//            copy("../../contains_storage" . $data["login"] . "/" . $data["contain_title"] . "/" . $data["branch_title"] . "/" . $data["previous_comment_title"], "../../contains_storage" . $data["login"] . "/" . $data["contain_title"] . "/" . $data["branch_title"] . "/" . $data["new_comment_title"]);
//            file_put_contents("../../contains_storage" . $data["login"] . "/" . $data["contain_title"] . "/" . $data["branch_title"] . "/" . $data["new_comment_title"] . "/" . $data["file_name"], $data["file_value"]);
//            http_response_code(200);
//            echo json_encode(array("message"=>"Комментарий успешно создан"));
//        }
//        else{
//            http_response_code(400);
//            echo json_encode(array("message"=>"Ошибка, контейнер не найден"));
//        }
//    }
//    else{
//        http_response_code(400);
//        echo json_encode(array("message"=>"Ошибка авторизации"));
//    }
    if(file_exists("../../contains_storage" . $data["login"] . "/" . $data["contain_title"] . "/" . $data["branch_title"])){
        echo json_encode("good");
    }










?>