<?php
session_start();

// Cek apakah pengguna sudah login, jika belum arahkan ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// Proses logout jika tombol logout ditekan
if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Business Contact - NebulaNest</title>
        <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/additional.css">
        <script src="https://kit.fontawesome.com/8255c1cfb8.js" crossorigin="anonymous" defer></script>
    </head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <div class="container-fluid px-4">
                <a class="navbar-brand text-black fw-bold" href="index.php">
                    <img src="../assets/icon.png" alt="" style="height: 50px; margin-right: 8px;">
                    NebulaNest
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-black px-3 nav-hover" href="index.php"><b>Plans</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black px-3 nav-hover" href="contact.php"><b>Contact</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black px-3 nav-hover" href="help.php"><b>Help</b></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php
                        // Check if user is logged in
                        if (isset($_SESSION['username'])) {
                            echo '<li class="nav-item dropdown">
                                    <a class="nav-link fw-bold text-primary dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-user"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="post" style="margin: 0;">
                                                <button type="submit" name="logout" class="dropdown-item" style="border: none; background: none; cursor: pointer;">
                                                    Logout <i class="fa-solid fa-right-from-bracket"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>';
                        } else {
                            // If not logged in, display login button
                            echo '<li class="nav-item"><a class="nav-link fw-bold text-primary" href="login.php"><i class="fa-solid fa-user"></i></a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <header class="bg-light content py-5 mt-5">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-lg-8 col-xl-7 col-xxl-6">
                        <div class="my-5 text-center text-xl-start">
                            <h1 class="display-5 fw-bolder mb-2 text-primary">Contact Us</h1>
                            <p class="lead fw-normal text-muted mb-4">Kami di sini untuk membantu Anda. Jangan ragu untuk menghubungi kami jika ada pertanyaan atau kebutuhan yang Anda miliki.</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Contact section -->
        <section class="content py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="fw-bolder mb-2 text-center text-primary"><i class="fa-solid fa-envelope"></i></h1>
                        <h2 class="fw-bolder mb-2 text-center text-primary">Kirim Pesan</h2>
                        <p class="lead fw-normal mb-5 text-center text-muted">Kami ingin mendengar pendapat Anda</p>
                        <form action="../contact_us/submit_message.php" method="post">
                            <div class="text-muted form-floating mb-3">
                                <input class="form-control" style="background-color: #fffbfc;" id="name" name="name" type="text" placeholder="Enter your name..." required>
                                <label for="name">Nama lengkap</label>
                            </div>
                            <div class="text-muted form-floating mb-3">
                                <input class="form-control" style="background-color: #fffbfc" id="email" name="email" type="email" placeholder="name@example.com" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="text-muted form-floating mb-3">
                                <input class="form-control" style="background-color: #fffbfc;" id="phone" name="phone" type="tel" placeholder="(123) 456-7890" required>
                                <label for="phone">No. Telpon</label>
                            </div>
                            <div class="text-muted form-floating mb-3">
                                <textarea class="form-control" id="message" name="message" type="text" placeholder="Enter your message here..." style="height: 10rem; background-color: #fffbfc;" required></textarea>
                                <label for="message">Pesan</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-secondary bg-gradient fw-bold" type="submit" style="border-radius: 15px;">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-5" style="background-color: #fff4f5;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a class="navbar-brand text-black fw-bold fs-5" href="index.php"><img src="../assets/icon.png" alt="" style="border-radius: 60%; height: 50px; margin-right: 10px;">NebulaNest</a>
                    <p class="text-black mt-2 mb-0 fw-bold">Your data, anywhere, anytime.</p>
                    <p class="text-muted mt-1" style="font-size: small;">NebulaNest &copy; 2024</p>
                </div>
                <div class="col-md-2">
                    <h5 class="fw-bold mb-3 text-primary">Produk</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="footer-links">Plans</a></li>
                        <li><a href="index.php" class="footer-links">Professional</a></li>
                        <li><a href="index.php" class="footer-links">Enterprise</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5 class="fw-bold mb-3 text-primary">Dukungan</h5>
                    <ul class="list-unstyled">
                        <li><a href="help.php" class="footer-links">Pusat Bantuan</a></li>
                        <li><a href="contact.php" class="footer-links">Hubungi kami</a></li>
                        <li><a href="https://discord.com/" class="footer-links">Forum komunitas</a></li>
                        <li><a href="#" class="footer-links">Privasi & syarat</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5 class="fw-bold mb-3 text-primary">Perusahaan</h5>
                    <ul class="list-unstyled">
                        <li><a href="about.php" class="footer-links">Tentang kami</a></li>
                        <li><a href="https://projects.co.id/" target="_blank" rel="noopener noreferrer" class="footer-links">Pekerjaan</a></li>
                        <li><a href="#" target="_blank" rel="noopener noreferrer" class="footer-links">Hubungan investor</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5 class="fw-bold mb-3 text-primary">Sumber Daya</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://github.com/risnandapascal/server" target="_blank" rel="noopener noreferrer" class="footer-links">Source code</a></li>
                        <li><a href="#" target="_blank" rel="noopener noreferrer" class="footer-links">Mitra Reseller</a></li>
                        <li><a href="https://nextcloud.com/" target="_blank" rel="noopener noreferrer" class="footer-links">Mitra Integrasi</a></li>
                        <li><a href="https://github.com/risnandapascal" target="_blank" rel="noopener noreferrer" class="footer-links">Pengembang</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <button onclick="scrollToTop()" id="scrollBtn" title="Go to top" class="btn btn-outline-light rounded-circle">
            <i class="fa-solid fa-arrow-up"></i>
        </button>
    </footer>
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS -->
    <script src="../js/scripts.js"></script>
</body>
</html>
