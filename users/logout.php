
<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Credentials: true'); // Ajoutez cette ligne
require_once "./../utils.php";

session_start();
function logout(){
    session_unset();
    return success_message_json(204, "204 No Content: Logged out successfully.");
}

print(logout());