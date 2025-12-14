<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id='$id'");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "<script>alert('Artikel tidak ditemukan!');window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['judul']; ?> - PT. BaliErsada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f8f9fa;
        }

        .article-img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
            text-align: justify;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">PT. BaliErsada</a>
            <a href="index.php" class="btn btn-outline-light btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Home
            </a>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1 class="fw-bold mb-3"><?php echo $data['judul']; ?></h1>

                <p class="text-muted mb-4">
                    <i class="bi bi-person-fill"></i> Admin &nbsp; | &nbsp;
                    <i class="bi bi-folder-fill"></i> Informasi Teknologi
                </p>

                <img src="img/<?php echo $data['gambar']; ?>" class="img-fluid article-img mb-4" alt="<?php echo $data['judul']; ?>">

                <div class="bg-white p-4 rounded shadow-sm">
                    <div class="content-text">
                        <?php

                        echo nl2br($data['isi']);
                        ?>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="index.php#artikel_section" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Lihat Artikel Lainnya
                    </a>
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <small>&copy; 2025 PT.BaliErsada — By Heykel Ginting Suka</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>