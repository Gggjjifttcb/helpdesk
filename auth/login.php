<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Helpdesk</title>
    <link rel="stylesheet" href="../assets/login.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <h3 class="login-title">Helpdesk Login</h3>
        <p class="login-subtitle">Silakan masuk untuk melanjutkan</p>

        <form action="login_proses.php" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="email@example.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
            <div class="footer-text">
            Belum punya akun?
            <a href="register.php">Daftar sekarang</a>
        </div>

        </form>

        <div class="footer-text">
            © <?= date('Y') ?> Helpdesk System
        </div>
    </div>
</div>

</body>
</html>
