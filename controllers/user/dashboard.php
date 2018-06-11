<?php
$getUser = $database->prepare("SELECT first_name, last_name, username FROM users WHERE id = :id");
$getUser->bindValue(':id', $_SESSION['user_id']);
$getUser->execute();

$user = $getUser->fetch();
