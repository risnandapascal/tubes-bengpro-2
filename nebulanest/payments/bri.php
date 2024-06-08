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

// Proses pembayaran jika form telah diisi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi dan pemrosesan pembayaran
    $package = $_POST['package'];
    $email = $_POST['email'];

    // Tentukan harga berdasarkan paket
    if ($package == 'Pro') {
        $amount = 80000;
    } elseif ($package == 'Enterprise') {
        $amount = 250000;
    } else {
        $amount = 0;
    }

    // Informasi rekening tujuan BRI
    $account_number = '9876543210';
    $account_name = 'Najwa Nabila Loka'; 

    // Buat array data instruksi pembayaran
    $payment_data = [
        'package' => $package,
        'amount' => $amount,
        'email' => $email,
        'account_number' => $account_number,
        'account_name' => $account_name
    ];

    // Mengembalikan data dalam format JSON
    echo json_encode($payment_data);
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Payment - BRI</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/additional.css">
    <script src="https://kit.fontawesome.com/8255c1cfb8.js" crossorigin="anonymous" defer></script>
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigasi -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <div class="container-fluid px-4">
                <a class="navbar-brand text-black fw-bold" href="../home/index.php">
                    <img src="../assets/icon.png" alt="" style="height: 50px; margin-right: 8px;">
                    NebulaNest
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-black px-3 nav-hover" href="../home/index.php"><b>Plans</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black px-3 nav-hover" href="../home/contact.php"><b>Contact</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black px-3 nav-hover" href="../home/help.php"><b>Help</b></a>
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
                                        <li><a class="dropdown-item" href="../home/settings.php">Settings</a></li>
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
        <!-- BRI Payment Form Section -->
        <section class="bg-light py-5" id="bri-payment">
            <div class="container px=5 my-5">
                <div class="text-center mb-5">
                    <img src="assets/bri.png" alt="BRI Payment" class="img-fluid fw-bolder text-primary" style="max-width: 200px;">
                    <p class="lead fw-normal text-muted mb-0">Isi formulir untuk menyelesaikan pembayaran.</p>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-6">
                        <form id="paymentForm">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" required>
                                <label for="inputEmail">Alamat Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="inputPackage" name="package" required>
                                    <option value="" disabled selected>Pilih paket</option>
                                    <option value="Pro">Pro</option>
                                    <option value="Enterprise">Enterprise</option>
                                </select>
                                <label for="inputPackage">Paket</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary btn-lg">Bayar sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Modal Popup untuk Instruksi Pembayaran -->
    <div id="paymentModal" class="modal fade" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Instruksi Pembayaran BRI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="package"></p>
                    <p id="amount"></p>
                    <p id="email"></p>
                    <p id="account_number"></p>
                    <p id="account_name"></p>
                    <p>Setelah melakukan transfer, mohon kirim bukti pembayaran ke email kami.</p>
                </div>
                <div class="modal-footer">
                    <!-- <button onclick="downloadInstructions(paymentData)" class="btn btn-secondary">Unduh Instruksi</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-5" style="background-color: #fff4f5;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <a class="navbar-brand text-black fw-bold fs-5" href="index.php"><img src="../assets/icon.png" alt="" style="border-radius: 60%; height: 50px; margin-right: 10px;">NebulaNest</a>
                    <p class="text-black mt-2 mb-0 fw-bold">Your data, anywhere, anytime.</p>
                    <p class="text-muted mt-1" style="font-size: small;">NebulaNest &copy; 2024</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="fw-bold mb-3 text-primary">Produk</h5>
                    <ul class="list-unstyled">
                        <li><a href="../home/plans.php" class="footer-links">Plans</a></li>
                        <li><a href="#" class="footer-links">Professional</a></li>
                        <li><a href="#" class="footer-links">Enterprise</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="fw-bold mb-3 text-primary">Dukungan</h5>
                    <ul class="list-unstyled">
                        <li><a href="../home/help.php" class="footer-links">Pusat Bantuan</a></li>
                        <li><a href="../home/contact.php" class="footer-links">Hubungi kami</a></li>
                        <li><a href="https://discord.com/" class="footer-links">Forum komunitas</a></li>
                        <li><a href="#" class="footer-links">Privasi & syarat</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="fw-bold mb-3 text-primary">Perusahaan</h5>
                    <ul class="list-unstyled">
                        <li><a href="../home/about.php" class="footer-links">Tentang kami</a></li>
                        <li><a href="#" class="footer-links">Pekerjaan</a></li>
                        <li><a href="#" class="footer-links">Hubungan investor</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="fw-bold mb-3 text-primary">Sumber Daya</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://github.com/orgs/nextcloud/repositories" target="_blank" rel="noopener noreferrer" class="footer-links">Source code</a></li>
                        <li><a href="#" class="footer-links">Mitra Reseller</a></li>
                        <li><a href="#" class="footer-links">Mitra Integrasi</a></li>
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
    <script src="payments.js"></script>
</body>
</html>
