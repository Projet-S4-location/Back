<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Credentials: true'); // Ajoutez cette ligne

require_once "cruds/crud_users.php";
require_once "db_connect.php";
require_once "utils.php";

session_start();

function login(){
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
                return error_message_json(401, "401 Unauthorized: Invalid username or password.");
            }

            // if found and good password
            if (password_verify($password, $user["password"]))
            {
                // should not happen but if the user was already connected
                if (is_logged_in())
                {
                    session_unset();
                }

                // update the restriction
                // set the session 
                $_SESSION["id_user"] = $user["id_user"];
                $_SESSION["mail"] = $user["mail"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["permission"] = $user["permission"];
                
                // echo 
                $user_data = make_data_of_user($_SESSION);

                return json_encode($user_data);
            }
            else
            {   
                return error_message_json(401, "401 Unauthorized: Invalid username or password.");

            }

        }
        else
        {
            return invalid_format_data_error_message();
        }
    }
    else
    {
        return no_data_error_message();
    }
    
}

function make_data_of_user($tab){
    $data = [
        "id_user" => $tab["id_user"],
        "mail" => $tab["mail"], 
        "username" => $tab["username"],
        "permission" => $tab["permission"],
    ];
    return $data;
}

print(login());