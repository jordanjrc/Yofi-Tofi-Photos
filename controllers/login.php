<?php
$errorMessage = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $email = $_POST['email'];
  $email = strtolower($email);
  $password = $_POST['password'];

  $getUser = $database->prepare("SELECT * FROM users WHERE lower(email) = :email");
  $getUser->bindValue(':email', $email);
  $getUser->execute();
  $user = $getUser->fetch();

  if (!empty($user) && password_verify($password, $user->password)) {
      $_SESSION['user_id'] = $user->id;
      header('Location: /user/dashboard');
  } else {
    $errorMessage = 'We were not able to log you into your account. Please make sure the information you entered is correct and try again.';
  }
}
