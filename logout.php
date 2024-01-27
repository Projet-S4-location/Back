
<?php
require_once "utils.php";

session_start();
function logout(){
    session_unset();
    return success_message_json(204, "204 No Content: Logged out successfully.");
}

print(logout());