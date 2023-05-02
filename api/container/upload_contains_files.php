<?php
    include_once "../headers/post/index.php";
    include_once "../../config/database.php";
    include_once "../../config/Contain.php";
    include_once "../../config/User.php";
    include_once "../../config/Environment.php";

    
    echo json_encode($_FILES, true);
?>