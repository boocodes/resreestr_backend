<?php
    include_once "../headers/post/index.php";
    include_once "../../config/database.php";
    include_once "../../config/User.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();

    $user = new User();
    $user->setConnection($dbConnection);
    $res =  json_decode(var_dump(getallheaders()));
    echo json_encode($_FILES);


    function get_login_from_authorization_header($string){
        $string_size = strlen($string);
        $white_space_pos = strripos($string, " ");
        $result = mb_substr($string, 0, $white_space_pos);
        return $result;
    }
    function get_password_from_authorization_header($string){

        $string_size = strlen($string);
        $white_space_pos = strripos($string, " ");
        $result = mb_substr($string, $white_space_pos + 1, $string_size - $white_space_pos);
        return $result;
    }


    $authorization_header = getallheaders()["Authorization"];
    echo json_encode(get_password_from_authorization_header($authorization_header));

    $password_from_authorization_header = get_password_from_authorization_header($authorization_header);
    $login_from_authorization_header = get_login_from_authorization_header($authorization_header);

    if($password_from_authorization_header && $login_from_authorization_header){
        if(move_uploaded_file($_FILES["filename"]["tmp_name"], "../../images/".$_FILES["filename"]["name"])){

            echo json_encode(array("message"=>"File successfully get"));
            if($user->update_avatar_src($password_from_authorization_header, $login_from_authorization_header, "https://rosreestr/images/".$_FILES["filename"]["name"])){
                http_response_code(200);
                echo json_encode(array("message"=>"Successfully uploaded file"));
            }
            else{
                http_response_code(400);
                echo json_encode(array("message"=>"Error upload file"));
            }
        }
        else{
            echo json_encode(array("message"=>"Error file upload"));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Error autorization headers"));
    }


?>