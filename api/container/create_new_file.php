<?php
    include_once "../headers/post/index.php";
    include_once "../../config/Contain.php";
    include_once  "../../config/User.php";
    include_once "../../config/database.php";
    include_once "../../config/Contain_branch.php";
    include_once "../../config/Commit.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();


    $contain = new Contain();
    $contain->setConnection($dbConnection);


    $contain_branch = new Contain_branch();
    $contain_branch->setConnection($dbConnection);


    $data = json_decode(file_get_contents('php://input'), true);
    // login, password, contain_title, branch_title, new_comment_title, file_value, file_name, previous_comment_title

    $user = new User();
    $user->setConnection($dbConnection);
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
//    if(file_exists("../../contains_storage" . $data["login"] . "/" . $data["contain_title"] . "/" . $data["branch_title"])){
//        echo json_encode("good");
//    }
//    echo json_encode($data, true);

    // auth check
    $auth_result = $user->get_user_by_login_and_password();
    if($auth_result){

        $branch_id = $contain_branch->get_branch_id_by_title_and_contain_id($data["branch_title"], $data["contain_id"]);


        $commit = new Commit();
        $commit->set_connection($dbConnection);
        $commit->set_title($data["commit_text"]);
        $commit->set_link("net");
        $commit->set_branch_id($branch_id);

        $creating_new_commit = $commit->create_new_commit();
        if($creating_new_commit){
            mkdir("../../contains_storage/" . $data["login"] . "/" . $data["contain_title"] . "/" . $data["commit_text"], "0777");
            file_put_contents("../../contains_storage/" . $data["login"] . "/" . $data["contain_title"] . "/" . $data["commit_text"] . "/" . $data["file_name"], $data["file_value"]);
            http_response_code(200);
            echo json_encode(array("message"=>"Комментарий успешно создан"));
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=>"Возникла ошибка при создании комментария"));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка авторизации"));
    }










?>