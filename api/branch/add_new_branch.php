<?php
    include_once "../headers/post/index.php";
    include_once "../../config/Contain.php";
    include_once  "../../config/User.php";
    include_once "../../config/database.php";
    include_once "../../config/Contain_branch.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();

    $contain_branch = new Contain_branch();
    $contain_branch->setConnection($dbConnection);



    $data = json_decode(file_get_contents('php://input'), true);
    // login, password, contain_id, new_branch_title, contain_title

    $user = new User();
    $user->setConnection($dbConnection);
    $user->set_login($data["login"]);
    $user->set_password($data["password"]);


    $auth_result = $user->get_user_by_login_and_password();

    if($auth_result){



        $contain_branch->setContain_id($data["contain_id"]);
        $contain_branch->set_branch_size("0");
        $contain_branch->set_commits_links("net");
        $contain_branch->set_main_language("empty");
        $contain_branch->setBranch_link("net");
        $contain_branch->setBranch_title($data["new_branch_title"]);


        //check if branch with this title already exist
        if(!$contain_branch->get_branch_by_title_and_contain_id()){
            $branch_creating_result = $contain_branch->create_new_branch();
            if($branch_creating_result){
                mkdir("../../contains_storage/".$data["login"]."/".$data["contain_title"]. "/" . $data["new_branch_title"], "0777");
                http_response_code(200);
                echo json_encode(array("message"=>"Ветка успешно создана"));
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>"Ошибка создания ветки"));
            }
        }
        else{

            http_response_code(400);
            echo json_encode(array("message"=>"Ветка с таким названием уже существует!"));
        }

    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка авторизации"));
    }






?>