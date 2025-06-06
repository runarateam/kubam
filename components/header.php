<!-- Header -->
<header>
    <div id="user-menu">
    </div>
    <div class="header-container">
        <a href="#" class="logo">
            <i class="fas fa-book-open"></i>
            Mabook
        </a>
        <nav>
            <ul>
                <li><a href="dashboard.php">Beranda</a></li>
                <li><a href="#categories">Kategori</a></li>
                <li><a href="disimpan.php">Koleksi</a></li>
                <li><a href="favoritku.php">Favoritku</a></li>
            </ul>
        </nav>

        <div class="search-bar">
            <input type="text" placeholder="Cari buku, penulis...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </div>

        <div class="user-profile" id="profileToggle">
            <?php if (!empty($_SESSION['nama'])): ?>
                <div class="user-profile" id="profileToggle">
                    <div class="profile-pic"></div>
                    <div class="profile-dropdown" id="profileDropdown">
                        <a href="profile.php"><i class="fas fa-user"></i> Profil Saya</a>
                        <a href="#library"><i class="fas fa-book"></i> Perpustakaan</a>
                        <a href="#settings"><i class="fas fa-cog"></i> Pengaturan</a>
                        <a href="#" onclick="confirmLogout(event)"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="auth-buttons">
                    <a href="PemWebProjectAkhir/view/login.php" class="btn-login">Login</a>
                    <a href="PemWebProjectAkhir/view/daftar.php" class="btn-signup">Daftar</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>