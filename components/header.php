<?php
$search = $_GET['search'] ?? '';
?>

<!-- header -->
<header class="bg-mabook-primary border-b border-mabook-midtone py-1 shadow-xl">
    <div class="w-11/12 max-w-[1200px] mx-auto">
        <div class="flex items-center justify-between gap-2 p-3">
            <div class="flex items-center gap-3">
                <div class="text-mabook-midtone text-5xl">
                    <i class="fas fa-book-open"></i>
                </div>
                <a href="<?= url('index.php') ?>" class="block font-unifraktur text-mabook-light text-5xl">Maboo<span class="font-crimson">k</span></a>
            </div> <!-- end brand -->

            <div class="hidden lg:flex text-mabook-light text-lg justify-center items-center font-crimson gap-3">
                <a href="<?= url('index.php') ?>" class="hover:text-mabook-midtone p-2 group relative text-center">
                    Beranda
                    <div class="absolute bg-mabook-midtone w-0 left-0 bottom-0 h-[2px] group-hover:w-full duration-200"></div>
                </a>
                <a href="<?= url('category.php') ?>" class="hover:text-mabook-midtone p-2 group relative text-center">
                    Kategori
                    <div class="absolute bg-mabook-midtone w-0 left-0 bottom-0 h-[2px] group-hover:w-full duration-200"></div>
                </a>
                <a href="<?= url('collection.php') ?>" class="hover:text-mabook-midtone p-2 group relative text-center">
                    Koleksi
                    <div class="absolute bg-mabook-midtone w-0 left-0 bottom-0 h-[2px] group-hover:w-full duration-200"></div>
                </a>
                <?php if ($isLoggedIn): ?>
                    <a href="<?= url('favorite.php') ?>" class="hover:text-mabook-midtone p-2 group relative text-center">
                        Favoritku
                        <div class="absolute bg-mabook-midtone w-0 left-0 bottom-0 h-[2px] group-hover:w-full duration-200"></div>
                    </a>
                <?php endif; ?>
            </div> <!-- end navbar links -->

            <div class="hidden lg:block">
                <form action="<?= url('collection.php') ?>" method="GET">
                    <div class="flex items-center">
                        <input value="<?= $search ?>" name="search" type="text" class="bg-[#1a120b] p-2 text-mabook-light font-crimson" placeholder="Cari buku, penulis...">
                        <button type="submit" class="text-white bg-mabook-midtone p-2 w-10 duration-200 cursor-pointer hover:bg-mabook-midtone/75">
                            <i class="fas fa-search aspect-square"></i>
                        </button>
                    </div>
                </form>
            </div> <!-- end form -->

            <div class="hidden lg:flex gap-2 items-center justify-center">
                <?php if ($isLoggedIn) : ?>
                    <?php if ($loggedUser['role'] == 'ADMIN') : ?>
                        <a href="<?= url('admin/dashboard.php') ?>" class="font-crimson text-mabook-light border border-mabook-light px-3 py-2 text-lg rounded-xl">Dashboard</a>
                    <?php else: ?>
                        <div class="text-mabook-light text-sm italic">Hello, <?= $loggedUser['name'] ?></div>
                    <?php endif; ?>
                    <a href="<?= url('logout.php') ?>" class="font-crimson text-mabook-light border border-mabook-light px-3 py-2 text-lg rounded-xl">Logout</a>
                <?php else: ?>
                    <a href="<?= url('login.php') ?>" class="font-crimson text-mabook-light border border-mabook-light px-3 py-2 text-lg rounded-xl">Login</a>
                    <a href="<?= url('register.php') ?>" class="font-crimson text-mabook-light border border-mabook-light px-3 py-2 text-lg rounded-xl">Register</a>
                <?php endif; ?>
            </div> <!-- end login buttons -->
            <button class="text-mabook-light cursor-pointer" id="nav-button">
                <i class="fas fa-bars text-lg"></i>
            </button>
        </div>
    </div> <!-- end container -->
</header>

<div class="fixed inset-0 z-40 bg-black/50 hidden lg:hidden items-end " id="nav-backdrop">
    <div class="bg-mabook-light w-full mx-4 mb-4 bottom-0 p-2 z-50 font-crimson text-mabook-primary flex flex-col gap-3 rounded-xl" id="nav-content">
        <div class="gap-2 flex items-center justify-center">
            <?php if ($isLoggedIn) : ?>
                <?php if ($loggedUser['role'] == 'ADMIN') : ?>
                    <a href="<?= url('admin/dashboard.php') ?>" class="font-crimson text-mabook-primary border border-mabook-primary px-2 py-1 rounded-xl">Dashboard</a>
                <?php else: ?>
                    <div class="text-mabook-primary text-sm italic">Hello, <?= $loggedUser['name'] ?></div>
                <?php endif; ?>
                <a href="<?= url('logout.php') ?>" class="font-crimson text-mabook-primary border border-mabook-primary px-2 py-1 rounded-xl">Logout</a>
            <?php else: ?>
                <a href="<?= url('login.php') ?>" class="font-crimson text-mabook-primary border border-mabook-primary px-2 py-1 rounded-xl">Login</a>
                <a href="<?= url('register.php') ?>" class="font-crimson text-mabook-primary border border-mabook-primary px-2 py-1 rounded-xl">Register</a>
            <?php endif; ?>
        </div> <!-- end login buttons -->
        <hr class="border-mabook-primary">
        <form action="<?= url('collection.php') ?>" method="GET">
            <div class="flex items-center w-full">
                <input autocomplete="off" value="<?= $search ?>" name="search" type="text" class="grow bg-[#1a120b] p-2 text-mabook-light font-crimson" placeholder="Cari buku, penulis...">
                <button type="submit" class="text-white bg-mabook-midtone p-2 w-10 duration-200 cursor-pointer hover:bg-mabook-midtone/75">
                    <i class="fas fa-search aspect-square"></i>
                </button>
            </div>
        </form>
        <hr class="border-mabook-primary">
        <a href="<?= url('index.php') ?>" class="block w-full text-center rounded-xl p-2 hover:bg-black/10 text-lg font-bold px-3">Beranda</a>
        <a href="<?= url('category.php') ?>" class="block w-full text-center rounded-xl p-2 hover:bg-black/10 text-lg font-bold px-3">Kategori</a>
        <a href="<?= url('collection.php') ?>" class="block w-full text-center rounded-xl p-2 hover:bg-black/10 text-lg font-bold px-3">Koleksi</a>
        <?php if ($isLoggedIn): ?>
            <a href="<?= url('favorite.php') ?>" class="block w-full text-center rounded-xl p-2 hover:bg-black/10 text-lg font-bold px-3">Favoritku</a>
        <?php endif; ?>

    </div>
</div>

<script>
    const backdropEl = document.querySelector('#nav-backdrop')
    const contentEl = document.querySelector('#nav-content')
    const buttonEl = document.querySelector('#nav-button')

    buttonEl.addEventListener('click', e => {
        backdropEl.classList.toggle('hidden')
        backdropEl.classList.toggle('flex')
    })

    backdropEl.addEventListener('click', e => {
        const isMobileNavIncluded = contentEl.contains(e.target)
        if (isMobileNavIncluded) return

        backdropEl.classList.remove('flex')
        backdropEl.classList.add('hidden')
    })
</script>