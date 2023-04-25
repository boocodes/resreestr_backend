<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once "../../config/database.php";
    include_once "../../config/Contain.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();


    $contain = new Contain();
    $contain->setConnection($dbConnection);

    $data = json_decode(file_get_contents('php://input'), true);

    $contain->setContain_title($data["contain_title"]);
    $contain->setContain_description($data["contain_description"]);
    $contain->setContain_private($data["contain_private"]);
    $contain->setUser_id($data["user_id"]);

//    echo json_encode(array("message"=>$data));
    $contain->createContain();

?>