<?php require_once(__DIR__ . '/../config/constants.php') ?>
<?php require_once(__DIR__ . '/../functions/helper.php') ?>
<?php require_once(__DIR__ . '/../functions/session.php') ?>
<?php require_once(__DIR__ . '/../functions/categories.php') ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // ambil inputannya
    $name = $_POST['name'];
    $description = $_POST['description'];
    $_SESSION['old'] = $_POST;

    // validasi
    if (empty($name)) $errors['name'] = "Nama tidak boleh kosong";
    if (empty($description)) $errors['description'] = "Deskripsi tidak boleh kosong";
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: category-create.php');
        exit;
    }

    // eksekusi backend create category
    if (createCategory($name, $description)) {
        $_SESSION['success'] = "Category berhasil dibuat";
        header('Location: categories.php');
    } else {
        $_SESSION['error'] = "Category tidak dapat dibuat";
        header('Location: category-create.php');
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
                    <div class="text-3xl">Tambah Kategori</div>
                    <a href="categories.php" class="bg-mabook-midtone text-white/80 py-2 px-4 rounded-xl duration-200 hover:-translate-y-0.5 active:translate-y-1">
                        <div class="flex gap-2 items-center font-semibold">
                            <i class="fas fa-chevron-left"></i>
                            Kembali
                        </div>
                    </a>
                </div>
                <div class="bg-mabook-primary w-full p-5 mt-3">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="name" class="mabook-label">Nama</label>
                            <input type="text" id="name" name="name" value="<?= $old['name'] ?>" class="mabook-form-control" placeholder="Tuliskan nama penulis...">
                            <?php if (isset($errors['name'])) : ?>
                                <span class="italic text-sm text-red-400"><?= $errors['name'] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="mabook-label">Deskripsi</label>
                            <textarea name="description" id="description" placeholder="Tuliskan deskripsi tentang penulis..." class="mabook-form-control"><?= $old['description'] ?></textarea>
                            <?php if (isset($errors['description'])) : ?>
                                <span class="italic text-sm text-red-400"><?= $errors['description'] ?></span>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="mabook-btn-primary mt-3">Simpan</button>
                        <?php if (isset($error)) : ?>
                            <div class="p-3 text-red-400 italic text-center"><?= $error ?></div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div><!-- end admin content -->


    </div> <!-- end container -->

    <?php require_once(__DIR__ . '/../components/footer.php') ?>
</body>

</html>