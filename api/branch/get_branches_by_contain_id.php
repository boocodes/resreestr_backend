<?php
    include_once "../headers/post/index.php";
    include_once "../../config/Contain.php";
    include_once  "../../config/User.php";
    include_once "../../config/database.php";
    include_once "../../config/Contain_branch.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();


    $contain = new Contain();
    $contain->setConnection($dbConnection);

    $contain_branch = new Contain_branch();
    $contain_branch->setConnection($dbConnection);

    $data = json_decode(file_get_contents('php://input'), true);
    // contain_id

    $contain_branch->setContain_id($data["contain_id"]);

    $result = $contain_branch->get_branches_by_contain_id();

    if($result){
        http_response_code(200);
        echo json_encode(array("message"=>$result));
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка при получении веток"));
    }




?>