<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mabook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/output.css">
</head>


<?php
$authors = [
    [
        'id' => 1,
        'name' => 'Andrea Hirata',
        'website' => 'https://andreahirata.com',
        'description' => 'Penulis novel terkenal asal Indonesia, dikenal lewat karya-karya inspiratif seperti Laskar Pelangi.'
    ],
    [
        'id' => 2,
        'name' => 'Tere Liye',
        'website' => 'https://tereliye.com',
        'description' => 'Penulis produktif Indonesia yang banyak menulis novel bergenre drama, fantasi, dan motivasi.'
    ],
    [
        'id' => 3,
        'name' => 'J.K. Rowling',
        'website' => 'https://www.jkrowling.com',
        'description' => 'Penulis asal Inggris, pencipta seri novel Harry Potter yang sangat terkenal di seluruh dunia.'
    ],
    [
        'id' => 4,
        'name' => 'George Orwell',
        'website' => 'https://orwellfoundation.com',
        'description' => 'Penulis dan jurnalis Inggris yang dikenal dengan karya distopia seperti 1984 dan Animal Farm.'
    ],
    [
        'id' => 5,
        'name' => 'Yuval Noah Harari',
        'website' => 'https://www.ynharari.com',
        'description' => 'Sejarawan dan penulis asal Israel yang dikenal lewat buku Sapiens dan Homo Deus.'
    ],
];
$publishers = [
    [
        'id' => 1,
        'name' => 'Bentang Pustaka',
        'website' => 'https://bentangpustaka.com',
        'description' => 'Penerbit buku Indonesia yang menerbitkan berbagai buku fiksi dan non-fiksi berkualitas.'
    ],
    [
        'id' => 2,
        'name' => 'Gramedia Pustaka Utama',
        'website' => 'https://gpu.id',
        'description' => 'Salah satu penerbit terbesar di Indonesia, terkenal dengan karya sastra dan buku populer.'
    ],
    [
        'id' => 3,
        'name' => 'Bloomsbury Publishing',
        'website' => 'https://www.bloomsbury.com',
        'description' => 'Penerbit asal Inggris yang menerbitkan buku-buku besar seperti seri Harry Potter.'
    ],
];

$books = [
    [
        'title' => 'Bumi',
        'exemplars' => 8,
        'author_id' => 2,
        'publisher_id' => 1,
        'year' => 2014,
        'book_file' => null,
        'thumbnail' => '/images/bumi.jpg',
        'created_at' => '2023-02-15 11:20:00',
        'publisher' => $publishers[1],
        'author' => $authors[1],
    ],
    [
        'title' => 'Harry Potter and the Philosopher\'s Stone',
        'exemplars' => 15,
        'author_id' => 3,
        'publisher_id' => 3,
        'year' => 1997,
        'book_file' => null,
        'thumbnail' => '/images/harry-potter.webp',
        'created_at' => '2023-03-01 09:45:00',
        'publisher' => $publishers[2],
        'author' => $authors[2],
    ]
];
?>

<body class="bg-[url('https://www.transparenttextures.com/patterns/black-paper.png')] bg-[#1A120B]">
    <?php include('./components/header.php') ?>

    <div class="w-11/12 max-w-[1200px] mx-auto mt-12">

        <div>
            <div class="font-unifraktur text-mabook-light text-4xl font-bold">Koleksi Maboo<span class="font-crimson">k</span></div>
            <div class="h-[2px] w-48 bg-mabook-midtone mt-4"></div>
            <div class="grid m-4 grid-cols-4 gap-8 mt-8">
                <?php foreach ($books as $book) : ?>
                    <a href="#" class="group">
                        <div class="group-hover:-translate-y-1 duration-200 text-mabook-light h-full flex flex-col items-start justify-start p-4 border border-mabook-midtone/25 gap-5 bg-mabook-primary relative rounded-xl overflow-hidden font-crimson">
                            <img src="<?= $book['thumbnail'] ?>" class="w-full">
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

    <?php include('./components/footer.php') ?>
</body>

</html>