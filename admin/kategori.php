<?php

include '../koneksi.php';

$query = mysqli_query($koneksi,"
SELECT *
FROM kategori
ORDER BY id_kategori DESC
");

?>

<!DOCTYPE html>

<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Kategori</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet"
href="../style.css?v=<?php echo time(); ?>">

</head>

<body>

<div class="wrapper">

    <div class="sidebar">

        <div class="logo">
            <i class="fas fa-book-open"></i>
            PERDIG
        </div>

        <ul class="menu">

            <li>
                <a href="index.php">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="buku.php">
                    <i class="fas fa-book"></i>
                    <span>Data Buku</span>
                </a>
            </li>

            <li>
                <a href="anggota.php">
                    <i class="fas fa-users"></i>
                    <span>Data Anggota</span>
                </a>
            </li>

            <li>
                <a href="peminjaman.php">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Peminjaman</span>
                </a>
            </li>

            <li class="active">
                <a href="kategori.php">
                    <i class="fas fa-tags"></i>
                    <span>Kategori</span>
                </a>
            </li>

            <li>
                <a href="../logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>

    </div>

<div class="main">

<div class="topbar">

<h2>Data Kategori</h2>

<p>Kelola kategori buku perpustakaan</p>

</div>

<div class="table-container">

<div class="table-header">

<h3>Daftar Kategori</h3>

<a href="tambah-kategori.php"
class="btn-primary">

<i class="fas fa-plus"></i>

Tambah Kategori

</a>

</div>

<div class="search-box">

<i class="fas fa-search"></i>

<input
type="text"
id="searchInput"
placeholder="Cari kategori...">

</div>

<div class="table-responsive">

<table id="kategoriTable">

<thead>

<tr>

<th>No</th>
<th>Nama Kategori</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php $no=1; ?>

<?php while($data=mysqli_fetch_assoc($query)){ ?>

<tr>

<td><?= $no++; ?></td>

<td><?= $data['nama_kategori']; ?></td>

<td>

<div class="action-button">

<a href="edit-kategori.php?id=<?= $data['id_kategori']; ?>"
class="btn-warning">

<i class="fas fa-edit"></i>
</a>

<a href="hapus-kategori.php?id=<?= $data['id_kategori']; ?>"
class="btn-delete"
onclick="return confirm('Hapus kategori ini?')">

<i class="fas fa-trash"></i>

</a>

</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<script>

document
.getElementById('searchInput')
.addEventListener('keyup',function(){

let filter=this.value.toLowerCase();

document
.querySelectorAll('#kategoriTable tbody tr')
.forEach(row=>{

row.style.display=
row.innerText.toLowerCase().includes(filter)
? ''
: 'none';

});

});

</script>

</body>
</html>
