<?php
session_start();

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $conn = new mysqli('localhost', 'username', 'password', 'db_name');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Cari pengguna di database berdasarkan username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: home/index.php");
            exit();
        } else {
            $login_error = "Kata sandi salah!";
        }
    } else {
        $login_error = "Nama pengguna tidak ditemukan!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - NebulaNest</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8255c1cfb8.js" crossorigin="anonymous" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('assets/wallpaper2.jpg'); 
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            opacity: 0;
            animation: fadeIn 2s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .login-container {
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

        .login-container img {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: -60px auto 20px;
            display: block;
            background-color: #fff;
            padding: 5px;
        }

        .login-container h1 {
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        .login-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #222;
            color: #fff;
        }

        .login-container button {
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

        .login-container button:hover {
            background-color: #de6076;
        }

        .login-container p {
            margin: 20px 0 25px;
        }

        .login-container a {
            color: #f47c94;
            text-decoration: none;
        }

        .login-container a:hover {
            color: #de6076;
            text-decoration: underline;
        }

        .password-container {
            position: relative;
            width: 100%;
        }

        .password-container input {
            width: calc(100% - 20px); 
        }

        .password-container .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #ccc;
        }

        #logo {
            cursor: pointer;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .login-container {
                padding: 15px;
                max-width: 90%;
            }

            .login-container img {
                width: 60px;
                height: 60px;
            }

            .login-container h1 {
                font-size: 1.2em;
            }

            .login-container input, 
            .password-container input {
                padding: 8px;
                font-size: 14px;
            }

            .login-container button {
                padding: 12px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 10px;
                max-width: 100%;
            }

            .login-container img {
                width: 50px;
                height: 50px;
                margin: -40px auto 10px;
            }

            .login-container h1 {
                font-size: 1em;
            }

            .login-container input, 
            .password-container input {
                padding: 6px;
                font-size: 12px;
            }

            .login-container button {
                padding: 10px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img id="logo" src="assets/logo.png" alt="Profile Picture">
        <h1>Login to NebulaNest</h1>
        <?php if (isset($login_error)) echo "<p style='color: red;'>$login_error</p>"; ?>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Nama Pengguna" required>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Kata Sandi" required>
                <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
            </div>
            <button type="submit"><b><i class="fa-solid fa-arrow-right" style="padding-right: 10px;"></i> Login</b></button>
        </form>
        <p>Belum punya akun? <a href="signup.php">Daftar</a></p>
    </div>
    <script>
        function togglePasswordVisibility(passwordFieldId, toggleIconId) {
            const passwordField = document.getElementById(passwordFieldId);
            const toggleIcon = document.getElementById(toggleIconId);
            const isPasswordVisible = passwordField.getAttribute('type') === 'password';
            passwordField.setAttribute('type', isPasswordVisible ? 'text' : 'password');
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        }

        document.getElementById('togglePassword').addEventListener('click', function () {
            togglePasswordVisibility('password', 'togglePassword');
        });

        const logo = document.getElementById('logo');

        function redirectToIndex() {
            window.location.href = 'index.html';
        }

        logo.addEventListener('mouseenter', function() {
            logo.style.cursor = "pointer";
        });

        logo.addEventListener('mouseleave', function() {
            logo.style.cursor = "default";
        });

        logo.addEventListener('click', redirectToIndex);
    </script>
</body>
</html>
