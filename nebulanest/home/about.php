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
        <title>About the company - NebulaNest</title>
        <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/additional.css">
        <script src="https://kit.fontawesome.com/8255c1cfb8.js" crossorigin="anonymous" defer></script>
    </head>
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
            <!-- Navigasi -->
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
            <!-- Header-->
            <header class="bg-light py-5">
                <div class="container px-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-xxl-6">
                            <div class="text-center my-5">
                                <h1 class="fs-2 fw-bolder text-primary mb-3">Misi kami adalah membawa keamanan dan kemudahan pengelolaan data. </h1>
                                <p class="lead fw-normal text-muted mb-4">Dengan fokus pada keandalan infrastruktur dan kepuasan pengguna, kami bertujuan untuk menjadi mitra yang dapat diandalkan dalam perjalanan digital Anda, mendorong produktivitas, kolaborasi, dan pertumbuhan tanpa batas.</p>
                                <a class="btn btn-secondary btn-lg" href="#scroll-target"><b>Our story</b></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- About section one-->
            <section class="py-5 bg-white" id="scroll-target">
                <div class="container px-5 my-5">
                    <div class="row gx-5 align-items-center">
                        <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="../assets/now.png" alt="..." /></div>
                        <div class="col-lg-6">
                            <h2 class="fw-bolder text-primary">Pendirian kami</h2>
                            <p class="lead fw-normal text-muted mb-2">Didirikan dengan visi untuk membuat penyimpanan digital menjadi sederhana, aman, dan dapat diakses oleh semua orang, perusahaan kami lahir dari keinginan untuk merevolusi cara individu dan bisnis mengelola data mereka.</p>
                            <p class="lead fw-normal text-muted mb-0">Dari awal yang sederhana, kami telah berkembang menjadi penyedia solusi cloud storage terkemuka, yang berdedikasi untuk menawarkan teknologi mutakhir, keandalan yang luar biasa, dan layanan pelanggan yang tak tertandingi.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About section two-->
            <section class="py-5">
                <div class="container px-5 my-5">
                    <div class="row gx-5 align-items-center">
                        <div class="col-lg-6 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="../assets/privacyfirst.png alt="..." /></div>
                        <div class="col-lg-6">
                            <h2 class="fw-bolder text-primary">Pertumbuhan dan seterusnya</h2>
                            <p class="lead fw-normal text-muted mb-2">Kami berkomitmen untuk mendorong pertumbuhan digital Anda sambil menjaga privasi dan keamanan data. Dengan layanan NebulaNest, Anda tidak hanya mendapatkan ruang penyimpanan yang aman dan andal, tetapi juga solusi yang dirancang untuk mendukung perkembangan bisnis Anda ke masa depan.</p>
                            <p class="lead fw-normal text-muted mb-0">Bergabunglah dengan kami dalam perjalanan menuju masa depan yang lebih terhubung, efisien, dan penuh privasi.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Team members section-->
            <section class="py-5 bg-light">
                <div class="container px-5 my-5">
                    <div class="text-center">
                        <h2 class="fw-bolder text-primary">Tim kami</h2>
                        <p class="lead fw-normal text-muted mb-5">Didedikasikan untuk kualitas dan kesuksesan Anda</p>
                    </div>
                    <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
                        <div class="col mb-5">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-4 px-4" src="../assets/people/pascal.jpg" alt="..." />
                                <h5 class="fw-bolder text-primary">Risnanda Candra</h5>
                                <div class="fst-italic text-muted">Chief Technology Officer</div>
                            </div>
                        </div>
                        <div class="col mb-5 mb-5 mb-xl-0">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-4 px-4" src="../assets/people/fasya.jpg" alt="..." />
                                <h5 class="fw-bolder text-primary">Fasya Lavina</h5>
                                <div class="fst-italic text-muted">Director of Operations</div>
                            </div>
                        </div>
                        <div class="col mb-5 mb-5 mb-sm-0">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-4 px-4" src="../assets/people/najwa.jpg" alt="..." />
                                <h5 class="fw-bolder text-primary">Najwa Nabila Loka</h5>
                                <div class="fst-italic text-muted">Product Manager</div>
                            </div>
                        </div>
                        <div class="col mb-5 mb-5 mb-xl-0">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-4 px-4" src="../assets/people/johanes.jpg" alt="..." />
                                <h5 class="fw-bolder text-primary">Johanes Raditya</h5>
                                <div class="fst-italic text-muted">Customer Support Manager</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- Footer-->
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
