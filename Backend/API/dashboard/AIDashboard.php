<?php
session_start();

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: https://guiriba.com/");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cookie");
header("Access-Control-Allow-Credentials: true");

require("codes/others/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    if(isset($_SESSION['USER_ID'])) {

        $uid = $_SESSION['USER_ID'];

        $stmt = $conn->prepare("SELECT DISTINCT RoadmapID, MainTopic FROM roadmap WHERE UserID = ?");
        $stmt->bind_param("i", $uid);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $test[]=$row;
        }
        if(isset($test)) {
            echo json_encode($test);
        }
        $stmt->close();
        $conn->close();
        

    } else {
        echo json_encode(["RoadmapID" => "Not Found."]);
    }
}

?>