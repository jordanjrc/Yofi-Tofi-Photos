<?php

$pageTitle = 'Your Photos';

if (isset($_SESSION['user_id'])) {
  $getPhotos = $database->prepare("SELECT * FROM photos WHERE user_id = :user_id ORDER BY upload_date DESC");
  $getPhotos->bindValue(':user_id', $_SESSION['user_id']);
  $getPhotos->execute();

  $photos = $getPhotos->fetchAll();
}
