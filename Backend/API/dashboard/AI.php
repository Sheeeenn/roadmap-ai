<?php
session_start();

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: https://guiriba.com/");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cookie");
header("Access-Control-Allow-Credentials: true");

// Include the database connection
require("codes/others/connection.php");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents("php://input"));

    // Ensure the required parameters are present
    if (isset($data->prompt) && isset($_SESSION["USER_ID"])) {
        $search = $data->prompt;
        $user_input = "answer this strictly in Json format !!!, make me a roadmap about $search give me exactly 10 main topic with 1 link each where they can learn it also 2 sub topics each... follow this sample format 



        \"python\": {

            \"roadmap\": [

            {

                \"topic\": \"Python Basics\",

                \"link\": \"https://docs.python.org/3/tutorial/\",

                \"subtopics\": [

                \"Installation and Setup\",

                \"Introduction to Python Syntax\"

                ]

            },";

        // Prepare the data to send to the API
        $data = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $user_input]
                    ]
                ]
            ]
        ];

        // Google API key
        $apiKey = 'AIzaSyDZpP7OUYsG1N4kMfU9HNAukxw5YU4gk-Q';
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;
        
        // Initialize cURL session
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        // Execute cURL request and get the response
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            echo json_encode(["status" => "error", "message" => "cURL AI Error: " . curl_error($curl)]);
        } else {
            // Process the response
            if ($response) {
                $data = json_decode($response, true);
                // Check if the response contains the expected data
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    $text = $data['candidates'][0]["content"]["parts"][0]['text'];
                    // Clean the JSON response
                    $cleaned_json = str_replace(["```json", "```"], "", $text);
                    $data2 = json_decode($cleaned_json, true);

                    // Get the first key and user ID
                    $firstKey = key($data2);
                    $userID = $_SESSION["USER_ID"];
                    $rand_id = random_int(10000000000, 99999999999);
                    $R_ID = $rand_id;
                    $iter = 1;

                    // Insert the roadmap data into the database
                    foreach ($data2[$firstKey]['roadmap'] as $key) {
                        $topic = $key['topic'];
                        $link = $key['link'];
                        $sub1 = $key['subtopics'][0];
                        $sub2 = $key['subtopics'][1];

                        // Prepare and execute the database insert statement
                        $stmt = $conn->prepare("INSERT INTO roadmap (RoadmapID, UserID, MainTopic, Topic, SubTopic1, SubTopic2, Link, Iteration) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                        if ($stmt) {
                            $stmt->bind_param("iisssssi", $R_ID, $userID, $firstKey, $topic, $sub1, $sub2, $link, $iter);
                            $stmt->execute();
                            $iter++;
                        } else {
                            echo json_encode(["status" => "error", "message" => "Database query failed"]);
                        }
                    }

                    // Return success message with roadmap details
                    echo json_encode(["status" => "success", "message" => "Na add na daw", "UserID" => $userID, "RoadID" => $R_ID]);
                    $_SESSION['last_search_id'] = $R_ID;
                } else {
                    echo json_encode(["status" => "error", "message" => "Invalid response format", "Answer" => $data]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Empty response from API"]);
            }
        }

        // Close the cURL session
        curl_close($curl);
    } else {
        echo json_encode(["status" => "error", "message" => "Missing prompt or user ID"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
