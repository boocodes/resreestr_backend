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
    $contain->set_default_branch("init");
    $contain->set_branches_list(json_encode(array("init")));


    $result = $contain->create_contain();

    if($result){
        http_response_code(200);
        mkdir("../../contains_storage/".$data["contain_author_login"]."/".$data["contain_title"], "0777"); // make dir of contain
        mkdir("../../contains_storage/".$data["contain_author_login"]."/".$data["contain_title"]. "/" . $contain->get_default_branch(), "0777"); // make dir of default branch
        mkdir("../../contains_storage/".$data["contain_author_login"]."/".$data["contain_title"]. "/" . $contain->get_default_branch() . "/Initial commit" ,"0777"); // make dir of first commit
        $contain->update_contain_size_value();
        $contain->update_contain_size_at_database();
        echo json_encode(array("message"=>"Контейнер успешно создан"));
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Ошибка при создании контейнера"));
    }
    
    
    
    return 0;
?>