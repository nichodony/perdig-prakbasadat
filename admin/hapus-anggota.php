<?php

include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi,"
DELETE FROM user
WHERE id_user='$id'
");

echo "

<script>

alert('Anggota berhasil dihapus');

window.location='anggota.php';

</script>

";

?>