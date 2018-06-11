<?php
$query = $database->prepare("SELECT first_name, last_name, username FROM users WHERE id = :id");
$query->bindValue(':id', $_SESSION['user_id']);
$query->execute();

$results = $query->fetch();
