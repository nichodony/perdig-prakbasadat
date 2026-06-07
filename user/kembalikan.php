<?php

session_start();

include '../koneksi.php';

$id_peminjaman = $_GET['id'];

$data = mysqli_query($koneksi, "

SELECT *
FROM peminjaman
WHERE id_peminjaman='$id_peminjaman'

");

$row = mysqli_fetch_assoc($data);

if(!$row){

    header("Location: riwayat.php");
    exit();

}

$id_buku = $row['id_buku'];

mysqli_query($koneksi, "

UPDATE peminjaman

SET status='dikembalikan'

WHERE id_peminjaman='$id_peminjaman'

");

mysqli_query($koneksi, "

UPDATE buku

SET stok = stok + 1

WHERE id_buku='$id_buku'

");

echo "

<script>

alert('Buku berhasil dikembalikan');

window.location='riwayat.php';

</script>

";
?>