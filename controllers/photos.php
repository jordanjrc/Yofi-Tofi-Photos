<?php

$pageLimit = 16;

if (isset($_GET['page'])) {
  $page = $_GET['page'];
  $offset = ($page - 1) * $pageLimit;
} else {
  $page = 1;
  $offset = 0;
}

$getPhotos = $database->prepare("SELECT photos.*, users.first_name, users.last_name, users.username FROM photos JOIN users on photos.user_id = users.id WHERE photos.deleted = 0 ORDER BY upload_date DESC LIMIT $pageLimit OFFSET $offset");
$getPhotos->execute();
$photos = $getPhotos->fetchAll();

$getPhotoCount = $database->prepare("SELECT COUNT(*) FROM photos WHERE deleted = 0");
$getPhotoCount->execute();
$rowCount = $getPhotoCount->fetchColumn();

if (isset($_GET['users'])) {
  $getUsers = $database->prepare("SELECT distinct on (users.id) users.id, users.first_name, users.last_name, users.username, photos.filename, photos.title FROM users LEFT JOIN photos on photos.user_id = users.id WHERE (photos.deleted = 0 OR photos.deleted IS NULL) ORDER BY users.id DESC, upload_date DESC LIMIT $pageLimit OFFSET $offset");
  $getUsers->execute();
  $users = $getUsers->fetchAll();

  $getUserCount = $database->prepare("SELECT COUNT(*) FROM users");
  $getUserCount->execute();
  $rowCount = $getUserCount->fetchColumn();
}

if (isset($_GET['user_id'])) {
  $userId = $_GET['user_id'];

  $getUserInfo = $database->prepare("SELECT username, first_name, last_name FROM users WHERE id = :user_id");
  $getUserInfo->bindValue(':user_id', $userId);
  $getUserInfo->execute();
  $userInfo = $getUserInfo->fetch();

  $getPhotos = $database->prepare("SELECT photos.*, users.first_name, users.last_name, users.username FROM photos JOIN users on photos.user_id = users.id WHERE photos.user_id = :user_id AND photos.deleted = 0 ORDER BY upload_date DESC LIMIT $pageLimit OFFSET $offset");
  $getPhotos->bindValue(':user_id', $userId);
  $getPhotos->execute();
  $photos = $getPhotos->fetchAll();

  $getPhotoCount = $database->prepare("SELECT COUNT(*) FROM photos WHERE deleted = 0 AND user_id = :user_id");
  $getPhotoCount->bindValue(':user_id', $userId);
  $getPhotoCount->execute();
  $rowCount = $getPhotoCount->fetchColumn();
}

$lastPage = $rowCount / $pageLimit;
