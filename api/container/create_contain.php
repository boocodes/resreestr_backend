<?php
    include_once "../headers/post/index.php";
    include_once "../../config/database.php";
    include_once "../../config/Contain.php";
    include_once "../../config/Contain_branch.php";

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



    //check if contain already exist with this title
    if(!$contain->get_contain_by_user_id_and_title()){
        $contain_branch = new Contain_branch();
        $contain_branch->setConnection($dbConnection);



        $result = $contain->create_contain();

        if($result){
            http_response_code(200);
            mkdir("../../contains_storage/".$data["contain_author_login"]."/".$data["contain_title"], "0777"); // make dir of contain
            mkdir("../../contains_storage/".$data["contain_author_login"]."/".$data["contain_title"]. "/" . $contain->get_default_branch(), "0777"); // make dir of default branch
            mkdir("../../contains_storage/".$data["contain_author_login"]."/".$data["contain_title"]. "/" . $contain->get_default_branch() . "/Initial commit" ,"0777"); // make dir of first commit
            $contain->update_contain_size_value();
            $contain->update_contain_size_at_database();
            $contain_data = $contain->get_contain_id_by_contain_title_and_user($data["contain_title"], $data["contain_author_login"]);
            $contain_branch->create_firts_init_branch($contain_data["contain_id"]);
            echo json_encode(array("message"=>"Контейнер успешно создан"));
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=>"Ошибка при создании контейнера"));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Контейнер с таким названием уже существует"));
    }





    
    
    
    return 0;
?>