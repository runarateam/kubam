<?php require_once(__DIR__ . '/../config/constants.php') ?>
<?php require_once(__DIR__ . '/../functions/helper.php') ?>
<?php require_once(__DIR__ . '/../functions/session.php') ?>
<?php require_once(__DIR__ . '/../functions/books.php') ?>
<?php require_once(__DIR__ . '/../functions/authors.php') ?>
<?php require_once(__DIR__ . '/../functions/categories.php') ?>
<?php require_once(__DIR__ . '/../functions/publishers.php') ?>

<?php

$authors = listAuthors([], ['limit' => 999]);
$publishers = listPublishers([], ['limit' => 999]);
$categories = listCategories([], ['limit' => 999]);
?>

<?php
$id = $_GET['id'];
if (empty($id)) die('Halaman tidak valid, <a href="books.php"><< Kembali</a>');

$book = getBook($id);

// handler buat submit 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // ambil inputannya
    $id = $_POST['id'];
    $title = $_POST['title'];
    $exemplars = $_POST['exemplars'];
    $authorId = $_POST['author_id'];
    $publisherId = $_POST['publisher_id'];
    $categoryId = $_POST['category_id'];
    $year = $_POST['year'];
    $file = $_FILES['file'];
    $cover = $_FILES['cover'];
    $description = $_POST['description'];
    $_SESSION['old'] = $_POST;

    // validasi
    if (empty($title)) $errors['title'] = 'Judul tidak boleh kosong';
    if (empty($exemplars)) $errors['exemplars'] = 'Exemplar tidak boleh kosong';
    if (empty($authorId)) $errors['author_id'] = 'Penulis tidak boleh kosong';
    if (empty($publisherId)) $errors['publisher_id'] = 'Penerbit tidak boleh kosong';
    if (empty($categoryId)) $errors['category_id'] = 'Kategori tidak boleh kosong';
    if (empty($year)) $errors['year'] = 'Tahun tidak boleh kosong';
    if (empty($description)) $errors['description'] = 'Deskripsi tidak boleh kosong';
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: book-update.php?id=' . $id);
        exit;
    }

    // eksekusi backend update publisher
    if (editBook($id, $title, $exemplars, $authorId, $publisherId, $categoryId, $year, $file, $cover, $description)) {
        $_SESSION['success'] = "Publisher berhasil dibuat";
        header('Location: books.php');
    } else {
        $_SESSION['error'] = "Publisher tidak dapat dibuat";
        header('Location: book-update.php?id=' . $id);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mabook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= url('css/output.css') ?>">
</head>

<body class="bg-[url('https://www.transparenttextures.com/patterns/black-paper.png')] bg-[#1A120B]">
    <?php require_once(__DIR__ . '/../components/header.php') ?>

    <div class="w-11/12 max-w-[1200px] mx-auto mt-12 flex items-start gap-4 relative">
        <?php require_once(__DIR__ . '/../components/admin-sidebar.php') ?>

        <div class="w-full px-3">
            <div>
                <div class="font-crimson text-mabook-light flex justify-between items-center">
                    <div class="text-3xl">Edit Buku</div>
                    <a href="books.php" class="bg-mabook-midtone text-white/80 py-2 px-4 rounded-xl duration-200 hover:-translate-y-0.5 active:translate-y-1">
                        <div class="flex gap-2 items-center font-semibold">
                            <i class="fas fa-chevron-left"></i>
                            Kembali
                        </div>
                    </a>
                </div>
                <div class="flex flex-col lg:flex-row gap-3 mt-4 items-start">
                    <div class="bg-mabook-primary w-full p-5 lg:w-8/12">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $book['id'] ?>">
                            <div class="mb-3">
                                <label for="title" class="mabook-label">Judul</label>
                                <input type="text" id="title" value="<?= $old['title'] ?? $book['title'] ?? '' ?>" name="title" class="mabook-form-control" placeholder="Tuliskan judul buku...">
                                <?php if (isset($errors['title'])): ?>
                                    <span class="text-sm text-red-400 italic"><?= $errors['title'] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="exemplars" class="mabook-label">Exemplars</label>
                                <input type="number" id="exemplars" value="<?= $old['exemplars'] ?? $book['exemplars'] ?? '' ?>" name="exemplars" class="mabook-form-control" placeholder="Tuliskan jumlah eksemplars buku...">
                                <?php if (isset($errors['exemplars'])): ?>
                                    <span class="text-sm text-red-400 italic"><?= $errors['exemplars'] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <div class="flex gap-3 items-center justify-between">
                                    <label for="category_id" class="mabook-label inline-block">Kategori</label>
                                    <a href="<?= url('admin/category-create.php') ?>" class="inline-block text-mabook-light text-xs underline">Buat kategori</a>
                                </div>
                                <select name="category_id" id="category_id" class="mabook-form-control">
                                    <option value="">- Pilih kategori -</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option <?= $old['category_id'] ?? $book['category_id'] == $category['id'] ? 'selected' : '' ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['category_id'])): ?>
                                    <span class="text-sm text-red-400 italic"><?= $errors['category_id'] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <div class="flex gap-3 items-center justify-between">
                                    <label for="author_id" class="mabook-label">Penulis</label>
                                    <a href="<?= url('admin/author-create.php') ?>" class="inline-block text-mabook-light text-xs underline">Buat penulis</a>
                                </div>
                                <select name="author_id" id="author_id" class="mabook-form-control">
                                    <option value="">- Pilih penulis -</option>
                                    <?php foreach ($authors as $author): ?>
                                        <option <?= $old['author_id'] ?? $book['author_id'] == $author['id'] ? 'selected' : '' ?> value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['author_id'])): ?>
                                    <span class="text-sm text-red-400 italic"><?= $errors['author_id'] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <div class="flex gap-3 items-center justify-between">
                                    <label for="publisher_id" class="mabook-label">Penerbit</label>
                                    <a href="<?= url('admin/publisher-create.php') ?>" class="inline-block text-mabook-light text-xs underline">Buat penerbit</a>
                                </div>
                                <select name="publisher_id" id="publisher_id" class="mabook-form-control">
                                    <option value="">- Pilih penerbit -</option>
                                    <?php foreach ($publishers as $publisher): ?>
                                        <option <?= $old['publisher_id'] ?? $book['publisher_id'] == $publisher['id'] ? 'selected' : '' ?> value="<?= $publisher['id'] ?>"><?= $publisher['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['publisher_id'])): ?>
                                    <span class="text-sm text-red-400 italic"><?= $errors['publisher_id'] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="year" class="mabook-label">Tahun Terbit</label>
                                <select name="year" id="year" class="mabook-form-control">
                                    <option value="">- Pilih tahun terbit -</option>
                                    <?php for ($i = 1990; $i <= date('Y'); $i++): ?>
                                        <option <?= $old['year'] ?? $book['year'] ?? null == $i ? 'selected' : '' ?> value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php if (isset($errors['year'])): ?>
                                    <span class="text-sm text-red-400 italic"><?= $errors['year'] ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="mabook-label">Deskripsi</label>
                                <textarea name="description" id="description" placeholder="Tuliskan deskripsi tentang buku..." class="mabook-form-control"><?= $old['description'] ?? $book['description'] ?? '' ?></textarea>
                                <?php if (isset($errors['description'])): ?>
                                    <span class="text-sm text-red-400 italic"><?= $errors['description'] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="cover" class="mabook-label">Foto Sampul</label>
                                <input type="file" accept="image/*" name="cover" id="cover" class="mabook-form-control" />
                                <span class="text-xs text-mabook-light/50">Biarkan kosong jika tidak ingin mengganti</span>
                                <?php if (isset($errors['cover'])): ?>
                                    <span class="text-sm text-red-400 italic"><?= $errors['cover'] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="mabook-label">File</label>
                                <input type="file" accept="application/pdf" name="file" id="file" class="mabook-form-control" />
                                <span class="text-xs text-mabook-light/50">Biarkan kosong jika tidak ingin mengganti</span>
                                <?php if (isset($errors['file'])): ?>
                                    <span class="text-sm text-red-400 italic"><?= $errors['file'] ?></span>
                                <?php endif; ?>
                            </div>

                            <button class="mabook-btn-primary mt-3">Simpan</button>

                        </form>
                    </div>
                    <div class="w-full lg:w-4/12 bg-mabook-primary p-4 sticky top-8">
                        <label class="mabook-label">Cover</label>
                        <img src="<?= url($book['cover']) ?>" alt="cover" class="max-w" id="cover-preview">
                        <label class="mabook-label mt-3">File</label>
                        <div class="font-crimson text-mabook-light p-2 border border-mabook-light"><?= $book['file'] ?></div>
                    </div>
                </div>
            </div>
        </div><!-- end admin content -->


    </div> <!-- end container -->

    <?php require_once(__DIR__ . '/../components/footer.php') ?>

    <script>
        document.querySelector(`[name='cover']`).addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;

            const preview = document.getElementById('cover-preview');
            preview.src = URL.createObjectURL(file);
        });
    </script>
</body>

</html>