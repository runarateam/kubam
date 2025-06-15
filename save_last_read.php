<?php
require_once __DIR__ . '/config/constants.php';
require_once __DIR__ . '/functions/bookmarks.php';

$userId = $_POST['user_id'];
$bookId = $_POST['book_id'];

// cek bookmark ada atau engga
$bookmark = getBookmarkByBookId($userId, $bookId);
if (empty($bookmark)) exit;

// set last page
$lastPage = $_POST['last_read_page'];
updateBookmark($userId, $bookId, $lastPage);
