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
        <title>NebulaNest Help Center</title>
        <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/additional.css">
        <script src="https://kit.fontawesome.com/8255c1cfb8.js" crossorigin="anonymous" defer></script>
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Navigation-->
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
            <!-- Page Content-->
            <section class="bg-light py-5">
                <div class="container px-5 my-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder text-primary">Pusat Bantuan</h1>
                        <p class="lead fw-normal text-muted mb-0">Bagaimana kami dapat membantu Anda?</p>
                    </div>
                    <div class="row gx-5">
                        <div class="col-xl-8">
                            <!-- FAQ Accordion 1-->
                            <h2 class="fw-bolder text-primary mb-3">Rekening & Penagihan</h2>
                            <div class="accordion mb-5" id="accordionExample">
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Bagaimana cara membuat akun?</button></h3>
                                    <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>Cara membuat akun sangatlah mudah.</strong> Anda hanya perlu mengunjungi halaman registrasi kami, dan ikuti langkah-langkah yang ada di sana untuk membuat akun baru.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Apa kebijakan pembayaran yang berlaku?</button></h3>
                                    <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>Kami menerima pembayaran melalui berbagai metode.</strong> Detail kebijakan pembayaran lengkap dapat ditemukan di halaman pembayaran kami.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Bagaimana cara membatalkan langganan?</button></h3>
                                    <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>Anda dapat membatalkan langganan kapan saja.</strong> Hubungi Customer Support kami untuk membatalkan langganan.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Accordion 2-->
                            <h2 class="fw-bolder text-primary mb-3">Masalah Situs Web</h2>
                            <div class="accordion mb-5 mb-xl-0" id="accordionExample2">
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">Bagaimana cara melaporkan masalah pada website?</button></h3>
                                    <div class="accordion-collapse collapse show" id="collapseOne2" aria-labelledby="headingOne" data-bs-parent="#accordionExample2">
                                        <div class="accordion-body">
                                            <strong>Anda dapat melaporkan masalah dengan menghubungi tim dukungan kami.</strong> Silakan kirimkan detail masalah yang Anda alami melalui forum komunitas untuk diskusi.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">Apakah ada panduan troubleshooting?</button></h3>
                                    <div class="accordion-collapse collapse" id="collapseTwo2" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
                                        <div class="accordion-body">
                                            <strong>Kami menyediakan panduan troubleshooting lengkap untuk membantu Anda.</strong> Anda dapat menemukan panduan tersebut di komunitas kami.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree2" aria-expanded="false" aria-controls="collapseThree2">Apakah website mengalami pemeliharaan rutin?</button></h3>
                                    <div class="accordion-collapse collapse" id="collapseThree2" aria-labelledby="headingThree" data-bs-parent="#accordionExample2">
                                        <div class="accordion-body">
                                            <strong>Ya, kami melakukan pemeliharaan rutin untuk meningkatkan kinerja dan keamanan website kami.</strong> Biasanya, pemeliharaan dilakukan pada jam-jam dengan lalu lintas pengguna yang rendah.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card border-0 bg-white mt-xl-5">
                                <div class="card-body p-4 py-lg-5">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="text-center">
                                            <div class="h6 fw-bolder text-primary">Ada pertanyaan lain?</div>
                                            <p class="text-muted mb-4">
                                                Hubungi kami di
                                                <br />
                                                <a href="#!">support@nebulanest.com</a>
                                            </p>
                                            <div class="h6 fw-bolder text-primary">Ikuti kami</div>
                                            <a class="fs-5 px-2 link-secondary" href="https://discord.com/"><i class="bi-discord"></i></a>
                                            <a class="fs-5 px-2 link-secondary" href="https://instagram.com/"><i class="bi-instagram"></i></a>
                                            <a class="fs-5 px-2 link-secondary" href="https://linkedin.com/"><i class="bi-linkedin"></i></a>
                                            <a class="fs-5 px-2 link-secondary" href="https://t.me/"><i class="bi-telegram"></i></a>
                                        </div>
                                    </div>
                                </div>
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
