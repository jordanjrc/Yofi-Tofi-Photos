<?php
$errorMessage = '';

if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];

  $getUserInfo = $database->prepare("SELECT * FROM users WHERE id = :id");
  $getUserInfo->bindValue('id', $userId);
  $getUserInfo->execute();
  $userInfo = $getUserInfo->fetch();

  if (isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['username']) && isset($_POST['email'])) {
    $postValues = (object) [
      'first_name' => $_POST['first-name'],
      'last_name' => $_POST['last-name'],
      'username' => $_POST['username'],
      'email' => $_POST['email']
    ];

    foreach ($postValues as $key => $value) {
      $value = trim($value);
      $value = strtolower($value);
      $postValues->$key = htmlspecialchars($value);
    }

    $checkForUser = $database->prepare("SELECT * FROM users WHERE lower(email) = :email OR lower(username) = :username");
    $checkForUser->bindValue(':email', $postValues->email);
    $checkForUser->bindValue(':username', $postValues->username);
    $checkForUser->execute();
    $user = $checkForUser->fetch();

    if (empty($postValues->first_name) || empty($postValues->last_name) || empty($postValues->email)) {
      $errorMessage = 'blank-field';
    }

    if ($user->email === $postValues->email && $userId !== $user->id) {
      $errorMessage = 'email-taken';
    }

    if (!filter_var($postValues->email, FILTER_VALIDATE_EMAIL)) {
      $errorMessage = 'email-invalid';
    }

    if (!empty($user->username) && $user->username === $postValues->username && $userId !== $user->id) {
      $errorMessage = 'username-taken';
    }

    if (!$errorMessage) {
      $updateUser = $database->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, username = :username, email = :email WHERE id = :id");
      $updateUser->bindValue('first_name', $postValues->first_name);
      $updateUser->bindValue('last_name', $postValues->last_name);
      $updateUser->bindValue('username', $postValues->username);
      $updateUser->bindValue('email', $postValues->email);
      $updateUser->bindValue('id', $userId);
      $updateUser->execute();
    }

    echo $errorMessage;
    exit;
  }

  if (isset($_POST['old-password']) && isset($_POST['new-password'])) {

    $oldPassword = $_POST['old-password'];

    if (password_verify($oldPassword, $userInfo->password)) {

      if (empty($_POST['new-password'])) {
        $errorMessage = 'blank-field';
      }

      if (!$errorMessage) {
        $newPassword = password_hash($_POST['new-password'], PASSWORD_DEFAULT);

        $updatePassword = $database->prepare("UPDATE users SET password = :password WHERE id = :id");
        $updatePassword->bindValue('password', $newPassword);
        $updatePassword->bindValue('id', $userId);
        $updatePassword->execute();
      }
    } else {
      $errorMessage = 'no-match';
    }

    echo $errorMessage;
    exit;
  }
}

