<?php
session_start();
$logoutNotif = isset($_GET['logout']) ? true : false;
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MABOOK | Perpustakaan Digital Dark Academia</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Autumn Dark Academia Color Palette */
            --dark-1: #1A120B;
            /* Darkest Brown */
            --dark-2: #3C2A21;
            /* Dark Brown */
            --dark-3: #5C3D2E;
            /* Medium Brown */
            --accent-1: #B85C38;
            /* Rust/Red */
            --accent-2: #E0C097;
            /* Light Beige */
            --text-light: #F5F5F5;
            --text-dark: #1A120B;
            --paper: #F0E4D4;
            /* Vintage Paper */
            --old-paper: #E7D8C0;
            --olive: #6B8E23;
            /* Olive Green */
            --burgundy: #800020;
            /* Burgundy */
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=UnifrakturMaguntia&display=swap" rel="stylesheet">
</head>

<body>
    <?php if ($logoutNotif): ?>
        <div class="logout-alert">
            Anda telah berhasil keluar dari akun. Sekarang dalam mode tamu.
        </div>
    <?php endif; ?>
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
                    <li><a href="disimpan.php">Koleksi</a></li>
                    <li><a href="#categories">Kategori</a></li>
                    <li><a href="favoritku.php">Favoritku</a></li>
                    <li><a href="aboutUs.php">Tentang Kami</a></li>
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

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section id="home" class="hero">
            <div class="hero-content">
                <h1>MabooK</h1>
                <p>Perpustakaan digital Dark Academia yang menghadirkan koleksi literatur klasik dan kontemporer terbaik. Temukan dunia pengetahuan, fiksi spekulatif, puisi abadi, dan karya-karya pemikiran mendalam dalam genggaman Anda.</p>
                <a href="#collections" class="cta-button">Jelajahi Koleksi</a>
            </div>
        </section>

        <!-- Quote Section -->
        <section class="quote-section">
            <div class="quote-content">
                <p class="quote-text">"Reading is essential for those who seek to rise above the ordinary."</p>
                <p class="quote-author">— Jim Rohn</p>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
            <h2 class="section-title" style="text-align: center; margin-bottom: 2rem; color: var(--accent-2);">Mengapa Memilih MABOOK?</h2>
            <div class="features">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="feature-title">Koleksi Eksklusif</h3>
                    <p class="feature-desc">Ribuan buku digital dari berbagai genre, termasuk literatur klasik, filosofi, sejarah, dan fiksi spekulatif.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-moon"></i>
                    </div>
                    <h3 class="feature-title">Mode Baca Nyaman</h3>
                    <p class="feature-desc">Mode malam dan penyesuaian font untuk pengalaman membaca yang lebih nyaman di segala kondisi.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bookmark"></i>
                    </div>
                    <h3 class="feature-title">Book Tracker</h3>
                    <p class="feature-desc">Lacak buku yang sedang dan akan dibaca dengan sistem yang terorganisir dan personal.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-pen-fancy"></i>
                    </div>
                    <h3 class="feature-title">Catatan Pribadi</h3>
                    <p class="feature-desc">Tambahkan highlight dan catatan pribadi di setiap halaman buku yang Anda baca.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-fire"></i>
                    </div>
                    <h3 class="feature-title">Reading Streak</h3>
                    <p class="feature-desc">Pertahankan kebiasaan membaca dengan sistem streak harian yang memotivasi.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headphones"></i>
                    </div>
                    <h3 class="feature-title">AudioBook</h3>
                    <p class="feature-desc">Nikmati koleksi audio book untuk pengalaman mendengarkan yang imersif (coming soon).</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>Tentang Mabook</h3>
                <ul>
                    <li><a href="#">Visi & Misi</a></li>
                    <li><a href="#">Tim Kami</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Bantuan</h3>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Panduan Penggunaan</a></li>
                    <li><a href="#">Kontak Kami</a></li>
                    <li><a href="#">Laporan Masalah</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Legal</h3>
                <ul>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Lisensi</a></li>
                    <li><a href="#">Kebijakan Hak Cipta</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Terhubung</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                </div>
                <p style="margin-top: 1rem; color: var(--accent-2);">newsletter@MABOOK.com</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 MABOOK. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Profile Dropdown Toggle
        const profileToggle = document.getElementById('profileToggle');
        const profileDropdown = document.getElementById('profileDropdown');

        profileToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            profileDropdown.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            profileDropdown.classList.remove('active');
        });

        // Prevent dropdown from closing when clicking inside it
        profileDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm("Apakah kamu yakin ingin keluar dari akun?")) {
                window.location.href = "logout.php";
            }
        }
    </script>

</body>

</html>