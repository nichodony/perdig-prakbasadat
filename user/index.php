<?php

session_start();

if(!isset($_SESSION['role'])){
    header("Location: ../login-user.php");
    exit();
}

include '../koneksi.php';

/* TOTAL BUKU */

$buku = mysqli_query($koneksi,"
SELECT * FROM buku
");

$total_buku = mysqli_num_rows($buku);

/* TOTAL PINJAMAN */

$id_user = $_SESSION['id_user'];

/* TOTAL KATEGORI */

$kategori = mysqli_query($koneksi,"
SELECT * FROM kategori
");

$total_kategori = mysqli_num_rows($kategori);

/* DIPINJAM */

$dipinjam = mysqli_query($koneksi,"

SELECT *
FROM peminjaman

WHERE id_user='$id_user'
AND status='dipinjam'

");

$total_dipinjam = mysqli_num_rows($dipinjam);

/* DIKEMBALIKAN */

$kembali = mysqli_query($koneksi,"

SELECT *
FROM peminjaman

WHERE id_user='$id_user'
AND status='dikembalikan'

");

$total_kembali = mysqli_num_rows($kembali);

/* BUKU TERBARU */

$buku_terbaru = mysqli_query($koneksi,"

SELECT *
FROM buku

ORDER BY id_buku DESC

LIMIT 4

");

/* PINJAMAN AKTIF */

$pinjaman_aktif = mysqli_query($koneksi,"

SELECT
peminjaman.*,
buku.judul,
buku.cover

FROM peminjaman

LEFT JOIN buku
ON peminjaman.id_buku=buku.id_buku

WHERE peminjaman.id_user='$id_user'
AND peminjaman.status='dipinjam'

ORDER BY peminjaman.id_peminjaman DESC

LIMIT 5

");

$pinjam = mysqli_query($koneksi,"
SELECT * FROM peminjaman
WHERE id_user='$id_user'
");

$total_pinjam = mysqli_num_rows($pinjam);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard User</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/user.css">

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">

        <i class="fas fa-book-open"></i>

        <h2>PERDIG</h2>

    </div>

    <div class="menu">

        <a href="index.php" class="active">

            <i class="fas fa-home"></i>
            <span> Dashboard</span>

        </a>

        <a href="buku.php">

            <i class="fas fa-book"></i>
            <span> Daftar Buku</span>

        </a>

        <a href="riwayat.php">

            <i class="fas fa-clock-rotate-left"></i>
            <span> Riwayat</span>

        </a>

        <a href="../logout.php">

            <i class="fas fa-sign-out-alt"></i>
            <span> Logout</span>

        </a>

    </div>

</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">

        <h1>Dashboard User</h1>

        <div class="profile">

            <i class="fas fa-user-circle"></i>

            <div>

                <strong>
                    <?= $_SESSION['nama']; ?>
                </strong>

                <br>

                User / Peminjam

            </div>

        </div>

    </div>

    <div class="cards">

        <div class="card">
            <div class="card-top">
                <h3>Total Buku</h3>
                <i class="fas fa-book"></i>
            </div>
            <h1><?= $total_buku; ?></h1>
        </div>

        <div class="card">
            <div class="card-top">
                <h3>Sedang Dipinjam</h3>
                <i class="fas fa-book-reader"></i>
            </div>
            <h1><?= $total_dipinjam; ?></h1>
        </div>

        <div class="card">
            <div class="card-top">
                <h3>Sudah Kembali</h3>
                <i class="fas fa-check-circle"></i>
            </div>
            <h1><?= $total_kembali; ?></h1>
        </div>

        <div class="card">
            <div class="card-top">
                <h3>Kategori</h3>
                <i class="fas fa-tags"></i>
            </div>
            <h1><?= $total_kategori; ?></h1>
        </div>

    </div>

    <div class="welcome">

        <div>

            <h2 style="margin-bottom:15px;">

                Selamat Datang,
                <?= $_SESSION['nama']; ?> 👋

            </h2>

            <p style="line-height:1.8;max-width:650px;">

                Selamat datang di PERDIG Library.
                Nikmati pengalaman membaca digital dengan
                tampilan modern, pencarian buku yang mudah,
                serta proses peminjaman yang cepat dan praktis.

            </p>

        </div>

    </div>

    <div class="section-title">

        <h2>🔥 Buku Terbaru</h2>

    </div>

    <div class="book-grid">

    <?php while($buku = mysqli_fetch_assoc($buku_terbaru)){ ?>

        <div class="book-item">

            <img
            src="../uploads/<?= $buku['cover']; ?>"
            alt="<?= $buku['judul']; ?>">

            <h4>
                <?= $buku['judul']; ?>
            </h4>

            <a href="detail-buku.php?id=<?= $buku['id_buku']; ?>">

                <i class="fas fa-eye"></i>

                Lihat Detail

            </a>

        </div>

    <?php } ?>

    </div>

    <div class="section-title">

        <h2>📚 Sedang Dipinjam</h2>

    </div>

    <div class="pinjaman-box">

    <?php

    if(mysqli_num_rows($pinjaman_aktif) > 0){

    while($row = mysqli_fetch_assoc($pinjaman_aktif)){

    ?>

    <div class="pinjaman-item">

        <img
        src="../uploads/<?= $row['cover']; ?>">

        <div>

            <h4>

                <?= $row['judul']; ?>

            </h4>

            <small>

                Kembali:
                <?= $row['tanggal_kembali']; ?>

            </small>

        </div>

    </div>

    <?php

    }

    }else{

    echo "

    <p>Belum ada buku yang dipinjam.</p>

    ";

    }

    ?>

    </div>

</div>

</body>
</html>