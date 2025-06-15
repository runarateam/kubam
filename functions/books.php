<?php

require_once(__DIR__ . '/../lib/mysql.php');

// --------------------------------------------
// Book
// --------------------------------------------

function listBooks($filters, $pagination)
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
    if (isset($filters['publisher_id'])) {
        $where[] = 'publisher_id = ?';
        $params[] = $filters['publisher_id'];
        $types[] .= 's';
    }
    if (isset($filters['author_id'])) {
        $where[] = 'author_id = ?';
        $params[] = $filters['author_id'];
        $types[] .= 's';
    }
    if (isset($filters['year'])) {
        $where[] = 'year = ?';
        $params[] = $filters['year'];
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
    $sql = "SELECT * FROM books $whereQuery ORDER BY created_at DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(implode("", $types) . 'ss', ...[...$params, $limit, $offset]);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // kumpulin foreign id, ambil data author, publisher dan category
    $authorIds = [];
    $publisherIds = [];
    $categoryIds = [];
    foreach ($data as $row) {
        if (!empty($row['author_id'])) $authorIds[] = $row['author_id'];
        if (!empty($row['publisher_id'])) $publisherIds[] = $row['publisher_id'];
        if (!empty($row['category_id'])) $categoryIds[] = $row['category_id'];
    }
    $query = $conn->query("SELECT * FROM authors WHERE id IN (" . implode(", ", $authorIds) . ")");
    $authors = $query->fetch_all(MYSQLI_ASSOC);
    $query = $conn->query("SELECT * FROM publishers WHERE id IN (" . implode(", ", $publisherIds) . ")");
    $publishers = $query->fetch_all(MYSQLI_ASSOC);
    $query = $conn->query("SELECT * FROM categories WHERE id IN (" . implode(", ", $categoryIds) . ")");
    $categories = $query->fetch_all(MYSQLI_ASSOC);


    // tempelin ke data buku
    foreach ($data as $index => $row) {
        foreach ($authors as $author) if ($row['author_id'] == $author['id']) $data[$index]['author']['name'] = $author['name'];
        foreach ($publishers as $publisher) if ($row['publisher_id'] == $publisher['id']) $data[$index]['publisher']['name'] = $publisher['name'];
        foreach ($categories as $category) if ($row['category_id'] == $category['id']) $data[$index]['category']['name'] = $category['name'];
    }
    return $data;
}

function countBooks()
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
    if (isset($filters['publisher_id'])) {
        $where[] = 'publisher_id = ?';
        $params[] = $filters['publisher_id'];
        $types[] .= 's';
    }
    if (isset($filters['author_id'])) {
        $where[] = 'author_id = ?';
        $params[] = $filters['author_id'];
        $types[] .= 's';
    }
    if (isset($filters['year'])) {
        $where[] = 'year = ?';
        $params[] = $filters['year'];
        $types[] .= 's';
    }
    if (!empty($where)) {
        $whereQuery = "WHERE " . implode(" AND ", $where);
    }

    // build query
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM books $whereQuery");
    if (!empty($where)) $stmt->bind_param(implode("", $types), ...$params);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    return $data['total'] ?? 0;
}

function getBook($id)
{
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM books WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function createBook($title, $exemplar, $authorId, $publisherId, $categoryId, $year, $file, $cover, $description)
{
    global $conn;

    // upload file buku 
    $filePath = '/docs/' . $title . '-' . date('d-m-Y H:i:s') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileTarget = __DIR__ . '/..' . $filePath;
    $fileStatus = move_uploaded_file($file['tmp_name'], $fileTarget);

    // upload file cover 
    $coverPath = '/images/cover/' . $title . '-' . date('d-m-Y H:i:s') . '.' . pathinfo($cover['name'], PATHINFO_EXTENSION);
    $coverTarget = __DIR__ . '/..' . $coverPath;
    $coverStatus = move_uploaded_file($cover['tmp_name'], $coverTarget);

    $stmt = $conn->prepare('INSERT INTO books (title, exemplars, author_id, publisher_id, category_id, year, file, cover, description, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())');
    $stmt->bind_param('sssssssss', $title, $exemplar, $authorId, $publisherId, $categoryId, $year, $filePath, $coverPath, $description);
    return $stmt->execute();
}

function editBook($id, $title, $exemplar, $authorId, $publisherId, $categoryId, $year, $file, $cover, $description)
{
    global $conn;

    // ambil data lama,
    $book = getBook($id);

    // cek apakah ada upload file baru
    $filePath = $book['file'];
    if ($file['name'] != '') {
        // hapus yang udah ada
        if (file_exists(__DIR__ . '/..' . $book['file'])) {
            unlink(__DIR__ . '/..' . $book['file']);
        }

        // upload file buku baru 
        $filePath = '/docs/' . $book['title'] . '-' . date('d-m-Y H:i:s') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileTarget = __DIR__ . '/..' . $filePath;
        $fileStatus = move_uploaded_file($file['tmp_name'], $fileTarget);
    }

    $coverPath = $book['cover'];
    if ($cover['name'] != '') {
        // hapus yang lama 
        if (file_exists(__DIR__ . '/..' . $book['cover'])) {
            unlink(__DIR__ . '/..' . $book['cover']);
        }

        // upload yang baru
        $coverPath = '/images/cover/' . $book['title'] . '-' . date('d-m-Y H:i:s') . '.' . pathinfo($cover['name'], PATHINFO_EXTENSION);
        $coverTarget = __DIR__ . '/..' . $coverPath;
        $coverStatus = move_uploaded_file($cover['tmp_name'], $coverTarget);
    }

    $stmt = $conn->prepare('UPDATE books SET title = ?, exemplars = ?, author_id = ?, publisher_id = ?, category_id = ?, year = ?, file = ?, cover = ?, description = ? WHERE id = ?');
    $stmt->bind_param('sssssssssi', $title, $exemplar, $authorId, $publisherId, $categoryId, $year, $filePath, $coverPath, $description, $id);
    return $stmt->execute();
}

function deleteBook($id)
{
    global $conn;

    $book = getBook($id);
    if (file_exists(__DIR__ . '/..' . $book['cover'])) {
        unlink(__DIR__ . '/..' . $book['cover']);
    }
    if (file_exists(__DIR__ . '/..' . $book['file'])) {
        unlink(__DIR__ . '/..' . $book['file']);
    }

    $stmt = $conn->prepare('DELETE FROM books WHERE id = ?');
    $stmt->bind_param('i', $id);
    return $stmt->execute();
}
