<?php

session_start();

if(!isset($_SESSION['role'])){
    header("Location: ../login-user.php");
    exit();
}

include '../koneksi.php';

/* =========================
   FILTER KATEGORI
========================= */

if(isset($_GET['kategori']) && $_GET['kategori'] != ''){

    $id_kategori = $_GET['kategori'];

    $query = mysqli_query($koneksi, "

    SELECT
    buku.*,
    kategori.nama_kategori

    FROM buku

    LEFT JOIN kategori
    ON buku.id_kategori = kategori.id_kategori

    WHERE buku.id_kategori = '$id_kategori'

    ORDER BY buku.id_buku DESC

    ");

}else{

    $query = mysqli_query($koneksi, "

    SELECT
    buku.*,
    kategori.nama_kategori

    FROM buku

    LEFT JOIN kategori
    ON buku.id_kategori = kategori.id_kategori

    ORDER BY buku.id_buku DESC

    ");

}

/* =========================
   STATISTIK
========================= */

$total_buku_query = mysqli_query($koneksi,"
SELECT * FROM buku
");

$total_buku = mysqli_num_rows($total_buku_query);

$kategori_count = mysqli_query($koneksi,"
SELECT * FROM kategori
");

$total_kategori = mysqli_num_rows($kategori_count);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Katalog Buku</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet"
href="../assets/css/user.css">

</head>

<body>

<!-- SIDEBAR -->

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

<!-- MAIN -->

<div class="main">

    <!-- TOPBAR -->

    <div class="topbar">

        <div>

            <h2>Perpustakaan Digital</h2>

            <p>
                Temukan buku favoritmu dan mulai membaca
            </p>

        </div>

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

    <!-- HERO -->

    <div class="hero-book">

        <span class="hero-badge">

            📚 PERDIG LIBRARY

        </span>

        <h1>

            Temukan Buku Favoritmu

        </h1>

        <p>

            Jelajahi koleksi buku digital,
            pinjam secara online,
            dan nikmati pengalaman membaca yang lebih mudah.

        </p>

    </div>

    <!-- STATISTIK -->

    <div class="stats-book">

        <div class="stat-box">

            <i class="fas fa-book"></i>

            <h2><?= $total_buku ?></h2>

            <p>Total Buku</p>

        </div>

        <div class="stat-box">

            <i class="fas fa-layer-group"></i>

            <h2><?= $total_kategori ?></h2>

            <p>Kategori</p>

        </div>

        <div class="stat-box">

            <i class="fas fa-fire"></i>

            <h2>Hot</h2>

            <p>Koleksi Terbaru</p>

        </div>

    </div>

    <!-- SEARCH -->

    <div class="search-wrapper">

        <i class="fas fa-search"></i>

        <input
        type="text"
        id="searchInput"
        placeholder="Cari judul buku atau penulis...">

    </div>

    <!-- FILTER KATEGORI -->

    <div class="kategori-filter">

        <a href="#"
        class="kategori-btn active"
        data-id="all">

            Semua

        </a>

        <?php

        $kategori = mysqli_query($koneksi,"
        SELECT *
        FROM kategori
        ORDER BY nama_kategori ASC
        ");

        while($k = mysqli_fetch_array($kategori)){
        ?>

            <a href="#"
            class="kategori-btn"
            data-id="<?= $k['id_kategori']; ?>">

                <?= $k['nama_kategori']; ?>

            </a>

        <?php } ?>

    </div>

    <!-- KATEGORI AKTIF -->

    <?php

    if(isset($_GET['kategori'])){

        $id_kategori = $_GET['kategori'];

        $kat = mysqli_query($koneksi,"
        SELECT nama_kategori
        FROM kategori
        WHERE id_kategori='$id_kategori'
        ");

        $aktif = mysqli_fetch_assoc($kat);

    ?>
    <?php } ?>

    <!-- GRID BUKU -->

    <div class="book-grid" id="bookGrid">

    <?php while($data = mysqli_fetch_array($query)){ ?>

        <div class="book-card">

            <div class="book-cover-wrap">

                <?php if(!empty($data['cover'])){ ?>

                <img
                src="../uploads/<?= $data['cover']; ?>"
                alt="<?= $data['judul']; ?>">

                <?php } ?>

                <span class="book-badge">

                    <?= $data['nama_kategori']; ?>

                </span>

            </div>

            <div class="book-body">

                <h3 class="book-title">

                    <?= $data['judul']; ?>

                </h3>

                <p class="book-author">

                    <?= $data['penulis']; ?>

                </p>

                <div class="book-meta">

                    <span>

                        <i class="fas fa-cubes"></i>

                        Stok :
                        <?= $data['stok']; ?>

                    </span>

                </div>

                <?php if($data['stok'] > 0){ ?>

                    <a
                    href="detail-buku.php?id=<?= $data['id_buku']; ?>"
                    class="btn-pinjam">

                        <i class="fas fa-eye"></i>

                        Lihat Detail

                    </a>

                <?php }else{ ?>

                    <button class="btn-habis">

                        Stok Habis

                    </button>

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
    document.querySelectorAll(".book-card");

    cards.forEach(card=>{

        let text =
        card.innerText.toLowerCase();

        card.style.display =
        text.includes(filter)
        ? "block"
        : "none";

    });

});
document.querySelectorAll('.kategori-btn')
.forEach(btn=>{

    btn.addEventListener('click',function(e){

        e.preventDefault();

        let kategori = this.dataset.id;

        /* HAPUS ACTIVE DARI SEMUA */
        document
        .querySelectorAll('.kategori-btn')
        .forEach(item=>{
            item.classList.remove('active');
        });

        /* TAMBAHKAN ACTIVE KE YANG DIKLIK */
        this.classList.add('active');

        fetch(
            'filter-buku.php?kategori='
            + kategori
        )
        .then(response=>response.text())
        .then(data=>{

            document
            .getElementById('bookGrid')
            .innerHTML = data;

        });

    });

});

</script>

</body>
</html>