<?php require_once(__DIR__ . '/../config/constants.php') ?>
<?php require_once(__DIR__ . '/../functions/helper.php') ?>
<?php require_once(__DIR__ . '/../functions/session.php') ?>
<?php require_once(__DIR__ . '/../functions/admin.php') ?>

<?php
$id = $_GET['id'];
if (empty($id)) die('Halaman tidak valid, <a href="publishers.php"><< Kembali</a>');

$publisher = getPublisher($id);

// handler buat submit 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $website = $_POST['website'];
    $description = $_POST['description'];

    // validasi
    if (empty($name)) $errors['name'] = "Nama tidak boleh kosong";
    if (empty($website)) $errors['website'] = "Website tidak boleh kosong";
    if (empty($description)) $errors['description'] = "Deskripsi tidak boleh kosong";
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: publisher-update.php?id=' . $id);
        exit;
    }

    // eksekusi backend update publisher
    if (editPublisher($id, $name, $website, $description)) {
        $_SESSION['success'] = "Publisher berhasil dibuat";
        header('Location: publishers.php');
    } else {
        $_SESSION['error'] = "Publisher tidak dapat dibuat";
        header('Location: publisher-update.php?id=' . $id);
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
                    <div class="text-3xl">Edit Penerbit</div>
                    <a href="publishers.php" class="bg-mabook-midtone text-white/80 py-2 px-4 rounded-xl duration-200 hover:-translate-y-0.5 active:translate-y-1">
                        <div class="flex gap-2 items-center font-semibold">
                            <i class="fas fa-chevron-left"></i>
                            Kembali
                        </div>
                    </a>
                </div>
                <div class="bg-mabook-primary w-full p-5 mt-3">
                    <form action="#" method="POST">
                        <input type="hidden" name="id" value="<?= $publisher['id'] ?>">
                        <div class="mb-3">
                            <label for="name" class="mabook-label">Nama</label>
                            <input type="text" id="name" name="name" value="<?= $old['name'] ?? $publisher['name'] ?>" class="mabook-form-control" placeholder="Tuliskan nama penulis...">
                            <?php if (isset($errors['name'])) : ?>
                                <span class="italic text-red-400 text-sm"><?= $errors['name'] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="website" class="mabook-label">Website</label>
                            <input type="text" id="website" name="website" value="<?= $old['website'] ?? $publisher['website'] ?>" class="mabook-form-control" placeholder="Tuliskan alamat website penulis...">
                            <?php if (isset($errors['website'])) : ?>
                                <span class="italic text-red-400 text-sm"><?= $errors['website'] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="mabook-label">Tahun Terbit</label>
                            <textarea name="description" id="description" placeholder="Tuliskan deskripsi tentang penulis..." class="mabook-form-control"><?= $old['description'] ?? $publisher['description'] ?></textarea>
                            <?php if (isset($errors['description'])) : ?>
                                <span class="italic text-red-400 text-sm"><?= $errors['description'] ?></span>
                            <?php endif; ?>
                        </div>
                        <button class="mabook-btn-primary mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div><!-- end admin content -->


    </div> <!-- end container -->

    <?php require_once(__DIR__ . '/../components/footer.php') ?>
</body>

</html>