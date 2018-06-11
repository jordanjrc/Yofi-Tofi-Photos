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

  //check if email already exists
  $query = $database->prepare("SELECT * FROM users WHERE lower(email) = :email");
  $query->bindValue(':email', $postValues->email);
  $query->execute();

  $results = $query->fetch();

  if (!empty($results)) {
    $emailErrorMessage = 'That email is in use. You may already have an account.';
    return;
  }


  if (!empty($postValues->username)) {
    //check if username already exists
    $query = $database->prepare("SELECT * FROM users WHERE lower(username) = :username");
    $query->bindValue(':username', $postValues->username);
    $query->execute();

    $results = $query->fetch();

    if (!empty($results)) {
      $usernameErrorMessage = 'Sorry! Looks like that username is taken.';
      return;
    }
  } else {
    $postValues->username = null;
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

  $insertStatement = $database->prepare("INSERT INTO users (email, first_name, last_name, username, password, signed_up_date) VALUES (:email, :first_name, :last_name, :username, :password, now()) RETURNING id");
  $insertStatement->bindValue(':email', $postValues->email);
  $insertStatement->bindValue(':first_name', $postValues->first_name);
  $insertStatement->bindValue(':last_name', $postValues->last_name);
  $insertStatement->bindValue(':username', $postValues->username);
  $insertStatement->bindValue(':password', $postValues->password);
  $insertStatement->execute();

  $userId = $insertStatement->fetchColumn();
  $_SESSION['user_id'] = $userId;

  header('Location: /user/dashboard');
}
