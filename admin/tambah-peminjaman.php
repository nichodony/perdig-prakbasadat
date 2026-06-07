<?php
include '../koneksi.php';

/* =========================
   SIMPAN DATA
========================= */

if(isset($_POST['submit'])){

    $id_user = $_POST['id_user'];
    $id_buku = $_POST['id_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    mysqli_query($koneksi, "

        INSERT INTO peminjaman(
            id_user,
            id_buku,
            tanggal_pinjam,
            tanggal_kembali,
            status
        )

        VALUES(
            '$id_user',
            '$id_buku',
            '$tanggal_pinjam',
            '$tanggal_kembali',
            'dipinjam'
        )

    ");

    mysqli_query($koneksi, "

        UPDATE buku
        SET stok = stok - 1
        WHERE id_buku='$id_buku'

    ");

    echo "

    <script>

        alert('Peminjaman berhasil ditambahkan');
        window.location='peminjaman.php';

    </script>

    ";
}

/* =========================
   DATA USER
========================= */

$user = mysqli_query($koneksi, "

    SELECT *
    FROM user
    WHERE role='user'
    ORDER BY nama ASC

");

/* =========================
   DATA BUKU
========================= */

$buku = mysqli_query($koneksi, "

    SELECT *
    FROM buku
    WHERE stok > 0
    ORDER BY judul ASC

");

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Peminjaman</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet"
href="../style.css">

</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo">

            <i class="fas fa-book-open"></i>
            <span>PERDIG</span>

        </div>

        <ul class="menu">

            <li>
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
                    <span>Anggota</span>
                </a>
            </li>

            <li class="active">
                <a href="peminjaman.php">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Peminjaman</span>
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

            <div>
                <h2>Tambah Peminjaman</h2>
                <p>Form peminjaman buku PERDIG</p>
            </div>

        </div>

        <!-- FORM -->
        <div class="form-container">

            <div class="form-header">

                <h3>Form Tambah Peminjaman</h3>

            </div>

            <form method="POST">

                <!-- USER -->
                <div class="form-group">

                    <label>Nama Anggota</label>

                    <select name="id_user" required>

                        <option value="">
                            -- Pilih Anggota --
                        </option>

                        <?php while($u = mysqli_fetch_array($user)){ ?>

                        <option value="<?= $u['id_user']; ?>">

                            <?= $u['nama']; ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <!-- BUKU -->
                <div class="form-group">

                    <label>Buku</label>

                    <select name="id_buku" required>

                        <option value="">
                            -- Pilih Buku --
                        </option>

                        <?php while($b = mysqli_fetch_array($buku)){ ?>

                        <option value="<?= $b['id_buku']; ?>">

                            <?= $b['judul']; ?>
                            (Stok: <?= $b['stok']; ?>)

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <!-- TANGGAL PINJAM -->
                <div class="form-group">

                    <label>Tanggal Pinjam</label>

                    <input
                        type="date"
                        name="tanggal_pinjam"
                        value="<?= date('Y-m-d'); ?>"
                        required>

                </div>

                <!-- TANGGAL KEMBALI -->
                <div class="form-group">

                    <label>Tanggal Kembali</label>

                    <input
                        type="date"
                        name="tanggal_kembali"
                        required>

                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    name="submit"
                    class="btn-submit">

                    <i class="fas fa-save"></i>
                    Simpan Peminjaman

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>