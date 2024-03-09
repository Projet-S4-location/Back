<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Credentials: true');

require_once "./../cruds/crud_users.php";
require_once "./../db_connect.php";
require_once "./../utils.php";

session_start();
$conn = db_connect();

if (is_admin()){
    print(json_encode(select_all_user($conn)));
}