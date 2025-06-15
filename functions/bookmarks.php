<?php

require_once(__DIR__ . '/../lib/mysql.php');

function setBookmark($userId, $bookId, $lastPage)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO bookmarks (user_id, book_id, last_page_read, last_read) VALUE (?, ?, ?, NOW())");
    $stmt->bind_param("iii", $userId, $bookId, $lastPage);
    return $stmt->execute();
}

function deleteBookmark($id)
{
    global $conn;

    return $conn->query("DELETE FROM  bookmarks WHERE id = $id");
}

function listBookmarks($userId)
{
    global $conn;

    $sql = <<<SQL
        SELECT
            bm.*,
            b.*,
            a.name AS author_name,
            c.name AS category_name,
            p.name AS publisher_name
        FROM bookmarks bm
        INNER JOIN books b ON b.id = bm.book_id
        INNER JOIN authors a ON a.id = b.author_id
        INNER JOIN categories c ON c.id = b.category_id
        INNER JOIN publishers p ON p.id = b.publisher_id
        WHERE bm.user_id = $userId 
    SQL;
    $query = $conn->query($sql);
    return $query->fetch_all(MYSQLI_ASSOC);
}


function getBookmarkByBookId($userId, $bookId)
{
    global $conn;

    $query = $conn->query("SELECT * FROM bookmarks WHERE user_id = $userId AND book_id = $bookId");
    return $query->fetch_assoc();
}
