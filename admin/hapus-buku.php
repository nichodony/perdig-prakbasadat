<?php

include '../koneksi.php';

$id = $_GET['id'];

/* Ambil data cover */
$query = mysqli_query($koneksi,"
SELECT cover
FROM buku
WHERE id_buku='$id'
");

$data = mysqli_fetch_assoc($query);

/* Hapus file cover */
if(!empty($data['cover'])){

    $file = "../uploads/".$data['cover'];

    if(file_exists($file)){
        unlink($file);
    }
}

/* Hapus data buku */
mysqli_query($koneksi,"
DELETE FROM buku
WHERE id_buku='$id'
");

echo "

<script>

alert('Buku berhasil dihapus');

window.location='buku.php';

</script>

";
?>