    <?php
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        include_once "../../config/database.php";
        include_once "../../config/Contain.php";
        include_once "../../config/User.php";

        $database = new DataBase();
        $dbConnection = $database->setConnection();


        $contain = new Contain();
        $contain->setConnection($dbConnection);

        $data = json_decode(file_get_contents('php://input'), true);

    // put user id in contain field
    $contain->set_user_id($data["user_id"]);

    // check if user have permission to get contain
    $user = new User();
    $user->setConnection($dbConnection);
    $user->set_user_id($data["user_id"]);
    $user->set_password($data["user_password"]);


    if($user->get_user_by_id_and_password()){
        $result = $contain->get_contains_by_user_id();
        if($result){
            http_response_code(200);
            echo json_encode(array("message"=>$result));
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=>"Error, containers not found"));
            return false;
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Authorization error"));
        return false;
    }





?>