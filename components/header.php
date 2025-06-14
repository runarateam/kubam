<!-- header -->
<header class="bg-mabook-primary border-b border-mabook-midtone py-1 shadow-xl">
    <div class="w-11/12 max-w-[1200px] mx-auto">
        <div class="flex items-center justify-between gap-2 p-3">
            <div class="flex items-center gap-3">
                <div class="text-mabook-midtone text-5xl">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="font-unifraktur text-mabook-light text-5xl">Maboo<span class="font-crimson">k</span></div>
            </div> <!-- end brand -->

            <div class="flex text-mabook-light text-lg justify-center items-center font-crimson gap-3">
                <a href="index.php" class="hover:text-mabook-midtone p-2 group relative text-center">
                    Beranda
                    <div class="absolute bg-mabook-midtone w-0 left-0 bottom-0 h-[2px] group-hover:w-full duration-200"></div>
                </a>
                <a href="category.php" class="hover:text-mabook-midtone p-2 group relative text-center">
                    Kategori
                    <div class="absolute bg-mabook-midtone w-0 left-0 bottom-0 h-[2px] group-hover:w-full duration-200"></div>
                </a>
                <a href="collection.php" class="hover:text-mabook-midtone p-2 group relative text-center">
                    Koleksi
                    <div class="absolute bg-mabook-midtone w-0 left-0 bottom-0 h-[2px] group-hover:w-full duration-200"></div>
                </a>
                <a href="favorite.php" class="hover:text-mabook-midtone p-2 group relative text-center">
                    Favoritku
                    <div class="absolute bg-mabook-midtone w-0 left-0 bottom-0 h-[2px] group-hover:w-full duration-200"></div>
                </a>
            </div> <!-- end navbar links -->

            <div>
                <form action="">
                    <div class="flex items-center">
                        <input type="text" class="bg-[#1a120b] p-2 text-mabook-light font-crimson" placeholder="Cari buku, penulis...">
                        <button type="submit" class="text-white bg-mabook-midtone p-2 w-10 duration-200 cursor-pointer hover:bg-mabook-midtone/75">
                            <i class="fas fa-search aspect-square"></i>
                        </button>
                    </div>
                </form>
            </div> <!-- end form -->

            <div class="flex gap-2 items-center justify-center">
                <a href="login.php" class="font-crimson text-mabook-light border border-mabook-light px-3 py-2 text-lg rounded-xl">Login</a>
                <a href="#" class="font-crimson text-mabook-light border border-mabook-light px-3 py-2 text-lg rounded-xl">Register</a>
            </div> <!-- end login buttons -->
        </div>
    </div> <!-- end container -->
</header>