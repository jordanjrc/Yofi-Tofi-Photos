<?php
session_start();
require('configuration.php');

$requestedPage = trim($_SERVER['REQUEST_URI'], '/');
$requestedPage = strtok($requestedPage, '?');

if (!$requestedPage) {
    $requestedPage = 'home';
}

$pageTitle = basename($requestedPage);
$pageTitle = str_replace("-", " ", $pageTitle);
$pageTitle = ucwords($pageTitle);

$view = 'views/' . $requestedPage . '.php';
$controller = 'controllers/' . $requestedPage . '.php';
$errorPage = 'views/error.php';

$referer = @$_SERVER['HTTP_REFERER'];
$previousLocation = parse_url($referer, PHP_URL_PATH);

if (preg_match('/^user/', $requestedPage)) {
  if (!isset($_SESSION['user_id'])) {
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
