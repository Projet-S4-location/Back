<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('content-type:application/json');
header('Access-Control-Allow-Credentials: true');

session_start();
echo json_encode($_SESSION);
