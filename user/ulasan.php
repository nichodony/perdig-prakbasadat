<?php

session_start();

if(!isset($_SESSION['id_user'])){
    header("Location: ../login-user.php");
    exit();
}

include '../koneksi.php';

$id_buku = $_GET['id'];

$cek = mysqli_query($koneksi,"
SELECT *
FROM buku
WHERE id_buku='$id_buku'
");

$buku = mysqli_fetch_assoc($cek);

if(!$buku){
    header("Location: riwayat.php");
    exit();
}

$cekUlasan = mysqli_query($koneksi,"
SELECT *
FROM ulasan
WHERE id_buku='$id_buku'
AND id_user='".$_SESSION['id_user']."'
");

if(mysqli_num_rows($cekUlasan) > 0){
    header("Location: riwayat.php");
    exit();
}

if(isset($_POST['simpan'])){

    $rating = $_POST['rating'];

    $ulasan = mysqli_real_escape_string(
        $koneksi,
        $_POST['ulasan']
    );

    mysqli_query($koneksi,"
    INSERT INTO ulasan(
        id_buku,
        id_user,
        rating,
        ulasan
    )
    VALUES(
        '$id_buku',
        '".$_SESSION['id_user']."',
        '$rating',
        '$ulasan'
    )
    ");

    header("Location: riwayat.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Beri Ulasan</title>

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

            <h2>Beri Ulasan</h2>

            <p>
                Bagikan pengalaman Anda setelah membaca buku
            </p>

        </div>

    </div>

    <div class="ulasan-card">

        <div class="ulasan-header">

            <img
            src="../uploads/<?= $buku['cover']; ?>"
            alt="<?= $buku['judul']; ?>">

            <div>

                <h3>
                    <?= $buku['judul']; ?>
                </h3>

                <p>
                    <?= $buku['penulis']; ?>
                </p>

            </div>

        </div>

        <form method="POST">

            <label>Rating</label>

            <select
            name="rating"
            required>

                <option value="">
                    Pilih Rating
                </option>

                <option value="5">
                    ⭐⭐⭐⭐⭐ Sangat Baik
                </option>

                <option value="4">
                    ⭐⭐⭐⭐ Baik
                </option>

                <option value="3">
                    ⭐⭐⭐ Cukup
                </option>

                <option value="2">
                    ⭐⭐ Kurang
                </option>

                <option value="1">
                    ⭐ Sangat Kurang
                </option>

            </select>

            <label>Ulasan</label>

            <textarea
            name="ulasan"
            rows="6"
            required
            placeholder="Tuliskan ulasan Anda..."></textarea>

            <div class="ulasan-action">

                <a
                href="riwayat.php"
                class="btn-secondary">

                    Kembali

                </a>

                <button
                type="submit"
                name="simpan"
                class="btn-primary">

                    <i class="fas fa-paper-plane"></i>

                    Kirim Ulasan

                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>