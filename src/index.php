<?php
namespace Cheatze\Library;
include_once "../vendor/autoload.php";

session_start();

if (!isset($_SESSION['books'])) {
    $_SESSION['authors'] = [];
    $_SESSION['id'] = 1;
    include_once 'TestData.php'; //adds authors to the session variable
}


$router = new Router();

$router->processRoute();
//session_destroy(); // empty session for testing
