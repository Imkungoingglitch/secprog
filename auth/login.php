<?php
/**
 * IT Helpdesk - Login
 *
 * TODO:
 *  - Form login (email/username + password)
 *  - Verifikasi password dengan password_verify()
 *  - Regenerasi session ID setelah login berhasil
 *  - Proteksi CSRF & batasi percobaan login (brute force)
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | IT Helpdesk</title>

    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

    <div class="login-container">

        <div class="logo">
            <h1>HelpDesk+</h1>
            <p>IT Support Made Simple</p>
        </div>

        <h2>Welcome Back!</h2>
        <p class="subtitle">Sign in to continue to your account.</p>

        <form method="POST">

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <a href="forgot-password.php" class="forgot-password">
                Forgot Password?
            </a>

            <button type="submit" class="login-button">
                Sign In
            </button>

        </form>

        <p class="register-text">
            Don't have an account?
            <a href="register.php">Register</a>
        </p>

    </div>

</body>
</html>