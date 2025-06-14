<?php require_once(__DIR__ . '/config/constants.php') ?>
<?php require_once(__DIR__ . '/functions/helper.php') ?>
<?php require_once(__DIR__ . '/functions/session.php') ?>

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
        <div class="hero w-full shadow-[0_10px_20px_rgba(0,0,0,0.5)]">
            <div class="w-10/12 max-w-[1000px] mx-auto px-16 py-32 gap-12 flex flex-col items-center justify-center">
                <div class="font-unifraktur text-mabook-light text-5xl font-bold">Maboo<span class="font-crimson">k</span></div>
                <p class="font-crimson text-xl text-center text-white">
                    Perpustakaan digital Dark Academia yang menghadirkan koleksi literatur klasik dan kontemporer terbaik. Temukan dunia pengetahuan, fiksi spekulatif, puisi abadi, dan karya-karya pemikiran mendalam dalam genggaman Anda.
                </p>
                <a href="collection.php" class="bg-mabook-midtone p-3 shadow-xl font-crimson text-white font-bold text-lg">Jelajahi Koleksi</a>
            </div>
        </div> <!-- end hero section -->

        <div class="quote w-full mt-12 relative">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="relative z-10 w-10/12 max-w-[1000px] mx-auto py-12 gap-4 flex flex-col items-center justify-center">
                <p class="text-3xl text-mabook-light italic font-semibold">"Reading is essential for those who seek to rise above the ordinary."</p>
                <span class="text-lg text-mabook-midtone">— Jim Rohn</span>
            </div>
        </div> <!-- end quote section -->

        <div>
            <div class="font-unifraktur text-mabook-light text-4xl font-bold">Mengapa memilih Maboo<span class="font-crimson">k</span></div>
            <div class="h-[2px] w-48 bg-mabook-midtone mt-4"></div>
            <div class="grid m-4 grid-cols-3 gap-8 mt-8">
                <div class="text-mabook-light flex flex-col items-start justify-center p-8 border border-mabook-midtone/25 gap-5 bg-mabook-primary relative rounded-xl overflow-hidden font-crimson">
                    <div class="absolute top-0 left-0 h-[6px] bg-mabook-midtone w-full"></div>
                    <i class="fas fa-book text-mabook-midtone text-4xl mb-4"></i>
                    <div class="font-bold text-3xl">Koleksi Ekslusif</div>
                    <p>Ribuan buku digital dari berbagai genre, termasuk literatur klasik, filosofi, sejarah, dan fiksi spekulatif.</p>
                </div>
                <div class="text-mabook-light flex flex-col items-start justify-center p-8 border border-mabook-midtone/25 gap-5 bg-mabook-primary relative rounded-xl overflow-hidden font-crimson">
                    <div class="absolute top-0 left-0 h-[6px] bg-mabook-midtone w-full"></div>
                    <i class="fas fa-moon text-mabook-midtone text-4xl mb-4"></i>
                    <div class="font-bold text-3xl">Mode Baca Nyaman </div>
                    <p>Mode malam dan penyesuaian font untuk pengalaman membaca yang lebih nyaman di segala kondisi..</p>
                </div>
                <div class="text-mabook-light flex flex-col items-start justify-center p-8 border border-mabook-midtone/25 gap-5 bg-mabook-primary relative rounded-xl overflow-hidden font-crimson">
                    <div class="absolute top-0 left-0 h-[6px] bg-mabook-midtone w-full"></div>
                    <i class="fas fa-bookmark text-mabook-midtone text-4xl mb-4"></i>
                    <div class="font-bold text-3xl">Book Tracker</div>
                    <p>Lacak buku yang sedang dan akan dibaca dengan sistem yang terorganisir dan personal.</p>
                </div>
                <div class="text-mabook-light flex flex-col items-start justify-center p-8 border border-mabook-midtone/25 gap-5 bg-mabook-primary relative rounded-xl overflow-hidden font-crimson">
                    <div class="absolute top-0 left-0 h-[6px] bg-mabook-midtone w-full"></div>
                    <i class="fas fa-book text-mabook-midtone text-4xl mb-4"></i>
                    <div class="font-bold text-3xl">Catatan Pribadi</div>
                    <p>Tambahkan highlight dan catatan pribadi di setiap halaman buku yang Anda baca.</p>
                </div>
                <div class="text-mabook-light flex flex-col items-start justify-center p-8 border border-mabook-midtone/25 gap-5 bg-mabook-primary relative rounded-xl overflow-hidden font-crimson">
                    <div class="absolute top-0 left-0 h-[6px] bg-mabook-midtone w-full"></div>
                    <i class="fas fa-fire text-mabook-midtone text-4xl mb-4"></i>
                    <div class="font-bold text-3xl">Reading Streak</div>
                    <p>Pertahankan kebiasaan membaca dengan sistem streak harian yang memotivasi.</p>
                </div>
            </div>
        </div> <!-- end value proposition -->

    </div> <!-- end container -->

    <?php require_once(__DIR__ . '/components/footer.php') ?>
</body>

</html>