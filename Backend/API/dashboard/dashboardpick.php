<?php

session_start();

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: https://guiriba.com/");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cookie");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"));


    if(isset($data->RoadmapID)) {
        $_SESSION["Roadmap-id-now"] = $data->RoadmapID;
        echo json_encode(['status'=>'success', 'id'=>$_SESSION["Roadmap-id-now"]]);
    } else {
        echo json_encode(['status'=>'error', 'message'=>'Roadmap ID']);
    }

} else {
    echo json_encode(['status'=>'error', 'message'=>'No Request']);
}

?>