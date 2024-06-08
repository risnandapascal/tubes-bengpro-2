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
    <title>Submit message - NebulaNest</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/additional.css">
    <script src="https://kit.fontawesome.com/8255c1cfb8.js" crossorigin="anonymous" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .back-btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulir Kontak</h2>
        <?php
        // Konfigurasi database
        $servername = "localhost";
        $username = "username";  
        $password = "password";  
        $dbname = "db_name";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            echo '<div class="message error">Koneksi gagal: ' . $conn->connect_error . '</div>';
        } else {
            // Ambil data dari formulir
            $nama = $_POST['name'];
            $email = $_POST['email'];
            $telpon = $_POST['phone'];
            $pesan = $_POST['message'];

            // Validasi data formulir
            if(empty($nama) || empty($email) || empty($telpon) || empty($pesan)) {
                echo '<div class="message error">Harap lengkapi semua bidang formulir!</div>';
            } else {
                // SQL untuk menyimpan pesan
                $sql = "INSERT INTO pesan (nama, email, telpon, pesan) VALUES ('$nama', '$email', '$telpon', '$pesan')";

                if ($conn->query($sql) === TRUE) {
                    echo '<div class="message success">Pesan berhasil dikirim! Kembali ke <a href="../home/index.php">home</a></a></div>';
                } else {
                    echo '<div class="message error">Error: ' . $sql . '<br>' . $conn->error . '</div>';
                }
            }
        }
        $conn->close();
        ?>
    </div>
        <!-- Bootstrap core JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS -->
        <script src="../js/scripts.js"></script>
</body>
</html>
