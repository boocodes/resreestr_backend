<?php
    include_once "../headers/post/index.php";
    include_once "../../config/database.php";
    include_once "../../config/Contain.php";
    include_once "../../config/Contain_branch.php";
    include_once "../../config/Commit.php";



    //init databaseconnection
    $database = new DataBase();
    $dbConnection = $database->setConnection();

    //pass connection into contain object
    $contain = new Contain();
    $contain->setConnection($dbConnection);

    //post data object
    $data = json_decode(file_get_contents('php://input'), true);
    // contain_title, contain_id, new_default_branch, old_default_branch

    $result = $contain->change_default_contain_branch($data["contain_title"], $data["contain_id"], $data["new_default_branch"], $data["old_default_branch"]);


    if($result){
        http_response_code(200);
        echo json_encode(array("message"=>"Успешно изменена начальная ветка"));
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка при изменении начальной ветки"));
    }









?>