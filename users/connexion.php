<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Credentials: true');

require_once "./../cruds/crud_users.php";
require_once "./../db_connect.php";
require_once "./../utils.php";

ini_set('session.gc_maxlifetime', 86400);

session_start();

if (update_post_var())
{
    // get the data
    if (isset($_POST["username"]) && isset($_POST["password"]))
    {


        // sanitize the data
        $username = $_POST["username"];
        $password = $_POST["password"];
        $conn = db_connect();
        // search for username in users
        $user = select_user_by_username($conn, $username);
        // if not found
        if(is_null($user))
        {
            // We know that it's the username that is wrong
            // But we say also wrong password to not give any
            // information of who has an account on our website
            echo error_message_json(401, "401 Unauthorized: Invalid username or password.");
        }

        // if found and good password
        if (password_verify($password, $user["password"]))
        {
            if (is_logged_in())
            {
                session_unset();
            }
            // should not happen but if the user was already connected
            // update the restriction
            // set the session 
            $_SESSION["id_user"] = $user["id_user"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["permission"] = $user["permission"];
                
            // echo 
            $user_data = make_data_of_user($_SESSION);

            echo json_encode($user_data);
        }
        else
        {   
            echo error_message_json(401, "401 Unauthorized: Invalid username or password.");

        }

    }
    else
    {
        echo invalid_format_data_error_message();
    }
}
else
{
    echo no_data_error_message();
}
    

function make_data_of_user($tab){
    $data = [
        "id_user" => $tab["id_user"],
        "username" => $tab["username"],
        "permission" => $tab["permission"],
    ];
    return $data;
}

