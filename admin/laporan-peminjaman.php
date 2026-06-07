<?php

include '../koneksi.php';

$query = mysqli_query($koneksi,"
SELECT
    peminjaman.*,
    user.nama,
    buku.judul
FROM peminjaman
LEFT JOIN user
ON peminjaman.id_user = user.id_user
LEFT JOIN buku
ON peminjaman.id_buku = buku.id_buku
ORDER BY peminjaman.id_peminjaman DESC
");

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Laporan Peminjaman</title>

<style>

body{
    font-family:Arial, sans-serif;
    padding:30px;
}

h1{
    text-align:center;
    margin-bottom:5px;
}

p{
    text-align:center;
    margin-bottom:25px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th,
table td{
    border:1px solid #000;
    padding:10px;
    font-size:13px;
}

table th{
    background:#f1f5f9;
}

.print-btn{
    margin-bottom:20px;
    padding:10px 18px;
    border:none;
    background:#2563eb;
    color:white;
    cursor:pointer;
    border-radius:6px;
}

@media print{

    .print-btn{
        display:none;
    }

}

</style>

</head>

<body>

<button
onclick="window.print()"
class="print-btn">

    🖨 Cetak Laporan

</button>

<h1>LAPORAN DATA PEMINJAMAN</h1>

<p>

    Tanggal Cetak :
    <?= date('d-m-Y H:i'); ?>

</p>

<table>

    <thead>

        <tr>

            <th>No</th>
            <th>Nama Anggota</th>
            <th>Judul Buku</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Kode</th>

        </tr>

    </thead>

    <tbody>

    <?php $no=1; ?>

    <?php while($data=mysqli_fetch_assoc($query)){ ?>

        <tr>

            <td><?= $no++; ?></td>

            <td><?= $data['nama']; ?></td>

            <td><?= $data['judul']; ?></td>

            <td><?= $data['tanggal_pinjam']; ?></td>

            <td><?= $data['tanggal_kembali']; ?></td>

            <td><?= ucfirst($data['status']); ?></td>

            <td>

                <?= !empty($data['kode_peminjaman'])
                ? $data['kode_peminjaman']
                : '-'; ?>

            </td>

        </tr>

    <?php } ?>

    </tbody>

</table>

<script>

window.onload = function(){

    window.print();

}

</script>

</body>
</html>