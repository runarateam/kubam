<?php

require_once(__DIR__ . '/../lib/mysql.php');

function register($name, $email, $username, $password)
{
    global $conn;

    $stmt = $conn->prepare('INSERT INTO users (name, email, username, password, created_at, role) VALUES (?, ?, ?, ?, NOW(), "USER")');
    $stmt->bind_param('ssss', $name, $email, $username, password_hash($password, PASSWORD_BCRYPT));
    $stmt->execute();
    $stmt->close();
    return true;
}


function login($email, $username, $password)
{
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE (username = ? OR email = ?) LIMIT 1');
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_array();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}

function logout()
{
    unset($_SESSION['logged_user']);
}
