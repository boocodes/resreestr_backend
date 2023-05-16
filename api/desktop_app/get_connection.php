<?php
    include_once "../headers/post/index.php";
    include_once "../../config/Desktop_app.php";

    // check server alive`s

    $desktop = new Desktop_app();
    if($desktop->get_connection()){
        http_response_code(200);
        echo json_encode("Сервер в рабочем состоянии", true);
    }
    else{
        http_response_code(400);
        echo json_encode("Сервер недоступен", true);
    }
    return 0;


?>