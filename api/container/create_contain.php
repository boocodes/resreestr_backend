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


    //init contains fields
    $contain->set_contain_title($data["contain_title"]); // contains title
    $contain->set_contain_description($data["contain_description"]); // contains description
    $contain->set_contain_private($data["contain_private"]); // contain private flag
    $contain->set_user_id($data["user_id"]); // user id
    $contain->set_contain_author_login($data["contain_author_login"]); // contain author login
    $contain->set_default_branch("init"); // contains default branch



    //check if contain already exist with this title
    if(!$contain->get_contain_by_user_id_and_title()){
        $contain_branch = new Contain_branch(); // init contain branch object
        $contain_branch->setConnection($dbConnection); // pass connection to contain branch object



        $result = $contain->create_contain(); // get result of creating contain func

        if($result){ // check if result of creating contain not false
            // if it`s true and not false
            $contain_id = $contain->get_contain_id_by_contain_title_and_user($data["contain_title"], $data["contain_author_login"]); // get contain id for further operations

            mkdir("../../contains_storage/".$data["contain_author_login"]."/".$data["contain_title"], "0777"); // make dir of contain
            mkdir("../../contains_storage/".$data["contain_author_login"]."/".$data["contain_title"]. "/" . $contain->get_default_branch(), "0777"); // make dir of default branch
            mkdir("../../contains_storage/".$data["contain_author_login"]."/".$data["contain_title"]. "/" . $contain->get_default_branch() . "/initial_commit" ,"0777"); // make dir of first commit



            $contain->set_contain_size_value("0"); // set contains size value in kbites
//            $contain_id = $contain->get_contain_id_by_contain_title_and_user($data["contain_title"], $data["contain_author_login"]);

            $new_branch_data = $contain_branch->create_firts_init_branch($contain_id); // get value of creating first init empty contain`s branch

            $branch_id = $contain_branch->get_branch_id_by_title_and_contain_id("init", $contain_id);

            echo json_encode(array("branch_id"=>$branch_id));


            $commit = new Commit(); // create commit object
            // set commit`s objects fields
            $commit->set_branch_id($branch_id);
            $commit->set_connection($dbConnection);
            $commit->set_title("initial_commit");
            $commit->set_link("net");
            // create new first init empty commit
            $commit->create_new_commit();



            http_response_code(200);
            echo json_encode(array("message"=>"Контейнер успешно создан"));
        }
        // if result of creating container is false (error)
        else{
            http_response_code(400);
            echo json_encode(array("message"=>"Ошибка при создании контейнера"));
        }
    }
    // if container with this title already exist
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Контейнер с таким названием уже существует"));
    }





    
    
    
    return 0;
?>