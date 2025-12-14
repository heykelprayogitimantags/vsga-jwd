<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT.BaliErsada - Partner Solusi Digital Terpercaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        /* Modern Glassmorphism Navbar */
        .navbar {
            padding: 20px 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background: transparent;
        }

        .navbar.scrolled {
            padding: 12px 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px) saturate(180%);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar.scrolled .navbar-brand,
        .navbar.scrolled .nav-link {
            color: #1a1a1a !important;
        }

        .navbar.scrolled .nav-link::after {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: white !important;
            letter-spacing: -0.5px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: translateX(5px);
        }

        .brand-logo {
            height: 50px;
            width: auto;
            margin-right: 12px;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .navbar-brand:hover .brand-logo {
            transform: rotate(360deg) scale(1.1);
        }

        .nav-link {
            position: relative;
            padding: 10px 20px !important;
            margin: 0 5px;
            font-weight: 600;
            font-size: 0.95rem;
            color: white !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 8px;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 8px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .nav-link:hover::before,
        .nav-link.active::before {
            opacity: 1;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 50%;
            width: 0;
            height: 2px;
            background: #ffc107;
            transform: translateX(-50%);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 60%;
        }

        .nav-link:hover {
            transform: translateY(-2px);
        }

        .dropdown-menu {
            border: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            border-radius: 16px;
            padding: 15px;
            margin-top: 15px;
            animation: fadeInUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            padding: 12px 18px;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            margin-bottom: 5px;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(8px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-login {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 700;
            color: #000;
            font-size: 0.95rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-login:hover::before {
            opacity: 1;
        }

        .btn-login:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 35px rgba(255, 193, 7, 0.5);
            color: #000;
        }

        .btn-login i,
        .btn-login span {
            position: relative;
            z-index: 1;
        }

        /* Modern Hero Section with Animated Gradient */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0784e9d8 0%, #4dff00ff 100%);
        }

        /* Animated Background Gradient */
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(102, 126, 234, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(118, 75, 162, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(255, 193, 7, 0.2) 0%, transparent 40%);
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -30px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }

        /* Floating Particles */
        .hero::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(2px 2px at 20% 30%, white, transparent),
                radial-gradient(2px 2px at 60% 70%, white, transparent),
                radial-gradient(1px 1px at 50% 50%, white, transparent),
                radial-gradient(1px 1px at 80% 10%, white, transparent),
                radial-gradient(2px 2px at 90% 60%, white, transparent),
                radial-gradient(1px 1px at 33% 80%, white, transparent);
            background-size: 200% 200%;
            opacity: 0.4;
            animation: particlesFloat 20s linear infinite;
        }

        @keyframes particlesFloat {
            0% { background-position: 0% 0%; }
            100% { background-position: 100% 100%; }
        }

        /* Geometric Shapes */
        .geometric-shape {
            position: absolute;
            opacity: 0.1;
            animation: float 20s ease-in-out infinite;
        }

        .shape-1 {
            top: 10%;
            left: 10%;
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #ffc107 0%, transparent 100%);
            border-radius: 50%;
            animation-delay: 0s;
        }

        .shape-2 {
            bottom: 15%;
            right: 10%;
            width: 250px;
            height: 250px;
            background: linear-gradient(135deg, #fff 0%, transparent 100%);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation-delay: 7s;
        }

        .shape-3 {
            top: 50%;
            right: 20%;
            width: 200px;
            height: 200px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        /* Hero Content */
        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            color: white;
            padding: 20px;
            max-width: 900px;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 10px 25px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInDown 1s ease 0.2s backwards;
        }

        .hero h1 {
            font-size: 4.5rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeInUpHero 1s ease 0.4s backwards;
        }

        .hero .lead {
            font-size: 1.4rem;
            font-weight: 400;
            margin-bottom: 40px;
            opacity: 0.95;
            line-height: 1.6;
            animation: fadeInUpHero 1s ease 0.6s backwards;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUpHero 1s ease 0.8s backwards;
        }

        .btn-hero {
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-hero-primary {
            background: white;
            color: #667eea;
            box-shadow: 0 10px 35px rgba(255, 255, 255, 0.3);
        }

        .btn-hero-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 45px rgba(255, 255, 255, 0.4);
            color: #4dff00ff;
        }

        .btn-hero-secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
        }

        .btn-hero-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: white;
            transform: translateY(-5px);
            color: white;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
            z-index: 10;
        }

        .scroll-indicator span {
            display: block;
            width: 30px;
            height: 50px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 25px;
            position: relative;
        }

        .scroll-indicator span::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 50%;
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 50%;
            transform: translateX(-50%);
            animation: scroll 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(10px); }
        }

        @keyframes scroll {
            0% { opacity: 1; top: 10px; }
            100% { opacity: 0; top: 30px; }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUpHero {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Section Styling */
        .section-padding {
            padding: 80px 0;
        }

        /* Card Enhancements */
        .card {
            border: none;
            border-radius: 15px;
            transition: all 0.4s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.1);
        }

        /* Gallery Image */
        .gallery-img {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .gallery-img:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Client Logo */
        .client-logo {
            max-height: 80px;
            width: auto;
            object-fit: contain;
            filter: grayscale(100%);
            opacity: 0.6;
            transition: all 0.3s ease;
        }

        .client-logo:hover {
            filter: grayscale(0%);
            opacity: 1;
            transform: scale(1.15);
        }

        /* Footer Enhanced */
        footer {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }

        footer a:hover {
            color: #ffc107 !important;
        }

        /* Scroll to Top Button */
        #scrollTop {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        #scrollTop:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 3rem;
            }

            .hero .lead {
                font-size: 1.2rem;
            }

            .btn-hero {
                padding: 14px 30px;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .brand-logo {
                height: 40px;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero .lead {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-hero {
                width: 100%;
                max-width: 300px;
            }

            .nav-link {
                padding: 8px 15px !important;
            }
        }
    </style>
</head>

<body>

    <!-- Modern Navbar -->
    <nav class="navbar navbar-expand-lg" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" alt="BaliErsada Logo" class="brand-logo">
                <span>PT. BaliErsada</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-newspaper me-1"></i> Artikel
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            $q_menu = mysqli_query($koneksi, "SELECT * FROM artikel LIMIT 5");
                            while ($menu = mysqli_fetch_array($q_menu)) {
                                echo '<li><a class="dropdown-item" href="#artikel_section"><i class="bi bi-arrow-right-circle me-2"></i>' . $menu['judul'] . '</a></li>';
                            }
                            ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#artikel_section"><i class="bi bi-grid-3x3-gap me-2"></i>Semua Artikel</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="#produk">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="#klien">Klien</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    <li class="nav-item">
                        <a class="btn btn-login ms-3" href="login.php">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            <span>Login</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modern Hero Section -->
    <section id="home" class="hero">
        <!-- Geometric Shapes -->
        <div class="geometric-shape shape-1"></div>
        <div class="geometric-shape shape-2"></div>
        <div class="geometric-shape shape-3"></div>

        <div class="hero-content">
            <div class="hero-badge">
                <i class="bi bi-star-fill me-2"></i>
                Partner Digital Terpercaya #1 di Indonesia
            </div>
            
            <h1>
                Transformasi Digital<br>With PT.BaliErsada
            </h1>
            
            <p class="lead">
                Kami menghadirkan solusi teknologi inovatif untuk membantu bisnis Anda <br class="d-none d-md-block">
                berkembang pesat di era digital modern
            </p>
            
            <div class="hero-buttons">
                <a href="#about" class="btn btn-hero btn-hero-primary">
                    Mulai Sekarang <i class="bi bi-arrow-right ms-2"></i>
                </a>
                <a href="#produk" class="btn btn-hero btn-hero-secondary">
                    <i class="bi bi-play-circle me-2"></i> Lihat Layanan
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <span></span>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-6">
                    <h6 class="text-primary text-uppercase fw-bold mb-2">Tentang Kami</h6>
                    <h2 class="fw-bold display-6 mb-4">Solusi Digital untuk Masa Depan Bisnis Anda</h2>
                    <p class="lead text-secondary mb-4">
                        PT. BaliErsada berdiri pada tahun 2025, hadir sebagai mitra strategis dalam Developer teknologi.
                    </p>
                    <p class="text-muted">
                        Kami bergerak dalam bidang pengembangan website, aplikasi mobile, serta solusi IT modern. Fokus kami adalah membantu bisnis berkembang melalui ekosistem digital yang efektif, efisien, dan terukur.
                    </p>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-4 h-100 bg-white rounded-4">
                        <div class="card-body">
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                                        <i class="bi bi-eye-fill fs-4"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="fw-bold">Visi</h5>
                                    <p class="text-muted mb-0">Menjadi perusahaan teknologi terpercaya di Indonesia yang memimpin inovasi.</p>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                                        <i class="bi bi-rocket-takeoff-fill fs-4"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="fw-bold">Misi</h5>
                                    <p class="text-muted mb-0">Menghadirkan solusi IT unggul dengan kualitas layanan terbaik dan berorientasi pada kepuasan klien.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel Section -->
    <section id="artikel_section" class="section-padding bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold">Berita & Informasi Terkini</h3>
                <p class="text-muted">Update terbaru seputar teknologi dan perusahaan kami</p>
            </div>

            <div class="row">
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY id DESC");
                if (mysqli_num_rows($query) > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img src="img/<?php echo $data['gambar']; ?>" class="card-img-top" alt="<?php echo $data['judul']; ?>">
                                <div class="card-body">
                                    <h5 class="fw-bold"><?php echo $data['judul']; ?></h5>
                                    <p class="text-muted"><?php echo substr($data['isi'], 0, 100); ?>...</p>
                                    <a href="detail.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-primary rounded-pill">
                                        Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='col-12 text-center text-muted'>Belum ada artikel yang diupload admin.</div>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="produk" class="section-padding">
        <div class="container text-center">
            <h3 class="fw-bold">Layanan Kami</h3>
            <p class="text-muted mb-5">Solusi digital terbaik untuk kebutuhan bisnis Anda</p>
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm p-4">
                        <div class="mb-3">
                            <i class="bi bi-code-slash text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="fw-bold">Web Development</h5>
                        <p class="text-muted mt-2">Sebagai Developer Website Profesional, Cepat, Responsif.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm p-4">
                        <div class="mb-3">
                            <i class="bi bi-phone text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="fw-bold">Mobile App</h5>
                        <p class="text-muted mt-2">Sebagai Developer Aplikasi Android & iOS berkualitas profesional.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm p-4">
                        <div class="mb-3">
                            <i class="bi bi-megaphone text-warning" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="fw-bold">Digital Marketing</h5>
                        <p class="text-muted mt-2">Strategi branding dan promosi digital.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="section-padding bg-light">
        <div class="container text-center">
            <h3 class="fw-bold">Galeri Kegiatan Kami</h3>
            <p class="text-muted mb-5">Dokumentasi aktivitas dan pencapaian kami</p>
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <img src="img/kegiatan4.jpg" class="img-fluid rounded shadow-sm gallery-img" alt="Kegiatan 1">
                </div>
                <div class="col-md-4 mb-3">
                    <img src="img/kegiatan2.jpg" class="img-fluid rounded shadow-sm gallery-img" alt="Kegiatan 2">
                </div>
                <div class="col-md-4 mb-3">
                    <img src="img/kegiatan3.jpg" class="img-fluid rounded shadow-sm gallery-img" alt="Kegiatan 3">
                </div>
            </div>
        </div>
    </section>

    <!-- Klien Section -->
    <section id="klien" class="section-padding">
        <div class="container text-center">
            <h3 class="fw-bold">Klien Kami</h3>
            <p class="text-muted mb-5">Dipercaya oleh berbagai perusahaan terkemuka</p>

            <div class="row align-items-center justify-content-center gy-4">
                <div class="col-6 col-md-3">
                    <img src="img/klien1.png" class="img-fluid client-logo" alt="Klien 1">
                </div>
                <div class="col-6 col-md-3">
                    <img src="img/klien2.png" class="img-fluid client-logo" alt="Klien 2">
                </div>
                <div class="col-6 col-md-3">
                    <img src="img/klien3.png" class="img-fluid client-logo" alt="Klien 3">
                </div>
                <div class="col-6 col-md-3">
                    <img src="img/klien4.png" class="img-fluid client-logo" alt="Klien 4">
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="section-padding bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold">Hubungi Kami</h3>
                <p class="text-muted">Kami siap membantu kebutuhan bisnis Anda 24/7</p>
                <div style="width: 60px; height: 3px; background: #0d6efd; margin: 0 auto;"></div>
            </div>

            <div class="row align-items-center shadow-sm bg-white rounded overflow-hidden">
                <div class="col-md-5 p-5">
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary text-white rounded-circle p-3 me-3">
                            <i class="bi bi-geo-alt-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Alamat Kantor</h5>
                            <p class="text-muted mb-0">Jl. Dr. Cipto No.88<br>Lubuk Pakam, Sumatera Utara</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary text-white rounded-circle p-3 me-3">
                            <i class="bi bi-envelope-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Email Resmi</h5>
                            <p class="text-muted mb-0">info@baliersada.com<br>support@baliersada.com</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="bg-primary text-white rounded-circle p-3 me-3">
                            <i class="bi bi-telephone-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Telepon / WhatsApp</h5>
                            <p class="text-muted mb-0">+62 878-2227-4814</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 p-0">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.126767666277!2d98.8741!3d3.5586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031481111111111%3A0x1111111111111111!2sLubuk%20Pakam!5e0!3m2!1sid!2sid!4v1699999999999!5m2!1sid!2sid"
                        width="100%"
                        height="400"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold text-warning mb-3">PT. BaliErsada</h5>
                    <p class="text-secondary">
                        Mitra teknologi terpercaya Anda. Kami menghadirkan solusi digital inovatif untuk membantu bisnis Anda tumbuh lebih cepat di era modern.
                    </p>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold mb-3">Navigasi Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home" class="text-secondary text-decoration-none"><i class="bi bi-chevron-right"></i> Home</a></li>
                        <li class="mb-2"><a href="#about" class="text-secondary text-decoration-none"><i class="bi bi-chevron-right"></i> Tentang Kami</a></li>
                        <li class="mb-2"><a href="#produk" class="text-secondary text-decoration-none"><i class="bi bi-chevron-right"></i> Layanan</a></li>
                        <li class="mb-2"><a href="#kontak" class="text-secondary text-decoration-none"><i class="bi bi-chevron-right"></i> Hubungi Kami</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold mb-3">Ikuti Kami</h5>
                    <p class="text-secondary">Dapatkan update terbaru melalui sosial media kami:</p>
                    <div class="d-flex gap-3">
                        <a href="https://www.facebook.com/profile.php?id=1000..." target="_blank" class="text-white fs-4" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/baliersada_official" target="_blank" class="text-white fs-4" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/heykel-ginting" target="_blank" class="text-white fs-4" title="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="https://www.youtube.com/@baliersada" target="_blank" class="text-white fs-4" title="YouTube">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr class="border-secondary my-4">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <small class="text-secondary">&copy; 2025 <strong>PT. BaliErsada</strong>. All Rights Reserved.</small>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <small class="text-secondary">Designed with <i class="bi bi-heart-fill text-danger"></i> by <strong>Heykel Ginting Suka</strong></small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollTop" onclick="scrollToTop()">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNav');
            const scrollTop = document.getElementById('scrollTop');
            
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
                scrollTop.style.display = 'flex';
            } else {
                navbar.classList.remove('scrolled');
                scrollTop.style.display = 'none';
            }
        });

        // Scroll to top function
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Active nav link on scroll
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

</body>

</html>