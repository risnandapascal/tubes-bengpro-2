<?php
// Proses hanya dilakukan jika ada pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi data
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    $conn = new mysqli('localhost', 'username', 'password', 'db_name');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    if ($password !== $confirm_password) {
        echo "Kata sandi tidak cocok!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Enkripsi kata sandi
        
        // Menggunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            echo "Pendaftaran berhasil!";
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register - NebulaNest</title>
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

        .signup-container {
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

        .signup-container img {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: -60px auto 20px;
            display: block;
            background-color: #fff;
            padding: 5px;
        }

        .signup-container h1 {
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        .signup-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #222;
            color: #fff;
        }

        .signup-container button {
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

        .signup-container button:hover {
            background-color: #de6076;
        }

        .signup-container p {
            margin: 20px 0 25px;
        }

        .signup-container a {
            color: #f47c94;
            text-decoration: none;
        }

        .signup-container a:hover {
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
            .signup-container {
                padding: 15px;
                max-width: 90%;
            }

            .signup-container img {
                width: 60px;
                height: 60px;
            }

            .signup-container h1 {
                font-size: 1.2em;
            }

            .signup-container input, 
            .password-container input {
                padding: 8px;
                font-size: 14px;
            }

            .signup-container button {
                padding: 12px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .signup-container {
                padding: 10px;
                max-width: 100%;
            }

            .signup-container img {
                width: 50px;
                height: 50px;
                margin: -40px auto 10px;
            }

            .signup-container h1 {
                font-size: 1em;
            }

            .signup-container input, 
            .password-container input {
                padding: 6px;
                font-size: 12px;
            }

            .signup-container button {
                padding: 10px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <img id="logo" src="assets/logo.png" alt="Profile Picture">
        <h1>Sign up to NebulaNest</h1>
        <form action="" method="post" id="signup-form">
            <input type="text" name="username" placeholder="Nama Pengguna" required>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Kata Sandi" required>
                <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
            </div>
            <div class="password-container">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Kata Sandi" required>
                <i class="fa-solid fa-eye toggle-password" id="toggleConfirmPassword"></i>
            </div>
            <!-- pesan kesalahan untuk kekuatan kata sandi -->
            <div id="password-strength"></div>
            <button type="submit"><b><i class="fa-solid fa-arrow-right" style="padding-right: 10px;"></i> Sign up</b></button>
            <p>Harap ingat kata sandi, kami tidak menyimpan informasi pengguna dan menghormati privasi Anda.</p>
        </form>
        <p>Sudah punya akun? <a href="login.php">Masuk</a></p>
    </div>
    <script>
        // Validasi kata sandi dan tampilkan kekuatan kata sandi
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('confirm_password');
        const passwordStrength = document.getElementById('password-strength');
        const submitButton = document.querySelector('button[type="submit"]');

        passwordField.addEventListener('input', function () {
            const password = passwordField.value;
            const strength = checkPasswordStrength(password);
            const message = getStrengthMessage(strength);
            passwordStrength.innerHTML = message;
            validateForm();
        });

        function checkPasswordStrength(password) {
            const hasLowerCase = /[a-z]/.test(password);
            const hasUpperCase = /[A-Z]/.test(password);
            const hasDigit = /\d/.test(password);
            const hasSpecialChar = /[@$!%*?&]/.test(password);
            const minLength = password.length >= 8;

            // Hitung kekuatan kata sandi berdasarkan kriteria
            let strength = 0;
            if (hasLowerCase) strength++;
            if (hasUpperCase) strength++;
            if (hasDigit) strength++;
            if (hasSpecialChar) strength++;
            if (minLength) strength++;

            return strength;
        }

        function getStrengthMessage(strength) {
            switch (strength) {
                case 0:
                    return '';
                case 1:
                    return 'Kata sandi lemah';
                case 2:
                    return 'Kata sandi sedang';
                case 3:
                case 4:
                case 5:
                    return 'Kata sandi kuat';
                default:
                    return '';
            }
        }

        function validateForm() {
            const password = passwordField.value;
            const confirmPassword = confirmPasswordField.value;
            const strength = checkPasswordStrength(password);

            if (password !== confirmPassword) {
                confirmPasswordField.setCustomValidity("Kata sandi tidak cocok");
            } else {
                confirmPasswordField.setCustomValidity("");
            }

            // validasi apakah kekuatan kata sandi cukup
            if (strength < 3) {
                submitButton.disabled = true;
            } else {
                submitButton.disabled = false;
            }
        }

        confirmPasswordField.addEventListener('input', function () {
            validateForm();
        });

        // Tambahkan logika untuk menampilkan/menyembunyikan kata sandi
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

        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            togglePasswordVisibility('confirm_password', 'toggleConfirmPassword');
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
