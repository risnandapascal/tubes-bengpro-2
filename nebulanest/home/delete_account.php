<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Proses hanya dilakukan jika ada pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];

    $password = htmlspecialchars($_POST['password']);

    $conn = new mysqli('localhost', 'username', 'password', 'db_name');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Periksa apakah kata sandi yang dimasukkan cocok dengan yang tersimpan di database
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];

    if (password_verify($password, $stored_password)) {
        // Kata sandi cocok, hapus akun pengguna dari database
        $delete_stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
        $delete_stmt->bind_param("s", $username);
        if ($delete_stmt->execute()) {
            // Akun berhasil dihapus, hapus juga sesi dan redirect ke halaman login
            session_unset();
            session_destroy();
            echo "Akun berhasil dihapus!";
            header("Location: ../index.html");
            exit();
        } else {
            echo "Error: " . $delete_stmt->error;
        }
    } else {
        echo "Kata sandi salah!";
    }

    $stmt->close();
    $delete_stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Delete Account - NebulaNest</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8255c1cfb8.js" crossorigin="anonymous" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../assets/wallpaper2.jpg'); 
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .delete-account-container {
            background-color: rgba(50, 50, 50, 0.8); 
            padding: 20px;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
            max-width: 400px; 
            width: 90%;
            text-align: center;
            color: #fff;
            backdrop-filter: blur(5px); 
            -webkit-backdrop-filter: blur(10px);
            position: relative;
        }

        .delete-account-container h1 {
            margin-bottom: 20px;
            font-size: 1.5em;
        }
        .delete-account-container img {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: -60px auto 20px;
            display: block;
            background-color: #fff;
            padding: 5px;
        }

        .delete-account-container p {
            margin: 20px 0 25px;
        }

        .delete-account-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #222;
            color: #fff;
        }

        .delete-account-container button {
            width: 100%;
            padding: 15px;
            background-color: #f47c94;
            border: none;
            border-radius: 30px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .delete-account-container button:hover {
            background-color: #de6076;
        }

        .delete-account-container a {
            color: #f47c94;
            text-decoration: none;
        }

        .delete-account-container a:hover {
            color: #de6076;
            text-decoration: underline;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .delete-account-container {
                padding: 15px;
                max-width: 90%;
            }
        }

        @media (max-width: 480px) {
            .delete-account-container {
                padding: 10px;
                max-width: 100%;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("delete-account-button").addEventListener("click", function(event) {
                event.preventDefault();
                var myModal = new bootstrap.Modal(document.getElementById('confirmModal'), {
                    keyboard: false
                });
                myModal.show();
            });

            document.getElementById("confirm-delete-button").addEventListener("click", function() {
                document.getElementById("delete-account-form").submit();
            });
        });
    </script>
</head>
<body>
    <div class="delete-account-container">
        <img id="logo" src="../assets/logo.png" alt="Profile Picture">
        <h1>Hapus Akun</h1>
        <form action="" method="post" id="delete-account-form">
            <p>Untuk menghapus akun, konfirmasikan dengan memasukkan kata sandi Anda.</p>
            <input type="password" name="password" placeholder="Masukkan Kata Sandi" required>
            <button type="submit" id="delete-account-button"><b>Hapus Akun</b></button>
        </form>
        <p><a href="index.php">Kembali ke Profil</a></p>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="confirm-delete-button" class="btn btn-danger">Hapus Akun</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
