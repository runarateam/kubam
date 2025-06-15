<?php

include(__DIR__ . '/../config/constants.php');
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) die('Failed connection: ' . $conn->connect_error);
