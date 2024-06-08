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
    // Redirect ke halaman login atau halaman lainnya
    header("Location: ../index.html");
    exit;
}
?>

<?php
// Konfigurasi database
$servername = "localhost";
$username = "username";  
$password = "password";  
$dbname = "db_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM pesan ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kelola pesan - NebulaNest</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/additional.css">
    <script src="https://kit.fontawesome.com/8255c1cfb8.js" crossorigin="anonymous" defer></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
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
    <div class="container">
        <h1 class="mt-5">Daftar Pesan</h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telpon</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["telpon"] . "</td>";
                        echo "<td>" . $row["pesan"] . "</td>";
                        echo "<td>" . $row["tanggal"] . "</td>";
                        // Tombol hapus
                        echo "<td><button class='btn btn-secondary btn-sm' onclick='hapusPesan(" . $row["id"] . ")'>Hapus</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
        <!-- Bootstrap core JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS -->
        <script src="../js/scripts.js"></script>
        <script>
        function hapusPesan(id) {
            if (confirm("Anda yakin ingin menghapus pesan ini?")) {
                // Kirim permintaan AJAX untuk menghapus pesan
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "hapus_pesan.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        window.location.reload();
                    }
                };
                xhr.send("id=" + id);
            }
        }
        </script>
</body>
</html>

<?php
$conn->close();
?>
