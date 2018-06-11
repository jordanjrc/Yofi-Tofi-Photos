<?php
$errorMessage = '';
$emailErrorMessage = '';
$usernameErrorMessage = '';
$firstNameErrorMessage = '';
$lastNameErrorMessage = '';
$passwordErrorMessage = '';

if (!empty($_POST['email'])) {

  $postValues = (object) [
    'email' => $_POST['email'],
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'username' => $_POST['username'],
    'password' => $_POST['password']
  ];

  foreach ($postValues as $key => $value) {
    if ($key !== 'password') {
      $value = trim($value);
      $postValues->$key = strtolower($value);
    }
  }

  $checkForUser = $database->prepare("SELECT * FROM users WHERE lower(email) = :email OR lower(username) = :username");
  $checkForUser->bindValue(':email', $postValues->email);
  $checkForUser->bindValue(':username', $postValues->username);
  $checkForUser->execute();
  $user = $checkForUser->fetch();

  if (!empty($user->email) && $user->email === $postValues->email) {
    $emailErrorMessage = 'That email is in use. You may already have an account.';
    return;
  }

  if (!empty($user->username) && $user->username === $postValues->username) {
    $usernameErrorMessage = 'Sorry! Looks like that username is taken.';
    return;
  }

  if (empty($postValues->first_name)) {
    $firstNameErrorMessage = 'Please provide a first name';
    return;
  }

  if (empty($postValues->last_name)) {
    $lastNameErrorMessage = 'Please provide a last name';
    return;
  }

  if (!empty($postValues->password)) {
    $postValues->password = password_hash($postValues->password, PASSWORD_DEFAULT);
  } else {
    $passwordErrorMessage = 'Please provide a password';
    return;
  }

  $insertUser = $database->prepare("INSERT INTO users (email, first_name, last_name, username, password, signed_up_date) VALUES (:email, :first_name, :last_name, :username, :password, now()) RETURNING id");
  $insertUser->bindValue(':email', $postValues->email);
  $insertUser->bindValue(':first_name', $postValues->first_name);
  $insertUser->bindValue(':last_name', $postValues->last_name);
  $insertUser->bindValue(':username', $postValues->username);
  $insertUser->bindValue(':password', $postValues->password);
  $insertUser->execute();

  $userId = $insertUser->fetchColumn();
  $_SESSION['user_id'] = $userId;

  header('Location: /user/dashboard');
}
