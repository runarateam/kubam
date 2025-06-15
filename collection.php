<?php require_once(__DIR__ . '/config/constants.php') ?>
<?php require_once(__DIR__ . '/functions/helper.php') ?>
<?php require_once(__DIR__ . '/functions/session.php') ?>
<?php require_once(__DIR__ . '/functions/books.php') ?>
<?php require_once(__DIR__ . '/functions/authors.php') ?>
<?php require_once(__DIR__ . '/functions/categories.php') ?>
<?php require_once(__DIR__ . '/functions/publishers.php') ?>
<?php
// ambil query parameter dari url
$categoryId = $_GET['category_id'];
$authorId = $_GET['author_id'];
$publisherId = $_GET['publisher_id'];
$year = $_GET['year'];

// apply filternya
$filters = [];
if (isset($categoryId)) $filters['category_id'] = $categoryId;
if (isset($authorId)) $filters['author_id'] = $authorId;
if (isset($publisherId)) $filters['publisher_id'] = $publisherId;
if (isset($year)) $filters['year'] = $year;

$books = listBooks($filters, ['limit' => 999]);
$authors = listAuthors([], ['limit' => 999]);
$categories = listCategories([], ['limit' => 999]);
$publishers = listPublishers([], ['limit' => 999]);
$years = listBookYears();
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
    <?php require_once(__DIR__ . '/components/header.php') ?>

    <div class="w-11/12 max-w-[1200px] mx-auto mt-12">

        <div>
            <div class="font-unifraktur text-mabook-light text-4xl font-bold">Koleksi Maboo<span class="font-crimson">k</span></div>
            <div class="h-[2px] w-48 bg-mabook-midtone mt-4"></div>
            <div class="w-full flex justify-between items-center mt-2 gap-3">
                <select id="filter-category" class="mabook-form-control">
                    <option value="">- Pilih kategori -</option>
                    <?php foreach ($categories as $category) : ?>
                        <option <?= $categoryId == $category['id'] ? 'selected' : '' ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="mabook-form-control" id="filter-author">
                    <option value="">- Pilih penulis -</option>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?= $author['id'] ?>" <?php if ($author['id'] == $authorId): ?>selected<?php endif; ?>><?= $author['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="mabook-form-control" id="filter-publisher">
                    <option value="">- Pilih penerbit -</option>
                    <?php foreach ($publishers as $publisher): ?>
                        <option value="<?= $publisher['id'] ?>" <?php if ($publisher['id'] == $publisherId): ?>selected<?php endif; ?>><?= $publisher['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="mabook-form-control" id="filter-year">
                    <option value="">- Pilih tahun -</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                </select>
            </div>
            <div class="grid m-4 grid-cols-4 gap-8 mt-8">
                <?php foreach ($books as $book) : ?>
                    <a href="reader.php?book_id=<?= $book['id'] ?>" class="group">
                        <div class="group-hover:-translate-y-1 duration-200 text-mabook-light h-full flex flex-col items-start justify-start p-4 border border-mabook-midtone/25 gap-5 bg-mabook-primary relative rounded-xl overflow-hidden font-crimson">
                            <img src="<?= url($book['cover']) ?>" class="w-full">
                            <div class="flex flex-col gap-3">
                                <h2 class="text-3xl"><?= $book['title'] ?></h2>
                                <div>
                                    <div>By: <span><?= $book['author']['name'] ?></span></div>
                                    <div>Penerbit: <span><?= $book['publisher']['name'] ?>, <?= $book['year'] ?></span></div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
        </div> <!-- end value proposition -->

    </div> <!-- end container -->

    <?php require_once(__DIR__ . '/components/footer.php') ?>
    <script>
        const filterObj = {}
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