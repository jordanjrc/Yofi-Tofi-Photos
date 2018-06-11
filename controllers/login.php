<?php
$emailErrorMessage = '';
$passwordErrorMessage = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $email = $_POST['email'];
  $email = strtolower($email);
  $password = $_POST['password'];

  $query = $database->prepare("SELECT * FROM users WHERE lower(email) = :email");
  $query->bindValue(':email', $email);
  $query->execute();

  $results = $query->fetch();

  if (!empty($results)) {
    if (password_verify($password, $results->password)) {
      $_SESSION['user_id'] = $results->id;
      header('Location: /user/dashboard');
    } else {
      $passwordErrorMessage = 'incorrect password';
    }
  } else {
    $emailErrorMessage = 'account not found.';
  }
}
