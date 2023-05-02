<?php
    include_once "../headers/post/index.php";
    include_once "../../config/database.php";
    include_once "../../config/Contain.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();


    $contain = new Contain();
    $contain->setConnection($dbConnection);

    $data = json_decode(file_get_contents('php://input'), true);

    $contain->set_contain_title($data["contain_title"]);
    $contain->set_contain_description($data["contain_description"]);
    $contain->set_contain_private($data["contain_private"]);
    $contain->set_user_id($data["user_id"]);
    $contain->set_contain_author_login($data["contain_author_login"]);


    $result = $contain->create_contain();
    if($result){
        http_response_code(200);
        mkdir("../../contains_storage/".$data["contain_author_login"]."/".$data["contain_title"], "0777");
        echo json_encode(array("message"=>"Контейнер успешно создан"));
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка при создании контейнера"));
    }
    
    
    
    return 0;
?>