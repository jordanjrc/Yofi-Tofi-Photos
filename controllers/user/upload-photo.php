<?php
require_once('classes/imageManipulator.php');

$errorMessage = null;

if (isset($_POST['submit'])) {

  if (!empty($_FILES['photo-upload-file']) && $_FILES['photo-upload-file']['error'] !== 4) {

    $supportedFileTypes = [
      'image/jpeg',
      'image/jpg',
      'image/png',
      'image/gif'
    ];

    $imageType = mime_content_type($_FILES['photo-upload-file']['tmp_name']);

    if (!in_array($imageType, $supportedFileTypes)) {
      $errorMessage = 'Please upload a JPG, PNG, or GIF.';
    }

    if (empty($_POST['photo-upload-title'])) {
      $errorMessage = 'Please enter a title for your image.';
    }

    if (!$errorMessage) {
      $originalFilename = $_FILES['photo-upload-file']['name'];
      $uploadFile = bin2hex(random_bytes(16)) . '.' . pathinfo($_FILES['photo-upload-file']['name'], PATHINFO_EXTENSION);

      $originalLocation = 'public/images/original/' . $uploadFile;
      $resizedLocation = 'public/images/resized/' . $uploadFile;

      $photoTitle = trim($_POST['photo-upload-title']);
      $photoTitle = strtolower($photoTitle);
      $photoTitle = htmlspecialchars($photoTitle);

      $manipulator = new ImageManipulator($_FILES['photo-upload-file']['tmp_name']);
      $resized = $manipulator->resample(450, 260);
      $manipulator->save($resizedLocation);

      move_uploaded_file($_FILES['photo-upload-file']['tmp_name'], $originalLocation);

      $insertPhoto = $database->prepare("INSERT INTO photos (user_id, filename, original_filename, title) VALUES (:user_id, :filename, :original_filename, :title)");
      $insertPhoto->bindValue(':user_id', $_SESSION['user_id']);
      $insertPhoto->bindValue(':filename', $uploadFile);
      $insertPhoto->bindValue(':original_filename', $originalFilename);
      $insertPhoto->bindValue(':title', $photoTitle);
      $insertPhoto->execute();

      header('Location: /user/dashboard?photo-uploaded');
    }
  }
}