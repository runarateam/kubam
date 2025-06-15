<?php

require_once(__DIR__ . '/../lib/mysql.php');



// --------------------------------------------
// Category
// --------------------------------------------

function listCategories($filters, $pagination)
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
    $limit = $pagination['limit'] ?? 10;
    $page = $pagination['page'] ?? 1;
    if (empty($limit)) $limit = 10;
    if (empty($page)) $page = 1;
    $offset = ($page - 1) * $limit;


    // build query
    $sql = "SELECT * FROM categories $whereQuery ORDER BY id DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(implode("", $types) . 'ss', ...[...$params, $limit, $offset]);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function countCategories()
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
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM categories $whereQuery");
    if (!empty($where)) $stmt->bind_param(implode("", $types), ...$params);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    return $data['total'] ?? 0;
}

function getCategory($id)
{
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM categories WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function createCategory($name, $description)
{
    global $conn;

    $stmt = $conn->prepare('INSERT INTO categories (name, description) VALUES (?, ?)');
    $stmt->bind_param('ss', $name, $description);
    return $stmt->execute();
}

function editCategory($id, $name, $description)
{
    global $conn;

    $stmt = $conn->prepare('UPDATE categories SET name = ?, description = ? WHERE id = ?');
    $stmt->bind_param('ssi', $name, $description, $id);
    return $stmt->execute();
}

function deleteCategory($id)
{
    global $conn;

    $stmt = $conn->prepare('DELETE FROM categories WHERE id = ?');
    $stmt->bind_param('i', $id);
    return $stmt->execute();
}
