<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: image/jpeg');

require_once "./../cruds/crud_products.php";
require_once "./../db_connect.php";
require_once "./../utils.php";
session_start();
$conn = db_connect();
print(select_image($conn, $_GET["id"])["image"]);
