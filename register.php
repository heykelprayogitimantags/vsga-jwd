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
<html>
<head>
    <title>Register - PT. BaliErsada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            display: flex;
            background: #eef1f4;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white text-center">
                <h5>REGISTER</h5>
            </div>
            <div class="card-body">

                <?php if(isset($exist)): ?>
                    <div class="alert alert-warning p-2">
                        Username sudah digunakan!
                    </div>
                <?php endif; ?>

                <?php if(isset($success)): ?>
                    <div class="alert alert-success p-2">
                        Berhasil daftar! Silakan Login
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label>Username Baru</label>
                        <input type="text" name="username" class="form-control" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" name="register" class="btn btn-success w-100">Daftar</button>
                </form>

                <div class="text-center mt-3">
                    Sudah punya akun? <a href="login.php">Login</a>
                </div>
                <div class="text-center mt-2">
                    <a href="index.php">← Kembali ke Home</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
