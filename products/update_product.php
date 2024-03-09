<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Credentials: true');

require_once "./../cruds/crud_products.php";
require_once "./../db_connect.php";
require_once "./../utils.php";

session_start();
$conn = db_connect();
if (is_admin()) {
    if (update_post_var())
    {   
        if (isset($_POST["nom"]) && isset($_POST["type"]) && isset($_POST["description"]) && isset($_POST["prix"]))
        {
            $conn = db_connect();
            $res = update_product($conn, $_POST["nom"], $_POST["type"], $_POST["description"], $_POST["prix"], $_FILES, $_POST["id"]);
            if ($res) {
                $res = success_message_json(201, "201 Created: New product successfully created");
            } else {
                $res = error_message_json(500, "500 Internal Server Error: Could not create the product");
            }

        }
    }
}
else
{
    return permission_denied_error_message();
}