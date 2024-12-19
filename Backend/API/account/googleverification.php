<?php
session_start();

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: https://guiriba.com/");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cookie");
header("Access-Control-Allow-Credentials: true");
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->email)) {
        
        $email = $data->email;

        //Load Composer's autoloader
        require 'vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'ue.roadmap.ai@gmail.com';                     //SMTP username
            $mail->Password   = 'ayyn ezes xgfc zqty';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('ue.roadmap.ai@gmail.com', 'RoadmapAI');
            $mail->addAddress($email, 'Roadmap User');     //Add a recipient
            //$mail->addReplyTo('guiribajustin2004@gmail.com', 'RoadmapAI');

            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            $randomNumber = random_int(100000, 999999);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'RoadMap AI Email Verification';
            $mail->Body    = "Your OTP Password is <b>$randomNumber</b>";

            $mail->send();

            

            echo json_encode(["status" => "success", "message" => "Posted", "VCode" => $randomNumber]);

        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid Email"]);
    }

} else {
    echo json_encode(["status" => "error", "message" => "NOT POST"]);
}
?>