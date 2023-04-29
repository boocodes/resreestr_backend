<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once "../../config/database.php";
    include_once "../../config/User.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();

    $user = new User();
    $user->setConnection($dbConnection);

    $data = json_decode(file_get_contents('php://input'), true);

    //put paswword and login for user auth

    $user->set_password($data["password"]);
    $user->set_login($data["login"]);


    // check input fields by empty
    if(!empty($data["firstname"])){
        $user->set_firstname($data["firstname"]);
    }
    if(!empty($data["mail"])){
        $user->set_mail($data["mail"]);
    }
    if(!empty($data["about"])){
        $user->set_about($data["about"]);
    }
    if(!empty($data["url_link_social"])){
        $user->set_url_link_social($data["url_link_social"]);
    }
    if(!empty($data["organisation"])){
        $user->set_organisation($data["organisation"]);
    }
    if(!empty($data["location"])){
        $user->set_location($data["location"]);
    }
    
    $result = $user->update_base_user_fields();
    if($result){
        http_response_code(200);
        $result = $user->get_user_by_login_and_password();
        if($result){
            http_response_code(200);
            echo json_encode(array("message"=>$result));
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=>"Error"));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Error changed"));
    }
    
   

?>