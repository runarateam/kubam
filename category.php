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
$categories = [
    [
        'name' => 'Fiksi',
        'description' => 'Buku-buku yang berisi cerita imajinatif, seperti novel dan cerpen.'
    ],
    [
        'name' => 'Non-Fiksi',
        'description' => 'Kategori yang mencakup buku berdasarkan fakta dan kejadian nyata, seperti biografi dan buku sejarah.'
    ],
    [
        'name' => 'Sains & Teknologi',
        'description' => 'Buku yang membahas ilmu pengetahuan, teknologi, dan penemuan ilmiah.'
    ],
    [
        'name' => 'Anak-anak',
        'description' => 'Buku dengan konten ringan dan ilustratif, cocok untuk anak-anak.'
    ],
    [
        'name' => 'Pengembangan Diri',
        'description' => 'Kategori yang mencakup buku motivasi, produktivitas, dan pengembangan kepribadian.'
    ],
];

?>

<body class="bg-[url('https://www.transparenttextures.com/patterns/black-paper.png')] bg-[#1A120B]">
    <?php include('./components/header.php') ?>

    <div class="w-11/12 max-w-[1200px] mx-auto mt-12">

        <div>
            <div class="font-unifraktur text-mabook-light text-4xl font-bold">Katalog Maboo<span class="font-crimson">k</span></div>
            <div class="h-[2px] w-48 bg-mabook-midtone mt-4"></div>
            <div class="grid m-4 grid-cols-3 gap-8 mt-8">
                <?php foreach ($categories as $category): ?>
                    <a href="#" class="group">
                        <div class="group-hover:-translate-y-1 duration-200 text-mabook-light flex flex-col items-start justify-center p-8 border border-mabook-midtone/25 gap-5 bg-mabook-primary relative rounded-xl overflow-hidden font-crimson">
                            <div class="absolute top-0 left-0 h-[6px] bg-mabook-midtone w-full"></div>
                            <div class="font-bold text-3xl"><?= $category['name'] ?></div>
                            <p><?= $category['description'] ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
        </div> <!-- end value proposition -->

    </div> <!-- end container -->

    <?php include('./components/footer.php') ?>
</body>

</html>