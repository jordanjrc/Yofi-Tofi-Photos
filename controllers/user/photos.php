<?php

$pageTitle = 'Your Photos';

if (isset($_SESSION['user_id'])) {
  $getPhotos = $database->prepare("SELECT * FROM photos WHERE user_id = :user_id AND deleted = 0 ORDER BY upload_date DESC");
  $getPhotos->bindValue(':user_id', $_SESSION['user_id']);
  $getPhotos->execute();

  $photos = $getPhotos->fetchAll();
}

if (isset($_POST['title']) && isset($_POST['photo-id'])) {
  $photoTitle = trim($_POST['title']);
  $photoTitle = strtolower($photoTitle);
  $photoTitle = htmlspecialchars($photoTitle);

  $photoId = $_POST['photo-id'];

  $updatePhotoTitle = $database->prepare("UPDATE photos SET title = :title WHERE id = :id");
  $updatePhotoTitle->bindValue('title', $photoTitle);
  $updatePhotoTitle->bindValue('id', $photoId);
  $updatePhotoTitle->execute();
}

if (isset($_POST['delete-photo']) && isset($_POST['photo-id'])) {
  $photoId = $_POST['photo-id'];

  $deletePhoto = $database->prepare("UPDATE photos SET deleted = 1 WHERE id = :id");
  $deletePhoto->bindValue('id', $photoId);
  $deletePhoto->execute();
}
