<?php

$error = null;

if (isset($_GET['user_id'])) {
  $userId = $_GET['user_id'];
  $getUser = $database->prepare("SELECT username, first_name, last_name FROM users WHERE id = :user_id");
  $getUser->bindValue(':user_id', $userId);
  $getUser->execute();
  $user = $getUser->fetch();

  if (empty($user)) {
    $error = 1;
    return;
  }

  $userFullName = $user->first_name . ' ' . $user->last_name;

  $getPhotos = $database->prepare("SELECT * FROM photos WHERE user_id = :user_id ORDER BY upload_date DESC");
  $getPhotos->bindValue(':user_id', $userId);
  $getPhotos->execute();

  $photos = $getPhotos->fetchAll();

} else {
  $error = 1;
}