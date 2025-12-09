<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$studentName = $_POST["studentName"];
$studentId = $_POST["studentId"];
$batch = $_POST["batch"];
$department = $_POST["department"];
$section = $_POST["section"];
$semester = $_POST["semester"];
$year = $_POST["year"];
$recipientEmail = $_POST["recipientEmail"];

$gitRepoUrl = "https://github.com/Sabbir-Aahmed/SMTP";

$template = file_get_contents("template.html");

$body = str_replace(
    [
        "{{studentName}}", 
        "{{studentId}}", 
        "{{department}}", 
        "{{batch}}", 
        "{{section}}", 
        "{{semester}}", 
        "{{year}}", 
        "{{repoUrl}}"
    ],
    [
        $studentName, 
        $studentId, 
        $department, 
        $batch, 
        $section, 
        $semester, 
        $year, 
        $gitRepoUrl
    ],
    $template
);

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = '2222081019@uttarauniversity.edu.bd';
    $mail->Password = 'ibzi rjjq vuts dqbu';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('2222081019@uttarauniversity.edu.bd', 'Md Sabbir Ahmed');
    $mail->addAddress($recipientEmail);

    $mail->isHTML(true);
    $mail->Subject = "Student Information for $studentName";
    $mail->Body = $body;

    $mail->send();

    echo "<h2>Email Sent Successfully!</h2>";
    echo "<a href='index.html'>Go Back</a>";

} catch (Exception $e) {
    echo "Failed to send email. Error: " . $mail->ErrorInfo;
}
?>
