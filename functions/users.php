<?php

require_once(__DIR__ . '/../lib/mysql.php');


function countUsers($filters)
{
    global $conn;

    $query = $conn->query("SELECT COUNT(*) AS count FROM users");
    $data = $query->fetch_assoc();
    return $data['count'];
}

function countActiveUsers()
{
    global $conn;

    $sql = <<<SQL
       SELECT COUNT(DISTINCT(user_id)) AS count FROM bookmarks b 
       WHERE DATE(last_read) = CURDATE() 
    SQL;
    $query = $conn->query($sql);
    $data = $query->fetch_assoc();
    return $data['count'];
}


function statActiveUsers()
{
    global $conn;

    $sql = <<< SQL
        SELECT 
            DATE(last_read) AS date,
            COUNT(DISTINCT user_id) AS user_count
        FROM bookmarks
        WHERE last_read >= CURDATE() - INTERVAL 6 DAY
            AND last_read < CURDATE() + INTERVAL 1 DAY
        GROUP BY DATE(last_read)
        ORDER BY date ASC;
    SQL;
    $query = $conn->query($sql);
    return $query->fetch_all(MYSQLI_ASSOC);
}
