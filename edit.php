<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id='$id'");
$d = mysqli_fetch_array($data);


if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $gambarLama = $_POST['gambarLama'];

    
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama; 
    } else {
       
        $namaFile = $_FILES['gambar']['name'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        $gambar = rand(100,999).'-'.$namaFile;
        move_uploaded_file($tmpName, 'img/' . $gambar);

        
        if (file_exists("img/$gambarLama")) {
            unlink("img/$gambarLama");
        }
    }

    // Update Database
    $query = "UPDATE artikel SET judul='$judul', isi='$isi', gambar='$gambar' WHERE id='$id'";
    mysqli_query($koneksi, $query);

    echo "<script>alert('Data Berhasil Diubah!'); window.location='admin.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning">Edit Data Artikel</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="gambarLama" value="<?php echo $d['gambar']; ?>">

                            <div class="mb-3">
                                <label>Judul Artikel</label>
                                <input type="text" name="judul" class="form-control" value="<?php echo $d['judul']; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label>Isi Informasi</label>
                                <textarea name="isi" class="form-control" rows="5" required><?php echo $d['isi']; ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label>Gambar Saat Ini</label><br>
                                <img src="img/<?php echo $d['gambar']; ?>" width="100" class="mb-2">
                            </div>

                            <div class="mb-3">
                                <label>Ganti Gambar (Kosongkan jika tidak ingin mengganti)</label>
                                <input type="file" name="gambar" class="form-control">
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="admin.php" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>