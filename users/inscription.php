<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Credentials: true');

require_once "./../cruds/crud_users.php";
require_once "./../db_connect.php";
require_once "./../utils.php";

session_start();

function inscription() {
    if (is_admin()) {
        if (update_post_var())
        {   
            if (isset($_POST["username"]) && isset($_POST["password"]))
            {
                $conn = db_connect();
                $username = $_POST["username"];
                $password = $_POST["password"];

                // check if the user name is available
                if(count(select_all_user_with_parameter($conn, "username", $username)) != 0)
                {
                    return cant_be_used_data_error_message();
                }

                $password_hashed = password_hash($password, PASSWORD_DEFAULT);

                // Set the final variables
                $permission = 0;
                // register the user in the db
                $res = create_user($conn, $username, $password_hashed, $permission);
                if ($res)
                {
                    $res = success_message_json(201, "201 Created: New user successfully created");
                }
                else
                {
                    $res = error_message_json(500, "500 Internal Server Error: Could not create the user");
                }
                return $res;
            }
        }
    }
    else
    {
        return permission_denied_error_message();
    }
}
print(inscription());