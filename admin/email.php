<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Include the database connection established in bookstatus.php
include('../include/dbconn.php');

function generateSuccessEmailBody($username, $bookingId) {
    $message = "<!DOCTYPE html>
    <html lang='en'>
    
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Booking Approval Notification</title>
    </head>
    
    <body style='font-family: Arial, sans-serif; margin: 0; padding: 0;'>
    
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
            <tr>
                <td align='center' bgcolor='#3498db' style='padding: 20px 0 10px 0; color: #ffffff; font-size: 24px; font-weight: bold;'>
                    Booking Approved
                </td>
            </tr>
            <tr>
                <td bgcolor='#ecf0f1' style='padding: 20px 30px 20px 30px;'>
                    <p style='font-size: 16px;'>Dear $username,</p>
                    <p style='font-size: 16px;'>Your booking with ID: <strong>$bookingId</strong> has been successfully approved.</p>
                    <p style='font-size: 16px;'>Thank you for choosing our service. If you have any questions or need further assistance, feel free to contact us.</p>
                    <br>
                    <p style='font-size: 16px;'>Best regards,<br>Pusat Sukan UiTM Shah Alam</p>
                </td>
            </tr>
            <tr>
                <td bgcolor='#3498db' style='padding: 10px 30px 10px 30px;'>
                    <p style='font-size: 14px; color: #ffffff; text-align: center;'>© 2023 Pusat Sukan UiTM Shah Alam. All Rights Reserved.</p>
                </td>
            </tr>
        </table>
    
    </body>
    
    </html>"
    ;

    return $message;
}

function generateDeclineEmailBody($username, $bookingId) {
    $message = "<!DOCTYPE html>
    <html lang='en'>
    
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Booking Declined Notification</title>
    </head>
    
    <body style='font-family: Arial, sans-serif; margin: 0; padding: 0;'>
    
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
            <tr>
                <td align='center' bgcolor='#e74c3c' style='padding: 20px 0 10px 0; color: #ffffff; font-size: 24px; font-weight: bold;'>
                    Booking Declined
                </td>
            </tr>
            <tr>
                <td bgcolor='#ecf0f1' style='padding: 20px 30px 20px 30px;'>
                    <p style='font-size: 16px;'>Dear $username,</p>
                    <p style='font-size: 16px;'>Unfortunately, your booking with ID: <strong>$bookingId</strong> has been declined.</p>
                    <p style='font-size: 16px;'>If you have any questions or need further clarification, please feel free to contact us.</p>
                    <br>
                    <p style='font-size: 16px;'>Best regards,<br>Pusat Sukan UiTM Shah Alam</p>
                </td>
            </tr>
            <tr>
                <td bgcolor='#e74c3c' style='padding: 10px 30px 10px 30px;'>
                    <p style='font-size: 14px; color: #ffffff; text-align: center;'>© 2023 Pusat Sukan UiTM Shah Alam. All Rights Reserved.</p>
                </td>
            </tr>
        </table>
    
    </body>
    
    </html>"
    ;

    return $message;
}

function sendEmail($email, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Email sending configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'jokibesut@gmail.com'; // Update with your email address
        $mail->Password = 'zhuz avbo xftq fscz'; // Update with your email password
        $mail->setFrom('jokibesut@gmail.com', 'Pusat Sukan UiTM Shah Alam'); // Update with your details
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email sending failed
    }
}

function sendSuccessfulBookingEmail($email, $username, $bookingId) {
    $subject = 'Booking Confirmed';
    $body = generateSuccessEmailBody($username, $bookingId);

    return sendEmail($email, $subject, $body);
}

function sendBookingDeclinedEmail($email, $username, $bookingId) {
    $subject = 'Booking Declined';
    $body = generateDeclineEmailBody($username, $bookingId);

    return sendEmail($email, $subject, $body);
}
?>
