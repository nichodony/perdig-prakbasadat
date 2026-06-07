<?php
include '../koneksi.php';

$buku = mysqli_query($koneksi, "SELECT * FROM buku");
$total_buku = mysqli_num_rows($buku);

$user = mysqli_query($koneksi, "
SELECT * FROM user WHERE role='user'
");
$total_user = mysqli_num_rows($user);

$peminjaman = mysqli_query($koneksi, "
SELECT * FROM peminjaman
");
$total_peminjaman = mysqli_num_rows($peminjaman);

$dipinjam = mysqli_query($koneksi, "
SELECT * FROM peminjaman
WHERE status='dipinjam'
");
$total_dipinjam = mysqli_num_rows($dipinjam);
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="../style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<div class="wrapper">

    <div class="sidebar">

        <div class="logo">
            <i class="fas fa-book-open"></i>
            PERDIG
        </div>

        <ul class="menu">

            <li class="active">
                <a href="index.php">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="buku.php">
                    <i class="fas fa-book"></i>
                    <span>Data Buku</span>
                </a>
            </li>

            <li>
                <a href="anggota.php">
                    <i class="fas fa-users"></i>
                    <span>Data Anggota</span>
                </a>
            </li>

            <li>
                <a href="peminjaman.php">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Peminjaman</span>
                </a>
            </li>

            <li>
                <a href="kategori.php">
                    <i class="fas fa-tags"></i>
                    <span>Kategori</span>
                </a>
            </li>

            <li>
                <a href="../logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>

    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">

            <h2>Dashboard Admin</h2>

        </div>

        <!-- WELCOME -->
        <div class="welcome-box">

            <h1>Selamat Datang 👋</h1>

            <p>
                Kelola perpustakaan digital dengan mudah.
            </p>

        </div>

        <!-- CARD -->
        <div class="card-container">

            <!-- CARD -->
            <div class="dashboard-card">

                <div class="icon purple">

                    <i class="fas fa-book"></i>

                </div>

                <div class="card-info">

                    <h4>Total Buku</h4>

                    <h2>
                        <?= $total_buku; ?>
                    </h2>

                </div>

            </div>

            <!-- CARD -->
            <div class="dashboard-card">

                <div class="icon green">

                    <i class="fas fa-users"></i>

                </div>

                <div class="card-info">

                    <h4>Total Anggota</h4>

                    <h2>
                        <?= $total_user; ?>
                    </h2>

                </div>

            </div>

            <!-- CARD -->
            <div class="dashboard-card">

                <div class="icon orange">

                    <i class="fas fa-exchange-alt"></i>

                </div>

                <div class="card-info">

                    <h4>Total Peminjaman</h4>

                    <h2>
                        <?= $total_peminjaman; ?>
                    </h2>

                </div>

            </div>

            <!-- CARD -->
            <div class="dashboard-card">

                <div class="icon red">

                    <i class="fas fa-book-reader"></i>

                </div>

                <div class="card-info">

                    <h4>Sedang Dipinjam</h4>

                    <h2>
                        <?= $total_dipinjam; ?>
                    </h2>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>