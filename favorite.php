<?php require_once(__DIR__ . '/config/constants.php') ?>
<?php require_once(__DIR__ . '/functions/helper.php') ?>
<?php require_once(__DIR__ . '/functions/session.php') ?>
<?php require_once(__DIR__ . '/functions/bookmarks.php') ?>

<?php
$bookmarks = listBookmarks($loggedUser['id']);
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
            <div class="grid m-4 grid-cols-4 gap-8 mt-8">
                <?php foreach ($bookmarks as $book) : ?>
                    <a href="reader.php?book_id=<?= $book['id'] ?>" class="group">
                        <div class="group-hover:-translate-y-1 duration-200 text-mabook-light h-full flex flex-col items-start justify-start p-4 border border-mabook-midtone/25 gap-5 bg-mabook-primary relative rounded-xl overflow-hidden font-crimson">
                            <img src="<?= url($book['cover']) ?>" class="w-full">
                            <div class="flex flex-col gap-3">
                                <h2 class="text-3xl"><?= $book['title'] ?></h2>
                                <div>
                                    <div>By: <span><?= $book['author_name'] ?></span></div>
                                    <div>Penerbit: <span><?= $book['publisher_name'] ?>, <?= $book['year'] ?></span></div>
                                    <div class="py-1 px-2 mt-1 bg-mabook-light font-bold rounded-xl text-mabook-primary">Terakhir dibaca di halaman: <?= $book['last_page_read'] ?></div>
                                    <div class="mt-2 text-center"><?= date('d F Y, H:i', strtotime($book['last_read'])) ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
        </div> <!-- end value proposition -->

    </div> <!-- end container -->

    <?php require_once(__DIR__ . '/components/footer.php') ?>
</body>

</html>