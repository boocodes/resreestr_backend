<?php
//    include_once "../headers/post/index.php";
    include_once "../../config/database.php";
    include_once "../../config/Contain.php";
    include_once "../../config/User.php";
    include_once "../../config/Environment.php";
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: multipart/form-data");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    echo json_encode($_FILES, true);



?>