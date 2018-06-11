<?php
$tokenNotFound = false;

if (isset($_POST['token'])) {
  $token = $_POST['token'];

  $getResetRequest = $database->prepare("SELECT * FROM password_reset_requests WHERE token = :token AND date > NOW() - INTERVAL '7 days' AND resolved = false");
  $getResetRequest->bindValue(':token', $token);
  $getResetRequest->execute();
  $resetRequest = $getResetRequest->fetch();

  if(!empty($resetRequest)) {
    if (!empty($_POST['password'])) {
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $updatePassword = $database->prepare("UPDATE users SET password = :password WHERE id = :id");
      $updatePassword->bindValue(':password', $password);
      $updatePassword->bindValue(':id', $resetRequest->user_id);
      $updatePassword->execute();

      $setResolved = $database->prepare("UPDATE password_reset_requests SET resolved = true WHERE token = :token");
      $setResolved->bindValue(':token', $token);
      $setResolved->execute();

      $_SESSION['user_id'] = $resetRequest->user_id;

      header('Location: /user/dashboard');
    }
  } else {
    $tokenNotFound = true;
  }
}
