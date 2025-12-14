<?php
// Pastikan nama file koneksi Anda benar (sesuai yang ada di admin.php tadi)
include 'koneksi.php'; 

// 1. Kita buat password "123" jadi format Hash yang benar
$passwordBaru = password_hash("123", PASSWORD_DEFAULT);

// 2. Kita update user admin di database
$update = mysqli_query($koneksi, "UPDATE users SET password='$passwordBaru' WHERE username='admin'");

if($update) {
    echo "<h1>SUKSES! ✅</h1>";
    echo "Password untuk user <b>admin</b> sudah diubah menjadi: <b>123</b><br>";
    echo "Silakan coba login lagi.";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}
?>