<?php

session_start();

if(!isset($_SESSION['id_user'])){
    header("Location: ../login-user.php");
    exit();
}

include '../koneksi.php';

$query = mysqli_query($koneksi, "

SELECT
peminjaman.*,
peminjaman.id_buku,
buku.judul,
buku.cover

FROM peminjaman

LEFT JOIN buku
ON peminjaman.id_buku = buku.id_buku

WHERE peminjaman.id_user='".$_SESSION['id_user']."'

ORDER BY peminjaman.id_peminjaman DESC

");

?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Riwayat Peminjaman</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

        <h2>Riwayat Peminjaman</h2>

        <p>
            Daftar seluruh peminjaman buku Anda
        </p>

    </div>

</div>

<div class="search-wrapper">

    <i class="fas fa-search"></i>

    <input
    type="text"
    id="searchInput"
    placeholder="Cari judul buku...">

</div>

<?php if(mysqli_num_rows($query) == 0){ ?>

    <div class="empty-state">

        <i class="fas fa-book-open"></i>

        <h3>
            Belum Ada Riwayat Peminjaman
        </h3>

        <p>
            Silahkan pinjam buku terlebih dahulu.
        </p>

    </div>

<?php } ?>

<div id="historyContainer">

<?php while($data = mysqli_fetch_array($query)){ ?>

<?php

$cek_ulasan = mysqli_query($koneksi,"
SELECT *
FROM ulasan
WHERE id_buku='".$data['id_buku']."'
AND id_user='".$_SESSION['id_user']."'
");

$sudah_ulasan = mysqli_num_rows($cek_ulasan);

?>

<div class="history-card">

    <a href="detail-riwayat.php?id=<?= $data['id_peminjaman']; ?>">

        <img
        src="../uploads/<?= $data['cover']; ?>"
        class="history-cover">

    </a>

    <div class="history-info">

        <h3><?= $data['judul']; ?></h3>

        <?php if(!empty($data['kode_peminjaman'])){ ?>

            <small>
                Kode :
                <?= $data['kode_peminjaman']; ?>
            </small>

        <?php } ?>

        <p>
            Pinjam :
            <?= date('d M Y', strtotime($data['tanggal_pinjam'])); ?>
        </p>

    </div>

    <div class="history-action">

        <span class="status-badge <?= $data['status']; ?>">
            <?= ucfirst($data['status']); ?>
        </span>

        <?php if($data['status']=='dikembalikan' && $sudah_ulasan==0){ ?>

            <a
            href="ulasan.php?id=<?= $data['id_buku']; ?>"
            class="btn-ulasan">

                <i class="fas fa-star"></i>

                Beri Ulasan

            </a>

        <?php } ?>

        <?php if($data['status']=='dikembalikan' && $sudah_ulasan>0){ ?>

            <span class="review-done">

                <i class="fas fa-check-circle"></i>

                Sudah Diulas

            </span>

        <?php } ?>

    </div>

</div>

<?php } ?>

</div>
</div>

<script>

const searchInput =
document.getElementById("searchInput");

searchInput.addEventListener("keyup", function(){

    let filter =
    this.value.toLowerCase();

    let cards =
    document.querySelectorAll(".history-card");

    cards.forEach(card=>{

        let text =
        card.innerText.toLowerCase();

        card.style.display =
        text.includes(filter)
        ? "flex"
        : "none";

    });

});

</script>

</body>
</html>
