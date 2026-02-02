<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Helpdesk</title>
    <link rel="stylesheet" href="../assets/login.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <h3 class="login-title">Registrasi Akun</h3>
        <p class="login-subtitle">Buat akun helpdesk baru</p>

        <form action="register_proses.php" method="POST">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Nama lengkap" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="email@example.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-login">Daftar</button>
        </form>

        <div class="footer-text">
            Sudah punya akun?
            <a href="login.php">Login</a>
        </div>
    </div>
</div>

</body>
</html>
