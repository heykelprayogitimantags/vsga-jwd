<?php
session_start();
include 'koneksi.php';

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $exist = true;
    } else {
        mysqli_query($koneksi, "INSERT INTO users VALUES(NULL,'$username','$password')");
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PT. BaliErsada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3b9dd4 0%, #5ec99f 100%);
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background circles */
        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            top: -250px;
            right: -250px;
            animation: float 6s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            bottom: -150px;
            left: -150px;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(20px); }
        }

        .register-container {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 1;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            background: linear-gradient(135deg, #3b9dd4 0%, #5ec99f 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .logo-img {
            max-width: 180px;
            max-height: 100px;
            width: auto;
            height: auto;
            object-fit: contain;
            margin-bottom: 20px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .register-header h4 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .register-header p {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
        }

        .register-body {
            padding: 40px 35px;
        }

        .alert-modern {
            border-radius: 12px;
            border: none;
            padding: 12px 16px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-modern i {
            font-size: 20px;
        }

        .alert-warning {
            background: #fff3cd;
            color: #856404;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .input-group-modern {
            position: relative;
        }

        .input-group-modern i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            z-index: 2;
        }

        .form-control-modern {
            width: 100%;
            padding: 14px 16px 14px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: #3b9dd4;
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 157, 212, 0.1);
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            z-index: 2;
        }

        .password-toggle:hover {
            color: #3b9dd4;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #3b9dd4 0%, #5ec99f 100%);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 157, 212, 0.4);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 157, 212, 0.5);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #999;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        .footer-links {
            text-align: center;
        }

        .footer-links a {
            color: #3b9dd4;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: #5ec99f;
            text-decoration: underline;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #3b9dd4;
            transform: translateX(-3px);
        }

        /* Responsive */
        @media (max-width: 576px) {
            .register-container {
                max-width: 100%;
            }

            .register-header {
                padding: 30px 20px;
            }

            .register-header h4 {
                font-size: 24px;
            }

            .logo-img {
                max-width: 140px;
                max-height: 80px;
            }

            .register-body {
                padding: 30px 25px;
            }

            body::before,
            body::after {
                display: none;
            }
        }

        /* Loading state */
        .btn-register.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-register.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border: 2px solid white;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            margin-left: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .password-strength {
            margin-top: 8px;
            font-size: 12px;
        }

        .strength-bar {
            height: 4px;
            border-radius: 2px;
            background: #e0e0e0;
            margin-top: 5px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { width: 33%; background: #dc3545; }
        .strength-medium { width: 66%; background: #ffc107; }
        .strength-strong { width: 100%; background: #28a745; }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <img src="img/logo.png" alt="Logo.png" class="logo-img">
                <h4>Daftar Akun</h4>
                <p>PT. BaliErsada - Admin Portal</p>
            </div>

            <div class="register-body">
                <?php if(isset($exist)): ?>
                    <div class="alert alert-warning alert-modern">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Username sudah digunakan! Silakan pilih username lain.</span>
                    </div>
                <?php endif; ?>

                <?php if(isset($success)): ?>
                    <div class="alert alert-success alert-modern">
                        <i class="fas fa-check-circle"></i>
                        <span>Berhasil daftar! Silakan <a href="login.php">Login</a> sekarang.</span>
                    </div>
                <?php endif; ?>

                <form method="POST" id="registerForm">
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <div class="input-group-modern">
                            <i class="fas fa-user"></i>
                            <input type="text" 
                                   name="username" 
                                   id="username"
                                   class="form-control-modern" 
                                   placeholder="Pilih username Anda"
                                   required 
                                   autocomplete="off"
                                   minlength="4">
                        </div>
                        <small class="text-muted" style="font-size: 12px; margin-top: 5px; display: block;">
                            Minimal 4 karakter
                        </small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="input-group-modern">
                            <i class="fas fa-lock"></i>
                            <input type="password" 
                                   name="password" 
                                   id="passwordField"
                                   class="form-control-modern" 
                                   placeholder="Buat password yang kuat"
                                   required
                                   minlength="6">
                            <i class="fas fa-eye password-toggle" 
                               id="togglePassword"
                               onclick="togglePassword()"></i>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar">
                                <div class="strength-fill" id="strengthFill"></div>
                            </div>
                            <small id="strengthText" style="color: #999;">Minimal 6 karakter</small>
                        </div>
                    </div>

                    <button type="submit" name="register" class="btn-register" id="registerBtn">
                        <i class="fas fa-user-plus"></i> Daftar Sekarang
                    </button>
                </form>

                <div class="divider">
                    <span>atau</span>
                </div>

                <div class="footer-links">
                    <p style="margin-bottom: 10px; color: #666;">
                        Sudah punya akun? <a href="login.php">Login di sini</a>
                    </p>
                    <a href="index.php" class="back-link">
                        <i class="fas fa-arrow-left"></i> Kembali ke Home
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordField = document.getElementById('passwordField');
            const toggleIcon = document.getElementById('togglePassword');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Password strength checker
        const passwordField = document.getElementById('passwordField');
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');

        passwordField.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;

            if (password.length >= 6) strength++;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;

            strengthFill.className = 'strength-fill';
            
            if (strength <= 2) {
                strengthFill.classList.add('strength-weak');
                strengthText.textContent = 'Lemah';
                strengthText.style.color = '#dc3545';
            } else if (strength <= 3) {
                strengthFill.classList.add('strength-medium');
                strengthText.textContent = 'Sedang';
                strengthText.style.color = '#ffc107';
            } else {
                strengthFill.classList.add('strength-strong');
                strengthText.textContent = 'Kuat';
                strengthText.style.color = '#28a745';
            }
        });

        // Add loading state on form submit
        document.getElementById('registerForm').addEventListener('submit', function() {
            const btn = document.getElementById('registerBtn');
            btn.classList.add('loading');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        });

        // Auto-focus on first input
        window.addEventListener('load', function() {
            document.getElementById('username').focus();
        });
    </script>
</body>
</html>