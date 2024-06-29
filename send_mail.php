<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);

    // echo "Welcome to Revolink";

    echo isset($_POST);

    // In your PHP file that handles the requests
    header("Access-Control-Allow-Origin: *"); // Adjust port if necessary
    // header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    // header("Access-Control-Allow-Headers: Content-Type, Authorization");

    // if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    //     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) && $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'POST') {
    //         header("Access-Control-Allow-Origin: http://localhost:5173");
    //         header("Access-Control-Allow-Headers: Content-Type, Authorization");
    //         header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    //         exit(0);
    //     }
    // }


    if ($_SERVER["REQUEST_METHOD"] == "GET" || isset($_GET)) {
        $name = $_GET['name'];
        $email = $_GET['email'];
        $phone = $_GET['phone'];
        $message = $_GET['message'];

        try {
            //Server settings
            $mail->SMTPDebug = 2; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = ''; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = ''; // SMTP username
            $mail->Password = ''; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to
        
            //Recipients
            $mail->setFrom('revolinkmessages@revomail.com', 'RevoLink Inc.');
            $mail->addAddress('test.dev@test.com', 'Recipient Name'); // Add a recipient
            $mail->addReplyTo('info@example.com', 'Information');
        
            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Here is the subject from ' . $name;
            $mail->Body    = 'Email: <b>' . $email . '</b><br/>' . 'Name: <b>'. $name . '</b><br/>' . 'Message: <b>' . $message . '</b><br/>' . 'Phone: <b>' . $phone . '</b><br/>';
            $mail->AltBody = 'Email: ' . $email . '\n' . 'Name: ' . $name .'\n' . 'Message: '.  $message  . '\n';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    } else {
        echo "No POST data received.";
    }

?>