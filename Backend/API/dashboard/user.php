<?php
session_start();

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: https://guiriba.com/");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cookie");
header("Access-Control-Allow-Credentials: true");
require("codes/others/connection.php");

if($_SERVER['REQUEST_METHOD'] === 'GET') {

    if(isset($_SESSION['USER_ID'])) {

        $uid = $_SESSION['USER_ID'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE UserID = ?");
        $stmt->bind_param("i", $uid);
        $stmt->execute();

        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'Username' => $user['Username'], 'UserID' => $user['UserID']]);
        }

    } else {
        echo json_encode(['status' => 'loggedout', 'message' => 'Please Login First!']);
    }


} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Method']);
}
?>