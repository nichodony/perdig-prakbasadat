<?php

include '../koneksi.php';

if($_GET['kategori']=="all"){

    $query = mysqli_query($koneksi,"
    SELECT buku.*, kategori.nama_kategori
    FROM buku
    LEFT JOIN kategori
    ON buku.id_kategori=kategori.id_kategori
    ORDER BY buku.id_buku DESC
    ");

}else{

    $id = $_GET['kategori'];

    $query = mysqli_query($koneksi,"
    SELECT buku.*, kategori.nama_kategori
    FROM buku
    LEFT JOIN kategori
    ON buku.id_kategori=kategori.id_kategori
    WHERE buku.id_kategori='$id'
    ORDER BY buku.id_buku DESC
    ");

}

while($data=mysqli_fetch_array($query)){
?>

<div class="book-card">

    <div class="book-cover-wrap">

        <img src="../uploads/<?= $data['cover']; ?>">

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

            Stok : <?= $data['stok']; ?>

        </div>

        <a
        href="detail-buku.php?id=<?= $data['id_buku']; ?>"
        class="btn-pinjam">

            Lihat Detail

        </a>

    </div>

</div>

<?php } ?>