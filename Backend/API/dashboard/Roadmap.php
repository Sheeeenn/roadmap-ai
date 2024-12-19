<?php

session_start();

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: https://guiriba.com/");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cookie");
header("Access-Control-Allow-Credentials: true");
require("codes/others/connection.php");

if($_SERVER['REQUEST_METHOD'] === 'GET') {


    if(isset($_SESSION["Roadmap-id-now"])) {
        $rid = $_SESSION["Roadmap-id-now"];
        $uid = $_SESSION['USER_ID'];

        $stmt = $conn->prepare("SELECT * FROM roadmap WHERE RoadmapID = ?");
        $stmt->bind_param("i", $rid);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $steps [] = $row;
        }

        echo json_encode($steps);
    
        $stmt->close();
        $conn->close();

    } else {
        echo json_encode(["status"=>"error", "message"=>"No R ID"]);
    }

} else {
    echo json_encode(["status"=>"error", "message"=>"No Method"]);
}

?>