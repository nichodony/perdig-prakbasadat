<?php

session_start();

if(!isset($_SESSION['role'])){
    header("Location: ../login-user.php");
    exit();
}

include '../koneksi.php';

$id_buku = $_GET['id'];

$buku = mysqli_query($koneksi, "

SELECT
buku.*,
kategori.nama_kategori

FROM buku

LEFT JOIN kategori
ON buku.id_kategori = kategori.id_kategori

WHERE buku.id_buku='$id_buku'

");

$data = mysqli_fetch_assoc($buku);

if(!$data){
    header("Location: buku.php");
    exit();
}

if($data['stok'] <= 0){

    echo "

    <script>

    alert('Stok buku habis');

    window.location='buku.php';

    </script>

    ";

    exit();

}

if(isset($_POST['pinjam'])){

    $id_user = $_SESSION['id_user'];

    $tanggal_pinjam = date('Y-m-d');

    $tanggal_kembali = date(
        'Y-m-d',
        strtotime('+7 days')
    );

    $cek = mysqli_query($koneksi, "

    SELECT *
    FROM peminjaman

    WHERE id_user='$id_user'
    AND id_buku='$id_buku'
    AND status='dipinjam'

    ");

    if(mysqli_num_rows($cek) > 0){

        echo "

        <script>

        alert('Buku ini masih sedang Anda pinjam');

        window.location='riwayat.php';

        </script>

        ";

        exit();

    }

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

    alert('Buku berhasil dipinjam');

    window.location='riwayat.php';

    </script>

    ";

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Konfirmasi Peminjaman</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet"
href="../assets/css/user.css">

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
            <span> Dashboard</span>
        </a>

        <a href="buku.php" class="active">
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

<div class="main">

    <div class="topbar">

        <h2>Konfirmasi Peminjaman</h2>

    </div>

    <div class="pinjam-card">

        <div class="pinjam-cover">

            <img
            src="../uploads/<?= $data['cover']; ?>"
            alt="<?= $data['judul']; ?>">

        </div>

        <div class="pinjam-content">

            <span class="detail-category">

                <?= $data['nama_kategori']; ?>

            </span>

            <h1>

                <?= $data['judul']; ?>

            </h1>

            <h3>

                <?= $data['penulis']; ?>

            </h3>

            <div class="pinjam-info">

                <div>

                    <strong>Stok</strong>

                    <p><?= $data['stok']; ?> Buku</p>

                </div>

                <div>

                    <strong>Tanggal Pinjam</strong>

                    <p><?= date('d M Y'); ?></p>

                </div>

                <div>

                    <strong>Tanggal Kembali</strong>

                    <p><?= date('d M Y', strtotime('+7 days')); ?></p>

                </div>

            </div>

            <form method="POST">

                <button
                type="submit"
                name="pinjam"
                class="btn-pinjam-big">

                    <i class="fas fa-book-reader"></i>

                    Konfirmasi Peminjaman

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>