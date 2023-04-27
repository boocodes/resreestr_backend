<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once "../../config/database.php";
    include_once "../../config/Contain.php";
    include_once "../../config/User.php";
    include_once "../../config/Environment.php";


    $environment = new Environment();

    $database = new DataBase();
    $dbConnection = $database->setConnection();


    $contain = new Contain();
    $contain->setConnection($dbConnection);
    
    $user = new User();
    $user->setConnection($dbConnection);
    $data = json_decode(file_get_contents('php://input'), true);


    $user->set_login($data["login"]);
    $request_user_id = $user->get_user_id_by_login();
    
    $contain->set_user_id($request_user_id);
    $contain->set_contain_title($data["contain_title"]);
    $contain_request_result =  $contain->get_contain_by_user_id_and_title($data["master_user_id"]);

    if($contain_request_result){

        if($environment->getBooleanFromBooleanText($contain_request_result["private"])){
            if($contain_request_result["user_id"] == $data["master_user_id"]){
                echo json_encode(array("message"=>$contain_request_result));
                http_response_code(200);
                return true;
            }
            else{
                echo json_encode(array("message"=>"Repository closed"));
                http_response_code(200);
                return false;
            }
        }
        else{
            http_response_code(200);
            echo json_encode(array("message"=>$contain_request_result));
            return true;
        }
    }
    else{
        http_response_code(400);
        echo json_encode("Error, container not found");
        return false;
    }



?>