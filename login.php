<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            header("Location: admin.php");
            exit;
        }
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - PT. BaliErsada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            display: flex;
            background: #f3f4f6;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h5>LOGIN ADMIN</h5>
            </div>
            <div class="card-body">

                <?php if(isset($error)): ?>
                    <div class="alert alert-danger p-2">
                        Username / Password salah!
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
                </form>

                <div class="text-center mt-3">
                    Belum punya akun? <a href="register.php">Daftar</a>
                </div>

                <div class="text-center mt-2">
                    <a href="index.php">← Kembali ke Home</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
