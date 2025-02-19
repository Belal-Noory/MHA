<?php
require_once('phpmailer/autoload.php');
class helper
{
    public static function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function sendMail($toMail, $subject, $mailBody)
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP 
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->Host = 'smtp.gmail.com';
        $mail->Port =     587; // or 587
        $mail->IsHTML(true);
        $mail->Username = 'belalnoory2@gmail.com';
        $mail->Password = '143kakaw';
        $mail->SetFrom('belalnoory2@gmail.com', 'ALS');
        $mail->Subject = 'ALS Account password';
        $mail->Body = $mailBody;
        $mail->AddAddress($toMail);
        if (!$mail->Send()) {
            return 'MailerError';
        } else {
            return 'sent';
        }
    }

    public static function is_localhost()
    {
        if ($_SERVER["SERVER_NAME"] == "localhost") {
            return "local";
        } else {
            return "online";
        }
    }

    public static function changeTimestape($timestamp)
    {
        $when = '';
        $duration = time() - $timestamp;
        if ($duration < 60) {
            if ($duration < 0) {
                $when = date('d/m/Y', $timestamp);
            } else {
                $when = $duration . ' s';
            }
        } else if ($duration < 3600) {
            $when = round($duration / 60, 0) . ' m';
        } else if ($duration < 86400) {
            $when = round($duration / 3600, 0) . ' h';
        } else if ($duration < 2073600) {
            $when = round($duration / 86400, 0) . ' d';
        } else {
            $when = date('d/m/Y', $timestamp);
        }

        return $when;
    }
}
