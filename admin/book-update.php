<?php include('./dummy.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mabook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/output.css">
</head>

<body class="bg-[url('https://www.transparenttextures.com/patterns/black-paper.png')] bg-[#1A120B]">
    <?php include('../components/header.php') ?>

    <div class="w-11/12 max-w-[1200px] mx-auto mt-12 flex items-start gap-4 relative">
        <?php include('../components/admin-sidebar.php') ?>

        <div class="w-full px-3">
            <div>
                <div class="font-crimson text-mabook-light flex justify-between items-center">
                    <div class="text-3xl">Edit Buku</div>
                    <a href="/admin/books.php" class="bg-mabook-midtone text-white/80 py-2 px-4 rounded-xl duration-200 hover:-translate-y-0.5 active:translate-y-1">
                        <div class="flex gap-2 items-center font-semibold">
                            <i class="fas fa-chevron-left"></i>
                            Kembali
                        </div>
                    </a>
                </div>
                <div class="bg-mabook-primary w-full p-5 mt-3">
                    <form action="#">
                        <div class="mb-3">
                            <label for="title" class="mabook-label">Judul</label>
                            <input type="text" id="title" name="title" class="mabook-form-control" placeholder="Tuliskan judul buku...">
                        </div>
                        <div class="mb-3">
                            <label for="exemplars" class="mabook-label">Exemplars</label>
                            <input type="number" id="exemplars" name="exemplars" class="mabook-form-control" placeholder="Tuliskan jumlah eksemplars buku...">
                        </div>
                        <div class="mb-3">
                            <label for="author_id" class="mabook-label">Penulis</label>
                            <select name="author_id" id="author_id" class="mabook-form-control">
                                <?php foreach ($authors as $author): ?>
                                    <option value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="publisher_id" class="mabook-label">Penerbit</label>
                            <select name="publisher_id" id="publisher_id" class="mabook-form-control">
                                <?php foreach ($publishers as $publisher): ?>
                                    <option value="<?= $publisher['id'] ?>"><?= $publisher['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="publisher_id" class="mabook-label">Tahun Terbit</label>
                            <select name="publisher_id" id="publisher_id" class="mabook-form-control">
                                <?php for ($i = 1990; $i <= date('Y'); $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="mabook-label">Tahun Terbit</label>
                            <textarea name="description" id="description" placeholder="Tuliskan deskripsi tentang buku..." class="mabook-form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="mabook-label">Foto Sampul</label>
                            <input type="file" name="cover" id="cover" placeholder="Tuliskan deskripsi tentang buku..." class="mabook-form-control" />
                        </div>

                        <button class="mabook-btn-primary mt-3">Simpan</button>

                    </form>
                </div>
            </div>
        </div><!-- end admin content -->


    </div> <!-- end container -->

    <?php include('../components/footer.php') ?>
</body>

</html>