<?php

$errorMessage = '';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {

  $postValues = (object) [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'message' => $_POST['message']
  ];

  foreach ($postValues as $key => $value) {
    $value = trim($value);
    if ($key != 'message') {
      $value = strtolower($value);
    }
    $postValues->$key = htmlspecialchars($value);
  }

  if (empty($postValues->name)) {
    $errorMessage = 'Please provide your name.';
  }

  if (empty($postValues->email) || !filter_var($postValues->email, FILTER_VALIDATE_EMAIL)) {
    $errorMessage = 'Please provide a valid email address.';
  }

  if (empty($postValues->message)) {
    $errorMessage = 'Please fill out the message field.';
  }

  if (!$errorMessage) {
    $subject = 'Yofi Tofi Photos';
    $htmlBody = $postValues->message .  '<br><br> from: ' . $postValues->name . '<br> email: ' . $postValues->email;
    $textBody = strip_tags($htmlBody);

    sendEmail($configuration->email_username, $postValues->email, $subject, $htmlBody, $textBody);

    header('Location: /contact?success');
    exit;
  }
}