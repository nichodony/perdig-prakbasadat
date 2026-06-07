<?php

session_start();

if(!isset($_SESSION['role'])){
    header("Location: ../login-user.php");
    exit();
}

include '../koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "

SELECT
buku.*,
kategori.nama_kategori

FROM buku

LEFT JOIN kategori
ON buku.id_kategori = kategori.id_kategori

WHERE buku.id_buku='$id'

");

$data = mysqli_fetch_array($query);
$rating = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT
AVG(rating) as rata_rating,
COUNT(*) as total_ulasan
FROM ulasan
WHERE id_buku='$id'
"));

$ulasan = mysqli_query($koneksi,"
SELECT
ulasan.*,
user.nama

FROM ulasan

LEFT JOIN user
ON ulasan.id_user = user.id_user

WHERE ulasan.id_buku='$id'

ORDER BY ulasan.tanggal DESC
");

if(!$data){
    header("Location: buku.php");
    exit();
}

if(isset($_POST['pinjam'])){

    $id_user = $_SESSION['id_user'];

    $cek = mysqli_query($koneksi, "

    SELECT *

    FROM peminjaman

    WHERE id_user='$id_user'
    AND id_buku='$id'

    AND status IN(
        'menunggu',
        'disetujui',
        'dipinjam'
    )

    ");

    if(mysqli_num_rows($cek) > 0){

        echo "

        <script>

        alert('Buku ini masih dalam proses peminjaman.');

        </script>

        ";

    }else{

        $tanggal_pinjam = date('Y-m-d');

        $tanggal_kembali = date(
            'Y-m-d',
            strtotime('+7 days')
        );

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
            '$id',
            '$tanggal_pinjam',
            '$tanggal_kembali',
            'menunggu'

        )

        ");

        echo "

        <script>

        alert('Permintaan peminjaman berhasil dikirim.');

        window.location='riwayat.php';

        </script>

        ";

        exit();

    }

}

?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title><?= $data['judul']; ?></title>

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
        <span>Dashboard</span>

    </a>

    <a href="buku.php" class="active">

        <i class="fas fa-book"></i>
        <span>Daftar Buku</span>

    </a>

    <a href="riwayat.php">

        <i class="fas fa-clock-rotate-left"></i>
        <span>Riwayat</span>

    </a>

    <a href="../logout.php">

        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>

    </a>

</div>

</div>

<div class="main">

<div class="topbar">

    <h2>Detail Buku</h2>

</div>

<div class="detail-book modern-book-detail">

    <!-- SIDEBAR -->
    <div class="book-sidebar">

        <div class="cover-card">

            <img
            src="../uploads/<?= $data['cover']; ?>"
            alt="<?= $data['judul']; ?>">

        </div>

        <div class="book-rating-card">

            <div class="rating-big">

                ⭐

                <?= $rating['rata_rating']
                ? number_format($rating['rata_rating'],1)
                : '0.0'; ?>

            </div>

            <small>

                <?= $rating['total_ulasan']; ?>

                Ulasan Pembaca

            </small>

        </div>

        <div class="book-info-side">

            <div>

                <span>Kategori</span>

                <strong>
                    <?= $data['nama_kategori']; ?>
                </strong>

            </div>

            <div>

                <span>Stok</span>

                <strong>
                    <?= $data['stok']; ?> Buku
                </strong>

            </div>

        </div>

        <div class="book-review-preview">

            <h4>

                <i class="fas fa-comments"></i>

                Ulasan Terbaru

            </h4>

            <?php

            $preview = mysqli_query($koneksi,"
            SELECT ulasan.*, user.nama
            FROM ulasan
            LEFT JOIN user
            ON ulasan.id_user=user.id_user
            WHERE ulasan.id_buku='$id'
            ORDER BY ulasan.tanggal DESC
            LIMIT 3
            ");

            ?>

            <?php if(mysqli_num_rows($preview)==0){ ?>

                <div class="empty-review">

                    Belum ada ulasan.

                </div>

            <?php } ?>

            <?php while($r=mysqli_fetch_assoc($preview)){ ?>

            <div class="preview-review">

                <strong>

                    <?= $r['nama']; ?>

                </strong>

                <div class="stars">

                    <?= str_repeat('⭐',$r['rating']); ?>

                </div>

                <p>

                    <?= substr($r['ulasan'],0,60); ?>

                    ...

                </p>

            </div>

            <?php } ?>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="detail-content">

        <span class="detail-category">

            <?= $data['nama_kategori']; ?>

        </span>

        <h1>

            <?= $data['judul']; ?>

        </h1>

        <h3>

            <?= $data['penulis']; ?>

        </h3>

        <div class="detail-info">

            <div>

                <strong>Penerbit</strong>

                <p><?= $data['penerbit']; ?></p>

            </div>

            <div>

                <strong>Tahun Terbit</strong>

                <p><?= $data['tahun_terbit']; ?></p>

            </div>

            <div>

                <strong>Kategori</strong>

                <p><?= $data['nama_kategori']; ?></p>

            </div>

            <div>

                <strong>Stok</strong>

                <p><?= $data['stok']; ?> Buku</p>

            </div>

        </div>

        <div class="detail-description">

            <h3>Deskripsi Buku</h3>

            <?php

            $deskripsi =
            !empty($data['deskripsi'])
            ? $data['deskripsi']
            : 'Belum tersedia deskripsi buku.';

            ?>

            <p>

                <?= strlen($deskripsi) > 180
                ? substr($deskripsi,0,180).'...'
                : $deskripsi; ?>

            </p>

            <?php if(strlen($deskripsi) > 180){ ?>

                <button
                class="btn-read-more"
                onclick="openDescription()">

                    <i class="fas fa-book-open"></i>

                    Baca Selengkapnya

                </button>

            <?php } ?>

        </div>

        <div class="alur-pinjam">

            <h4>

                <i class="fas fa-route"></i>

                Alur Peminjaman

            </h4>

            <p>1. Ajukan peminjaman buku.</p>

            <p>2. Tunggu persetujuan admin.</p>

            <p>3. Jika disetujui, ambil buku di perpustakaan.</p>

            <p>4. Tunjukkan kode peminjaman ke petugas.</p>

            <p>5. Kembalikan sebelum jatuh tempo.</p>

        </div>

        <div class="review-section">

            <h3>

                <i class="fas fa-star"></i>

                Semua Ulasan

            </h3>

            <?php if(mysqli_num_rows($ulasan)==0){ ?>

                <div class="empty-review">

                    Belum ada ulasan untuk buku ini.

                </div>

            <?php } ?>

            <?php while($u=mysqli_fetch_assoc($ulasan)){ ?>

            <div class="review-card">

                <div class="review-header">

                    <div>

                        <strong>

                            <?= $u['nama']; ?>

                        </strong>

                        <small>

                            <?= date(
                            'd M Y',
                            strtotime($u['tanggal'])
                            ); ?>

                        </small>

                    </div>

                    <div class="review-stars">

                        <?= str_repeat('⭐',$u['rating']); ?>

                    </div>

                </div>

                <p>

                    <?= nl2br($u['ulasan']); ?>

                </p>

            </div>

            <?php } ?>

        </div>

        <?php if($data['stok'] > 0){ ?>

            <form method="POST">

                <button
                type="submit"
                name="pinjam"
                class="btn-pinjam-big">

                    <i class="fas fa-book-reader"></i>

                    Ajukan Peminjaman

                </button>

            </form>

        <?php }else{ ?>

            <button
            class="btn-habis-big">

                Stok Habis

            </button>

        <?php } ?>

    </div>

</div>

</div>
<div
id="descriptionModal"
class="modal-description">

    <div class="modal-content-description">

        <div class="modal-header">

            <h3>

                <?= $data['judul']; ?>

            </h3>

            <button
            onclick="closeDescription()">

                <i class="fas fa-times"></i>

            </button>

        </div>

        <div class="modal-body">

            <?= nl2br($deskripsi); ?>

        </div>

    </div>

</div>
<script>

function openDescription(){

    document
    .getElementById('descriptionModal')
    .classList.add('show');

}

function closeDescription(){

    document
    .getElementById('descriptionModal')
    .classList.remove('show');

}

window.onclick = function(e){

    let modal =
    document.getElementById('descriptionModal');

    if(e.target == modal){

        modal.classList.remove('show');

    }

}

</script>

</body>
</html>



</div>

</body>
</html>


</div>

</body>
</html>