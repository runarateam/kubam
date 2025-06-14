<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$loggedUser = $_SESSION['logged_user'];
$isLoggedIn = isset($loggedUser);

$success = $_SESSION['success'] ?? null;
$error = $_SESSION['error'] ?? null;
$errors = $_SESSION['errors'] ?? null;
$old = $_SESSION['old'] ?? null;
unset($_SESSION['success'], $_SESSION['error'], $_SESSION['errors'], $_SESSION['old']);
