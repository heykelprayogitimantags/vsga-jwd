<?php
    session_start();
    include 'koneksi.php';

    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    }

    if (isset($_POST['upload'])) {
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $namaFile = $_FILES['gambar']['name'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        $namaBaru = rand(100, 999) . '-' . $namaFile;
        move_uploaded_file($tmpName, 'img/' . $namaBaru);
        $query = "INSERT INTO artikel (judul, isi, gambar) VALUES ('$judul', '$isi', '$namaBaru')";
        mysqli_query($koneksi, $query);
        echo "<script>alert('Data Berhasil Diupload!'); window.location='admin.php';</script>";
    }

    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        $data = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id = '$id'");
        $row = mysqli_fetch_array($data);
        $gambarLama = $row['gambar'];
        if (file_exists("img/$gambarLama")) {
            unlink("img/$gambarLama");
        }
        mysqli_query($koneksi, "DELETE FROM artikel WHERE id = '$id'");
        echo "<script>alert('Data Berhasil Dihapus!'); window.location='admin.php';</script>";
    }

    $totalArtikel = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM artikel"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BaliErsada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            padding: 24px 0;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 0 24px 24px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 24px;
        }

        .sidebar-brand h4 {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand i {
            color: #3b82f6;
            font-size: 24px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0 16px;
        }

        .sidebar-menu li {
            margin-bottom: 4px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #64748b;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 14px;
            font-weight: 500;
        }

        .sidebar-menu a:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .sidebar-menu a.active {
            background: #eff6ff;
            color: #3b82f6;
        }

        .sidebar-menu i {
            font-size: 20px;
            width: 20px;
        }

        .user-profile {
            position: absolute;
            bottom: 80px;
            left: 16px;
            right: 16px;
            background: #f8fafc;
            padding: 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 16px;
        }

        .user-info h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
        }

        .user-info p {
            margin: 0;
            font-size: 12px;
            color: #64748b;
        }

        .sidebar-logout {
            position: absolute;
            bottom: 16px;
            left: 16px;
            right: 16px;
        }

        .btn-logout {
            width: 100%;
            padding: 12px;
            background: #fee2e2;
            color: #dc2626;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: #fecaca;
            color: #dc2626;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 32px;
            min-height: 100vh;
        }

        /* Header */
        .page-header {
            margin-bottom: 32px;
        }

        .page-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .page-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            transition: all 0.2s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            transform: translateY(-2px);
        }

        .stat-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.blue {
            background: #dbeafe;
            color: #3b82f6;
        }

        .stat-icon.purple {
            background: #ede9fe;
            color: #8b5cf6;
        }

        .stat-icon.green {
            background: #d1fae5;
            color: #10b981;
        }

        .stat-content h3 {
            font-size: 32px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .stat-content p {
            font-size: 14px;
            color: #64748b;
            margin: 4px 0 0;
        }

        /* Card */
        .card-modern {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .card-header-modern {
            padding: 20px 24px;
            border-bottom: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .card-header-modern h5 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-body-modern {
            padding: 24px;
        }

        /* Form */
        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .form-control-modern {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-control-modern:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .btn-primary-modern {
            background: #3b82f6;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-primary-modern:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.4);
        }

        /* Table */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 8px;
        }

        .table-modern {
            width: 100%;
            margin: 0;
        }

        .table-modern thead {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .table-modern thead th {
            padding: 12px 16px;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: none;
        }

        .table-modern tbody td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
            font-size: 14px;
        }

        .table-modern tbody tr:hover {
            background: #f8fafc;
        }

        .article-img {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 8px;
        }

        .article-title {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .article-excerpt {
            font-size: 13px;
            color: #64748b;
        }

        /* Action Buttons */
        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-edit {
            background: #dbeafe;
            color: #2563eb;
        }

        .btn-edit:hover {
            background: #bfdbfe;
            color: #1d4ed8;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #fecaca;
            color: #b91c1c;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 64px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }

        .empty-state h4 {
            font-size: 18px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h4>
                <i class="bi bi-hexagon-fill"></i>
                BaliErsada
            </h4>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="admin.php" class="active">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#artikel">
                    <i class="bi bi-file-text-fill"></i>
                    <span>Artikel</span>
                </a>
            </li>
        </ul>

        <div class="user-profile">
            <div class="user-avatar">
                <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
            </div>
            <div class="user-info">
                <h6><?php echo $_SESSION['username']; ?></h6>
                <p>Administrator</p>
            </div>
        </div>

        <div class="sidebar-logout">
            <a href="logout.php" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i>
                Keluar
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h2>Dashboard</h2>
            <p>Selamat datang kembali, <?php echo $_SESSION['username']; ?>!</p>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon blue">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $totalArtikel; ?></h3>
                        <p>Total Artikel</p>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="bi bi-eye"></i>
                </div>
                <div class="stat-content">
                    <h3>-</h3>
                    <p>Total Views</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="stat-content">
                    <h3>-</h3>
                    <p>Engagement</p>
                </div>
            </div>
        </div>

        <!-- Upload Form -->
        <div class="card-modern">
            <div class="card-header-modern">
                <h5>
                    <i class="bi bi-plus-circle"></i>
                    Upload Artikel Baru
                </h5>
            </div>
            <div class="card-body-modern">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Judul Artikel</label>
                            <input type="text" name="judul" class="form-control form-control-modern" required placeholder="Masukkan judul artikel">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" name="gambar" class="form-control form-control-modern" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konten Artikel</label>
                        <textarea name="isi" class="form-control form-control-modern" rows="5" required placeholder="Tulis konten artikel..."></textarea>
                    </div>
                    <button type="submit" name="upload" class="btn-primary-modern">
                        <i class="bi bi-upload"></i>
                        Upload Artikel
                    </button>
                </form>
            </div>
        </div>

        <!-- Articles Table -->
        <div class="card-modern">
            <div class="card-header-modern">
                <h5>
                    <i class="bi bi-list-ul"></i>
                    Daftar Artikel
                </h5>
            </div>
            <div class="table-wrapper">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Artikel</th>
                            <th style="width: 100px;">Gambar</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $data = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY id DESC");
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>
                                <div class="article-title"><?php echo $d['judul']; ?></div>
                                <div class="article-excerpt"><?php echo substr($d['isi'], 0, 80); ?>...</div>
                            </td>
                            <td>
                                <img src="img/<?php echo $d['gambar']; ?>" class="article-img" alt="<?php echo $d['judul']; ?>">
                            </td>
                            <td>
                                <a href="edit.php?id=<?php echo $d['id']; ?>" class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="admin.php?hapus=<?php echo $d['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>