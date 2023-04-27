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


    echo json_encode($_FILES);
    echo json_encode($data);

    if(move_uploaded_file($_FILES["filename"]["tmp_name"], "../../images/".$_FILES["filename"]["name"])){
//        echo json_encode(array("message"=>"File successfully get"));


    }
    else{
        echo json_encode(array("message"=>"Error"));
    }
?>