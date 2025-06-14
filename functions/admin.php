<?php

require_once(__DIR__ . '/../lib/mysql.php');

function listAuthors($filters, $pagination)
{
    global $conn;

    // build query berdasarkan filter
    $whereQuery = "";
    $where = [];
    $params = [];
    $types = [];
    if (isset($filters['search'])) {
        $where[] = 'name LIKE ?';
        $params[] = '%' . $filters['search'] . '%';
        $types[] .= 's';
    }
    if (!empty($where)) {
        $whereQuery = "WHERE " . implode(" AND ", $where);
    }

    // apply filter pagination
    $limit = $pagination['limit'];
    $page = $pagination['page'];
    if (empty($limit)) $limit = 10;
    if (empty($page)) $page = 1;
    $offset = ($page - 1) * $limit;


    // build query
    $sql = "SELECT * FROM authors $whereQuery ORDER BY created_at DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(implode("", $types) . 'ss', ...[...$params, $limit, $offset]);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function countAuthors()
{
    global $conn;

    // build query berdasarkan filter
    $whereQuery = "";
    $where = [];
    $params = [];
    $types = [];
    if (isset($filters['search'])) {
        $where[] = 'name LIKE ?';
        $params[] = '%' . $filters['search'] . '%';
        $types[] .= 's';
    }
    if (!empty($where)) {
        $whereQuery = "WHERE " . implode(" AND ", $where);
    }

    // build query
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM authors $whereQuery");
    if (!empty($where)) $stmt->bind_param(implode("", $types), ...$params);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    return $data['total'] ?? 0;
}

function getAuthor($id)
{
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM authors WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function createAuthor($name, $website, $description)
{
    global $conn;

    $stmt = $conn->prepare('INSERT INTO authors (name, website, description, created_at) VALUES (?, ?, ?, NOW())');
    $stmt->bind_param('sss', $name, $website, $description);
    return $stmt->execute();
}

function editAuthor($id, $name, $website, $description)
{
    global $conn;

    $stmt = $conn->prepare('UPDATE authors SET name = ?, website = ?, description = ? WHERE id = ?');
    $stmt->bind_param('sssi', $name, $website, $description, $id);
    return $stmt->execute();
}

function deleteAuthor($id)
{
    global $conn;

    $stmt = $conn->prepare('DELETE FROM authors WHERE id = ?');
    $stmt->bind_param('i', $id);
    return $stmt->execute();
}
