<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Credentials: true');
header('content-type:application/json');

require_once "./../cruds/crud_tags.php";
require_once "./../db_connect.php";
require_once "./../utils.php";
session_start();
if (is_logged_in()){
    $conn = db_connect();
    if (isset($_GET["id"]))
    {
        print(json_encode(get_tags_by_product($conn, $_GET["id"])));
    }else{
        echo "Pas d'id";
    }
}