<?php require_once(__DIR__ . '/../config/constants.php') ?>
<?php require_once(__DIR__ . '/../functions/helper.php') ?>
<?php require_once(__DIR__ . '/../functions/session.php') ?>
<?php require_once(__DIR__ . '/../functions/books.php') ?>
<?php require_once(__DIR__ . '/../functions/authors.php') ?>
<?php require_once(__DIR__ . '/../functions/publishers.php') ?>
<?php require_once(__DIR__ . '/../functions/users.php') ?>
<?php require_once(__DIR__ . '/../functions/bookmarks.php') ?>

<?php
$bookCount = countBooks([]);
$authorCount = countAuthors([]);
$publisherCount = countPublishers([]);
$bookmarkCount = countBookmarks([]);
$userCount = countUsers([]);
$activeUserCount = countActiveUsers();
$statActiveUsers = statActiveUsers();


$dates = [];
$values = [];
foreach ($statActiveUsers as $data) {
    $dates[] = date('d F', strtotime($data['date']));
    $values[] = $data['user_count'];
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
            <div class="grid grid-cols-3 gap-3">
                <div class="flex items-center gap-5 justify-between shadow-lg bg-mabook-primary text-mabook-light py-3 px-6 font-crimson">
                    <h3 class="text-5xl font-black"><?= $bookCount ?></h3>
                    <div class="grow">
                        <div class="text-3xl">Buku</div>
                        <div class="text-sm">Tersimpan</div>
                    </div>
                </div>
                <div class="flex items-center gap-5 justify-between shadow-lg bg-mabook-primary text-mabook-light py-3 px-6 font-crimson">
                    <h3 class="text-5xl font-black"><?= $authorCount ?></h3>
                    <div class="grow">
                        <div class="text-3xl">Penulis</div>
                        <div class="text-sm">Terdaftar</div>
                    </div>
                </div>
                <div class="flex items-center gap-5 justify-between shadow-lg bg-mabook-primary text-mabook-light py-3 px-6 font-crimson">
                    <h3 class="text-5xl font-black"><?= $publisherCount ?></h3>
                    <div class="grow">
                        <div class="text-3xl">Penerbit</div>
                        <div class="text-sm">Tercatat</div>
                    </div>
                </div>
                <div class="flex items-center gap-5 justify-between shadow-lg bg-mabook-primary text-mabook-light py-3 px-6 font-crimson">
                    <h3 class="text-5xl font-black"><?= $userCount ?></h3>
                    <div class="grow">
                        <div class="text-3xl">Pengguna</div>
                        <div class="text-sm">Aktif</div>
                    </div>
                </div>
                <div class="flex items-center gap-5 justify-between shadow-lg bg-mabook-primary text-mabook-light py-3 px-6 font-crimson">
                    <h3 class="text-5xl font-black"><?= $bookmarkCount ?></h3>
                    <div class="grow">
                        <div class="text-3xl">Bookmark</div>
                        <div class="text-sm">Tertaut</div>
                    </div>
                </div>
                <div class="flex items-center gap-5 justify-between shadow-lg bg-mabook-primary text-mabook-light py-3 px-6 font-crimson">
                    <h3 class="text-5xl font-black"><?= $activeUserCount ?></h3>
                    <div class="grow">
                        <div class="text-3xl">Pengguna</div>
                        <div class="text-sm">Membaca hari ini</div>
                    </div>
                </div>
            </div> <!-- end stats -->

            <div class="w-full bg-mabook-primary p-5 mt-12 shadow-2xl">
                <div class="text-2xl text-mabook-light mb-4 font-crimson font-bold">Aktifitas Pengguna dalams seminggu</div>
                <canvas id="user-reading"></canvas>
            </div>
        </div><!-- end admin content -->


    </div> <!-- end container -->

    <?php require_once(__DIR__ . '/../components/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('user-reading');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($dates) ?>,
                datasets: [{
                    label: '# of Votes',
                    data: <?= json_encode($values) ?>,
                    borderWidth: 2,
                    borderColor: '#e0c097',
                    backgroundColor: 'transparent',
                    tension: 0.3, // lower = less sharp corners
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            color: 'rgba(224, 192, 151, 1)'
                        },
                        grid: {
                            color: 'rgba(224, 192, 151, 0.2)'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: 'rgba(224, 192, 151, 1)'
                        },
                        grid: {
                            color: 'rgba(224, 192, 151, 0.2)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    }
                }
            }
        });
    </script>
</body>

</html>