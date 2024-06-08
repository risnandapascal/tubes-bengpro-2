<?php
session_start();

// Cek apakah pengguna sudah login, jika belum arahkan ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// Konfigurasi database
$servername = "localhost";
$username = "username";  
$password = "password";  
$dbname = "db_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_POST['id'];

$sql = "DELETE FROM pesan WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Pesan berhasil dihapus";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
