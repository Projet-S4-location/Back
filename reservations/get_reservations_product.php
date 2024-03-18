<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Credentials: true');
header('content-type:application/json');

require_once "./../cruds/crud_reservations.php";
require_once "./../db_connect.php";
require_once "./../utils.php";

session_start();

//if (is_logged_in()) {  
    if (isset($_GET["id"]))
    {
        $conn = db_connect();
        print(json_encode(select_reservations_product($conn, $_GET["id"])));
    }
//}
//else
//{
//    return permission_denied_error_message();
//}