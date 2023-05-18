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
    // login, password, contain_title, new_branch_title

    $user = new User();
    $user->set_login($data["login"]);
    $user->set_password($data["password"]);


    $auth_result = $user->get_user_by_login_and_password();

    if($auth_result){

    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка авторизации"));
    }






?>