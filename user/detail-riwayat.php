<?php

session_start();

if(!isset($_SESSION['id_user'])){
    header("Location: ../login-user.php");
    exit();
}

include '../koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "

SELECT
peminjaman.*,
buku.judul,
buku.penulis,
buku.cover,
kategori.nama_kategori

FROM peminjaman

LEFT JOIN buku
ON peminjaman.id_buku = buku.id_buku

LEFT JOIN kategori
ON buku.id_kategori = kategori.id_kategori

WHERE peminjaman.id_peminjaman='$id'
AND peminjaman.id_user='".$_SESSION['id_user']."'

");

$data = mysqli_fetch_array($query);

if(!$data){
    header("Location: riwayat.php");
    exit();
}

?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Detail Riwayat</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet"
href="../assets/css/user.css?v=<?php echo time(); ?>">

</head>

<body>

<div class="sidebar">

<div class="logo">

    <i class="fas fa-book-open"></i>

    <h2>PERDIG</h2>

</div>

<div class="menu">

    <a href="index.php">
        <i class="fas fa-home"></i>
        Dashboard
    </a>

    <a href="buku.php">
        <i class="fas fa-book"></i>
        Daftar Buku
    </a>

    <a href="riwayat.php" class="active">
        <i class="fas fa-clock-rotate-left"></i>
        Riwayat
    </a>

    <a href="../logout.php">
        <i class="fas fa-sign-out-alt"></i>
        Logout
    </a>

</div>

</div>

<div class="main">

<div class="topbar">

    <div>

        <h2>Detail Peminjaman</h2>

        <p>
            Informasi lengkap peminjaman buku
        </p>

    </div>

</div>

<div class="detail-riwayat">

    <!-- SIDEBAR DETAIL -->
    <div class="detail-sidebar">

        <img src="../uploads/<?= $data['cover']; ?>"
             class="detail-cover">

        <div class="status-card">

            <span class="status-badge <?= $data['status']; ?>">
                <?= ucfirst($data['status']); ?>
            </span>

        </div>

        <?php if(!empty($data['kode_peminjaman'])){ ?>

        <div class="mini-card">

            <small>Kode Peminjaman</small>

            <h4><?= $data['kode_peminjaman']; ?></h4>

        </div>
        <a href="riwayat.php" class="btn-back">

        <i class="fas fa-arrow-left"></i>

        Kembali ke Riwayat

        </a>

        <?php } ?>

        <?php

        $cek_ulasan = mysqli_query($koneksi,"
        SELECT *
        FROM ulasan
        WHERE id_buku='".$data['id_buku']."'
        AND id_user='".$_SESSION['id_user']."'
        ");

        ?>

        <?php if(
        $data['status']=='dikembalikan'
        &&
        mysqli_num_rows($cek_ulasan)==0
        ){ ?>

        <a href="ulasan.php?id=<?= $data['id_buku']; ?>"
           class="btn-ulasan-detail">

            <i class="fas fa-star"></i>
            Beri Ulasan

        </a>

        <?php } ?>

    </div>

    <!-- CONTENT -->
    <div class="detail-content">

        <span class="category-badge">
            <?= $data['nama_kategori']; ?>
        </span>

        <h1><?= $data['judul']; ?></h1>

        <p class="author">
            <?= $data['penulis']; ?>
        </p>

        <div class="detail-info-grid">

            <div class="info-card">

                <i class="fas fa-calendar-plus"></i>

                <h4>Tanggal Pinjam</h4>

                <p>
                    <?= date('d M Y',
                    strtotime($data['tanggal_pinjam'])); ?>
                </p>

            </div>

            <div class="info-card">

                <i class="fas fa-calendar-check"></i>

                <h4>Tanggal Kembali</h4>

                <p>
                    <?= date('d M Y',
                    strtotime($data['tanggal_kembali'])); ?>
                </p>

            </div>

        </div>

        <div class="box">

            <h4>
                <i class="fas fa-note-sticky"></i>
                Catatan Admin
            </h4>

            <p>

                <?= !empty($data['catatan_admin'])
                ? nl2br($data['catatan_admin'])
                : 'Belum ada catatan dari admin.'; ?>

            </p>

        </div>

        <div class="timeline-card">

            <h3>
                <i class="fas fa-route"></i>
                Timeline Peminjaman
            </h3>

            <div class="timeline">

                <div class="timeline-item active">
                    <span></span>
                    Pengajuan Peminjaman
                </div>

                <?php if(
                in_array(
                $data['status'],
                ['disetujui','dipinjam','dikembalikan']
                )){ ?>

                <div class="timeline-item active">
                    <span></span>
                    Disetujui Admin
                </div>

                <?php } ?>

                <?php if(
                in_array(
                $data['status'],
                ['dipinjam','dikembalikan']
                )){ ?>

                <div class="timeline-item active">
                    <span></span>
                    Buku Dipinjam
                </div>

                <?php } ?>

                <?php if(
                $data['status']=='dikembalikan'
                ){ ?>

                <div class="timeline-item active">
                    <span></span>
                    Buku Dikembalikan
                </div>

                <?php } ?>

            </div>

        </div>

    </div>

</div>

</div>

<style>

</body>
</html>
