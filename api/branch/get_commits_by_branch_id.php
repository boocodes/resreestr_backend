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


    $commits = new Commit();
    $commits->set_connection($dbConnection);


    $data = json_decode(file_get_contents('php://input'), true);
    // branch_id, contain_id, contain_title, contain_author_login


    $branch_id = $contain_branch->get_branch_id_by_title_and_contain_id($data["branch_title"], $data["contain_id"]);



    $commits->set_branch_id($branch_id);
    $commits_list = $commits->get_commits_list_by_branch_id();

    if($commits_list){
        http_response_code(200);
        echo json_encode(array("message"=>$commits_list));
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>array()));
    }









?>