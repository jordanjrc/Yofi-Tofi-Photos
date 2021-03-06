<!DOCTYPE HTML>
<html>
  <head>
    <title>Yofi Tofi | <?= $pageTitle ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <link rel="stylesheet" href="/styles/stylesheet.css">
    <link rel="icon" href="favicon.ico">
  </head>

  <body>
    <nav id="navbar">
      <h1><a href="/">Yofi Tofi</a></h1>
      <ul>
        <li>
          <a href="/home" id="<?= ($requestedPage === "home" ? "current-link" : " ") ?>">Home</a>
        </li>
        <li>
          <a href="/about" id="<?= ($requestedPage === "about" ? "current-link" : " ") ?>">About</a>
        </li>
        <li>
          <a href="/photos" id="<?= ($requestedPage === "photos" ? "current-link" : " ") ?>">Photos</a>
        </li>
        <li>
          <a href="/contact" id="<?= ($requestedPage === "contact" ? "current-link" : " ") ?>">Contact</a>
        </li>
        <? if (isset($_SESSION['user_id'])) { ?>
        <li>
          <a href="/user/dashboard" id="<?= ($requestedPage === "user/dashboard" ? "current-link" : " ") ?>">Dashboard</a>
        </li>
        <li>
          <a href="/logout" id="<?= ($requestedPage === "logout" ? "current-link" : " ") ?>">Logout</a>
        </li>
        <? } else { ?>
        <li>
          <a href="/login" id="<?= ($requestedPage === "login" ? "current-link" : " ") ?>">Login</a>
        </li>
        <li>
          <a href="/sign-up" id="<?= ($requestedPage === "sign-up" ? "current-link" : " ") ?>">Sign up</a>
        </li>
        <? } ?>
      </ul>
    </nav>