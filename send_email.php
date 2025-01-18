<?php
require 'vendor/autoload.php'; // Make sure Composer's autoloader is included

use Mpdf\Mpdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $htmlContent = $_POST['htmlContent'];
    $email = $_GET['email'];
    $name = $_GET['name'];
    // Generate PDF from HTML
    try {
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($htmlContent);
        $pdfContent = $mpdf->Output('', 'S'); // Output PDF as a string
    } catch (\Mpdf\MpdfException $e) {
        echo 'PDF generation error: ' . $e->getMessage();
        exit();
    }

    // Send email with PDF attachment using PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use Gmail's SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'surendranka2001@gmail.com'; // Your Gmail address
        $mail->Password = 'kmvlmgnkhrvgpqeb'; // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('surendranka2001@gmail.com', 'seamless journeys');
        $mail->addAddress($email, $name); // Add a recipient

        // Attachments
        $mail->addStringAttachment($pdfContent, 'document.pdf');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'invoice Details';
        $mail->Body    = 'seamless journeys';
        // Ensure email content is not flagged as spam
        $mail->AltBody = strip_tags($mail->Body); // Add plain text alternative

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>