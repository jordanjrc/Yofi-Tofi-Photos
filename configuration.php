<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$configuration = json_decode(@file_get_contents('configuration.json'));

if (empty($configuration)) {
  echo 'Oops! There seems to be a configuration error!';
  exit;
}

try {
  $database = new PDO($configuration->dsn, $configuration->database_username, $configuration->database_password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
  ]);
} catch (Throwable $error) {
  echo $error->getMessage();
}

function sendEmail($to, $from, $subject, $htmlBody, $textBody) {
  global $configuration;

  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->SMTPDebug = 0;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth = true;
  $mail->Username = $configuration->email_username;
  $mail->Password = $configuration->email_password;

  $mail->setFrom($configuration->email_username, 'Yofi Tofi');
  $mail->addAddress($to);
  $mail->addReplyTo($from);
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $htmlBody;
  $mail->AltBody = $textBody;

  $mail->send();
}
