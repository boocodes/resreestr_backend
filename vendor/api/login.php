<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once "../config/database.php";
    include_once "../config/rosreestr_main.php";

    $datebase = new DataBase();
    $db = $datebase->getConnection();


    $main_init = new RosreestrMain();
    $main_init->getConnection($db);


    $stmt = $main_init->getUserByPasswordAndLogin("1234", "baz_laiter" );
    $num = $stmt->rowCount();

    if($num){
        $main_arr = array();
        $main_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $main_elem = array(
                "user_id" => $user_id,
                "lastname" => $lastname,
                "firstname" => $firstname,
                "mail" => $mail,
                "created" => $created,
                "updated" => $updated,
                "workspace_id" => $workspace_id,
                "password" => $password,
            );
            array_push($main_arr["records"], $main_elem);
        }

        http_response_code(200);
        echo json_encode($main_arr);
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "Пользователь не найден."), JSON_UNESCAPED_UNICODE);


    }
?>

