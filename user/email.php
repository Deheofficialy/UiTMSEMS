<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendEmailToDependent($dependentEmail, $equipmentid, $dependentusername, $latestBookingId) {
    $mail = new PHPMailer(true);
    $html = "<html> <body>
        <h1>Approval from Dependent</h1>
        <p>Dear ".$dependentusername.",</p>
        <p>The booking id ".$latestBookingId." request is pending. Please reply Confirm Approval to approve the booking process.</p>
        <a href=\"http://192.168.8.100/UiTM-SEMS/user/approved.php?bookingid=".$latestBookingId."\"> Confirm Approval</a>
        <p>If you did not request this approval, please ignore this email.</p>
        <p>Thank you,</p>
        <p>Your Company Name</p>

</body> </html>";

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'jokibesut@gmail.com';
        $mail->Password = 'zhuz avbo xftq fscz';
        $mail->setFrom('jokibesut@gmail.com', 'Pusat Sukan UiTM Shah Alam');
        $mail->addAddress($dependentEmail);
        $mail->isHTML(true);
        $mail->Subject = $equipmentid;
        $mail->Body = $html;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email sending failed
    }
}
?>
