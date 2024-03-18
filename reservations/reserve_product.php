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

if (is_logged_in()) {
    if (update_post_var())
    {   
        if (isset($_POST["id_product"]) && isset($_POST["start_date"]) && isset($_POST["end_date"]))
        {
            $conn = db_connect();
            $res = create_reservation($conn, $_SESSION["id_user"], $_POST["id_product"], $_POST["start_date"], $_POST["end_date"]);
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