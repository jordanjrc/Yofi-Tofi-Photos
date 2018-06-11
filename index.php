<?php
session_start();
require('configuration.php');

$resquestedPage = trim($_SERVER['REQUEST_URI'], '/');
$resquestedPage = strtok($resquestedPage, '?');

if (!$resquestedPage) {
    $resquestedPage = 'home';
}

$pageTitle = basename($resquestedPage);
$pageTitle = str_replace("-", " ", $pageTitle);
$pageTitle = ucwords($pageTitle);

$view = 'views/' . $resquestedPage . '.php';
$controller = 'controllers/' . $resquestedPage . '.php';
$errorPage = 'views/error.php';

$referer = @$_SERVER['HTTP_REFERER'];
$previousLocation = basename($referer);

if ((strpos($resquestedPage, 'user/') !== false) || (strpos($referer, 'user/') !== false)) {
  if (!isset($_SESSION['login'])) {
    header('Location: /login');
  }
}

if (!file_exists($view) && !file_exists($controller)) {
  $pageTitle = 'Error 404';
  $view = $errorPage;
}

if (file_exists($controller)) {
  include($controller);
}

if (file_exists($view)) {
  include('includes/header.php');
  include($view);
  include('includes/footer.php');
}
