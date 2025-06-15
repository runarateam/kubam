<?php

require_once(__DIR__ . '/../lib/mysql.php');

function setBookmark($userId, $bookId, $lastPage)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO bookmarks (user_id, book_id, last_page_read, last_read) VALUE (?, ?, ?, NOW())");
    $stmt->bind_param("iii", $userId, $bookId, $lastPage);
    return $stmt->execute();
}
