<?php
$emailErrorMessage = '';
$sentEmail = false;

if (!empty($_POST['email'])) {
  $email = strtolower($_POST['email']);

  $getUser = $database->prepare("SELECT * FROM users WHERE lower(email) = :email");
  $getUser->bindValue(':email', $email);
  $getUser->execute();
  $user = $getUser->fetch();

  if (!empty($user)) {
    $token = bin2hex(random_bytes(16));

    $insertRequest = $database->prepare("INSERT INTO password_reset_requests (user_id, token) VALUES (:user_id, :token)");
    $insertRequest->bindValue(':user_id', $user->id);
    $insertRequest->bindValue(':token', $token);
    $insertRequest->execute();

    $name = $user->first_name;
    $resetLink = 'http://' . $_SERVER['HTTP_HOST'] . '/reset-password?token=' . $token;
    $subject = 'Password Reset Request';
    $htmlBody = 'Hi ' . $name . '! We received a password reset request from your Yofi Tofi account. Please use this link to reset you password: <a href="' . $resetLink . '">' . $resetLink . '<a/>';
    $textBody = strip_tags($htmlBody);

    sendEmail($email, $subject, $htmlBody, $textBody);

    header('Location: /forgot-password?success=1');
    exit;
  } else {
    $emailErrorMessage = 'No account found!';
  }
}

if (isset($_GET['success'])) {
  $sentEmail = true;
}
