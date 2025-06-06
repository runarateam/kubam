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
                    <div class="text-3xl">Edit Penerbit</div>
                    <a href="/admin/publishers.php" class="bg-mabook-midtone text-white/80 py-2 px-4 rounded-xl duration-200 hover:-translate-y-0.5 active:translate-y-1">
                        <div class="flex gap-2 items-center font-semibold">
                            <i class="fas fa-chevron-left"></i>
                            Kembali
                        </div>
                    </a>
                </div>
                <div class="bg-mabook-primary w-full p-5 mt-3">
                    <form action="#">
                        <div class="mb-3">
                            <label for="name" class="mabook-label">Nama</label>
                            <input type="text" id="name" name="name" class="mabook-form-control" placeholder="Tuliskan nama penerbit...">
                        </div>
                        <div class="mb-3">
                            <label for="website" class="mabook-label">Website</label>
                            <input type="number" id="website" name="website" class="mabook-form-control" placeholder="Tuliskan alamat website penerbit...">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="mabook-label">Tahun Terbit</label>
                            <textarea name="description" id="description" placeholder="Tuliskan deskripsi tentang penerbit..." class="mabook-form-control"></textarea>
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