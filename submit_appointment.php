<div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en', 
    includedLanguages: 'en,fr,es,de,it,pt,zh-CN,ar,ru,ja,hi,bn,ko,tr,vi,pl,nl,th,sw,yo', 
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
  }, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// 1. Database Connection Details
$servername = "localhost";
$username = "root";
$password = "25J2007ayaounde";
$dbname = "housedesign_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Capture Form Data from index.html
$name = $_POST['clientName'];
$email = $_POST['clientEmail'];
$service = $_POST['serviceType'];
$description = $_POST['requestDescription'];

// 3. Insert into MySQL
$sql = "INSERT INTO appointments (client_name, client_email, service_type, description)
        VALUES ('$name', '$email', '$service', '$description')";

if ($conn->query($sql) === TRUE) {
    
    // 4. ADMIN NOTIFICATION LOGIC (Using PHPMailer)
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'erictchouela@gmail.com'; 
        $mail->Password   = 'bcni owfq xwrl tsqp';    
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('erictchouela@gmail.com', 'HOUSEDESIGN Notifications');
        $mail->addAddress('erictchouela@gmail.com'); 

        // Content
       $mail->isHTML(true);
       $mail->Subject = "NEW PROJECT INQUIRY: " . $service;
       $mail->Body    = "
       <div style='font-family: Arial, sans-serif; border: 1px solid #ddd; padding: 20px; max-width: 600px;'>
        <h2 style='color: #001f3f;'>HouseDesign Engineering</h2>
        <p style='background: #eee; padding: 10px;'><strong>New Appointment Request</strong></p>
        <p><strong>Client Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Service Requested:</strong> <span style='color: #d9534f;'>$service</span></p>
        <p><strong>Project Scope:</strong><br>$description</p>
        <hr>
        <p style='font-size: 0.8rem; color: #666;'>This request has been automatically logged in your XAMPP database.</p>
      </div>";
        $mail->send();
    } catch (Exception $e) {
        // Log error if mail fails
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }

    // Email Headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: webmaster@housedesign.com";

    if ($mail->send()) {
    // Redirect back to index with a success flag
    header("Location: index.html?mail=sent");
  } else {
    echo "Error: Mail could not be sent.";
  }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}   
$conn->close();
?>