<?php
$getPhotos = $database->prepare("SELECT photos.*, users.first_name, users.last_name, users.username FROM photos JOIN users on photos.user_id = users.id ORDER BY upload_date DESC");
$getPhotos->execute();

$photos = $getPhotos->fetchAll();

