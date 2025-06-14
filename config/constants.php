<?php

$baseUrl = 'http://localhost:8000/mabook';

$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'mabook';


function url($url)
{
    global $baseUrl;
    return $baseUrl . '/' . $url;
}
