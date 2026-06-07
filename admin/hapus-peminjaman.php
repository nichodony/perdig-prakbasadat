<?php

include '../koneksi.php';

if(!isset($_GET['id'])){

    echo "

    <script>

        alert('ID peminjaman tidak ditemukan');

        window.location='peminjaman.php';

    </script>

    ";

    exit;
}

$id = $_GET['id'];

/* =========================
   AMBIL DATA PEMINJAMAN
========================= */

$query = mysqli_query($koneksi, "

SELECT *
FROM peminjaman
WHERE id_peminjaman='$id'

");

$data = mysqli_fetch_assoc($query);

if(!$data){

    echo "

    <script>

        alert('Data peminjaman tidak ditemukan');

        window.location='peminjaman.php';

    </script>

    ";

    exit;
}

/* =========================
   KEMBALIKAN STOK
   JIKA MASIH DIPINJAM
========================= */

if($data['status'] == 'dipinjam'){

    mysqli_query($koneksi, "

    UPDATE buku

    SET stok = stok + 1

    WHERE id_buku='".$data['id_buku']."'

    ");

}

/* =========================
   HAPUS DATA
========================= */

mysqli_query($koneksi, "

DELETE FROM peminjaman

WHERE id_peminjaman='$id'

");

/* =========================
   REDIRECT
========================= */

echo "

<script>

    alert('Data peminjaman berhasil dihapus');

    window.location='peminjaman.php';

</script>

";

?>