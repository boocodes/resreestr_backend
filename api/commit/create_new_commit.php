<?php
    include_once "../headers/post/index.php";
    include_once "../../config/Contain.php";
    include_once  "../../config/User.php";
    include_once "../../config/database.php";
    include_once "../../config/Contain_branch.php";

    $database = new DataBase();
    $dbConnection = $database->setConnection();

    $contain_branch = new Contain_branch();
    $contain_branch->setConnection($dbConnection);








?>