<?php require_once(__DIR__ . '/../config/constants.php') ?>
<?php require_once(__DIR__ . '/../functions/helper.php') ?>
<?php require_once(__DIR__ . '/../functions/session.php') ?>
<?php require_once(__DIR__ . '/../functions/books.php') ?>
<?php require_once(__DIR__ . '/../functions/authors.php') ?>
<?php require_once(__DIR__ . '/../functions/categories.php') ?>
<?php require_once(__DIR__ . '/../functions/publishers.php') ?>

<?php
$authors = listAuthors([], ['limit' => 999]);
$categories = listCategories([], ['limit' => 999]);
$publishers = listPublishers([], ['limit' => 999]);
$years = listBookYears();
?>

<?php
// ambil query parameter dari url 
$categoryId = $_GET['category_id'] ?? null;
$authorId = $_GET['author_id'] ?? null;
$publisherId = $_GET['publisher_id'] ?? null;
$year = $_GET['year'] ?? null;

// apply filternya
$filters = [];
if (isset($categoryId)) $filters['category_id'] = $categoryId;
if (isset($authorId)) $filters['author_id'] = $authorId;
if (isset($publisherId)) $filters['publisher_id'] = $publisherId;
if (isset($year)) $filters['year'] = $year;

$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 10;
$books = listBooks($filters, ['page' => $page, 'limit' => $limit]);
$countBooks = countBooks($filters);
$totalPage = ceil($countBooks / $limit);

// handle delete via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // eksekusi backend delete book
    deleteBook($id);
    header('Location: books.php');
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
                    <div class="text-3xl">Data Buku</div>
                    <a href="book-create.php" class="bg-mabook-midtone text-white/80 p-2 rounded-xl duration-200 hover:-translate-y-0.5 active:translate-y-1">
                        <div class="flex gap-2 items-center font-semibold">
                            <i class="fas fa-plus"></i>
                            Tambah buku
                        </div>
                    </a>
                </div>
                <div class="w-full flex gap-3 flex-col lg:flex-row mt-4">
                    <select id="filter-category" class="mabook-form-control">
                        <option value="">- Pilih kategori -</option>
                        <?php foreach ($categories as $category) : ?>
                            <option <?= $categoryId == $category['id'] ? 'selected' : '' ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select id="filter-author" class="mabook-form-control">
                        <option value="">- Pilih penulis -</option>
                        <?php foreach ($authors as $author) : ?>
                            <option <?= $authorId == $author['id'] ? 'selected' : '' ?> value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select id="filter-publisher" class="mabook-form-control">
                        <option value="">- Pilih penerbit -</option>
                        <?php foreach ($publishers as $publisher) : ?>
                            <option <?= $publisherId == $publisher['id'] ? 'selected' : '' ?> value="<?= $publisher['id'] ?>"><?= $publisher['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select id="filter-year" class="mabook-form-control">
                        <option value="">- Pilih tahun -</option>
                        <?php foreach ($years as $yr) : ?>
                            <option <?= $year == $yr ? 'selected' : '' ?> value="<?= $yr ?>"><?= $yr ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="bg-mabook-primary p-3 mt-3 w-full">
                    <table class="border-collapse border border-mabook-light/40 table-auto w-full font-crimson text-mabook-light">
                        <thead>
                            <tr>
                                <th class="p-2 border border-mabook-light/50">#</th>
                                <th class="p-2 border border-mabook-light/50">Judul</th>
                                <th class="p-2 border border-mabook-light/50">Kategori</th>
                                <th class="p-2 border border-mabook-light/50">Exemplar</th>
                                <th class="p-2 border border-mabook-light/50">Tahun</th>
                                <th class="p-2 border border-mabook-light/50">Penulis</th>
                                <th class="p-2 border border-mabook-light/50">Penerbit</th>
                                <th class="p-2 border border-mabook-light/50"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $index => $book): ?>
                                <tr>
                                    <td class="p-2 border border-mabook-light/50"><?= $index + 1 ?></td>
                                    <td class="p-2 border border-mabook-light/50">
                                        <div class="flex flex-col gap-2 items-center">
                                            <img src="<?= url($book['cover']) ?>" class="max-w-32">
                                            <?= $book['title'] ?>
                                        </div>
                                    </td>
                                    <td class="p-2 border border-mabook-light/50"><?= $book['category']['name'] ?></td>
                                    <td class="p-2 border border-mabook-light/50"><?= $book['exemplars'] ?></td>
                                    <td class="p-2 border border-mabook-light/50"><?= $book['year'] ?></td>
                                    <td class="p-2 border border-mabook-light/50"><?= $book['author']['name'] ?></td>
                                    <td class="p-2 border border-mabook-light/50"><?= $book['publisher']['name'] ?></td>
                                    <td class="p-2 border border-mabook-light/50">
                                        <div class="flex gap-2">
                                            <a href="book-update.php?id=<?= $book['id'] ?>"><i class="fas fa-edit"></i></a>
                                            <form action="#" method="POST" onsubmit="return confirm('Anda yakin?')">
                                                <input type="hidden" name="id" value="<?= $book['id'] ?>">
                                                <button type="submit" class="cursor-pointer" onclick=""><i class="fas fa-trash text-red-400"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- end admin content -->


    </div> <!-- end container -->

    <?php require_once(__DIR__ . '/../components/footer.php') ?>
    <script>
        const filterObj = {}
        <?= isset($categoryId) ? "filterObj.category_id = $categoryId \n" : '' ?>
        <?= isset($authorId) ? "filterObj.author_id = $authorId \n" : '' ?>
        <?= isset($publisherId) ? "filterObj.publisher_id = $publisherId \n" : '' ?>
        <?= isset($year) ? "filterObj.year = $year \n" : '' ?>

        const filterCategoryEl = document.querySelector('#filter-category');
        const filterAuthorEl = document.querySelector('#filter-author');
        const filterPublisherEl = document.querySelector('#filter-publisher');
        const filterYearEl = document.querySelector('#filter-year');

        // ini kalo filter catgeory berubah
        filterCategoryEl.addEventListener('change', e => {
            value = e.target.value
            if (!value) delete filterObj.category_id
            else filterObj.category_id = value
            redirectToFilter()
        })

        // ini kalo filter author berubah
        filterAuthorEl.addEventListener('change', e => {
            value = e.target.value
            if (!value) delete filterObj.author_id
            else filterObj.author_id = value
            redirectToFilter()
        })

        // ini kalo filter publisher berubah
        filterPublisherEl.addEventListener('change', e => {
            value = e.target.value
            if (!value) delete filterObj.publisher_id
            else filterObj.publisher_id = value
            redirectToFilter()
        })

        // ini kalo filter year berubah
        filterYearEl.addEventListener('change', e => {
            value = e.target.value
            if (!value) delete filterObj.year
            else filterObj.year = value
            redirectToFilter()
        })

        function redirectToFilter() {
            const query = new URLSearchParams(filterObj).toString()
            window.location.href = `${window.location.pathname}?${query}`
        }
    </script>
</body>

</html>