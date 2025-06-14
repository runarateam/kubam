<?php

$baseUrl = 'http://localhost:8000/mabook';

$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'mabook';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$loggedUser = $_SESSION['logged_user'];
$isLoggedIn = isset($loggedUser);

function url($url)
{
    global $baseUrl;
    return $baseUrl . '/' . $url;
}


$success = $_SESSION['success'];
$error = $_SESSION['error'];
$errors = $_SESSION['errors'];
$old = $_SESSION['old'];
unset($_SESSION['success'], $_SESSION['error'], $_SESSION['errors'], $_SESSION['old']);
