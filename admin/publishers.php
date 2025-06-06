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
                    <div class="text-3xl">Data Penerbit</div>
                    <a href="/admin/publisher-create.php" class="bg-mabook-midtone text-white/80 p-2 rounded-xl duration-200 hover:-translate-y-0.5 active:translate-y-1">
                        <div class="flex gap-2 items-center font-semibold">
                            <i class="fas fa-plus"></i>
                            Tambah penerbit
                        </div>
                    </a>
                </div>

                <div class="bg-mabook-primary w-full p-3 mt-3">
                    <table class="border-collapse border border-mabook-light/40 table-auto w-full font-crimson text-mabook-light">
                        <thead>
                            <tr>
                                <th class="p-2 border border-mabook-light/50">#</th>
                                <th class="p-2 border border-mabook-light/50">Nama</th>
                                <th class="p-2 border border-mabook-light/50">Website</th>
                                <th class="p-2 border border-mabook-light/50">Deskripsi</th>
                                <th class="p-2 border border-mabook-light/50"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($publishers as $index => $publisher): ?>
                                <tr>
                                    <td class="p-2 border border-mabook-light/50"><?= $index + 1 ?></td>
                                    <td class="p-2 border border-mabook-light/50"><?= $publisher['name'] ?></td>
                                    <td class="p-2 border border-mabook-light/50"><?= $publisher['website'] ?></td>
                                    <td class="p-2 border border-mabook-light/50"><?= $publisher['description'] ?></td>
                                    <td class="p-2 border border-mabook-light/50">
                                        <div class="flex gap-2">
                                            <a href="/admin/publisher-update.php"><i class="fas fa-edit"></i></a>
                                            <a href="#"><i class="fas fa-trash text-red-400"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- end admin content -->


    </div> <!-- end container -->

    <?php include('../components/footer.php') ?>
</body>

</html>