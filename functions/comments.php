<?php

require_once(__DIR__ . '/../lib/mysql.php');


function listComments($bookId)
{
    global $conn;

    $sql = <<<SQL
    SELECT 
        c.*,
        u.name AS user_name
    FROM comments c 
    INNER JOIN users u ON u.id = c.user_id
    WHERE book_id = $bookId
    ORDER BY c.created_at DESC
    SQL;
    $query = $conn->query($sql);
    return $query->fetch_all(MYSQLI_ASSOC);
}

function createComment($userId, $bookId, $comment)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO comments (comment, book_id, user_id, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sii", $comment, $bookId, $userId);
    return $stmt->execute();
}

function deleteComment($userId, $commentId)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
    $stmt->bind_param('ii', $commentId, $userId);
    return $stmt->execute();
}
