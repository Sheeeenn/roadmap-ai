<?php

$user_link = parse_url($_SERVER['REQUEST_URI'])["path"];
$user_link = preg_replace('/^\/API/', '', $user_link);

switch($user_link){

    case "/":
        break;
    case "/register":
        require("API/account/register.php");
        break;
    case "/login":
        require("API/account/login.php");
        break;
    case "/user":
        require("API/dashboard/user.php");
        break;
    case "/AI":
        require("API/dashboard/AI.php");
        break;
    case "/Fuckyou":
        require("API/dashboard/AIDashboard.php");
        break;
    case "/Fuckyou2":
        require("API/dashboard/dashboardpick.php");
        break;
    case "/Fuckyou3":
        require("API/dashboard/Roadmap.php");
        break;
    case "/user":
        require("API/dashboard/user.php");
        break;
    case "/verification":
        require("API/account/googleverification.php");
        break;
    default:
        http_response_code(404);
        break;
        
}

?>