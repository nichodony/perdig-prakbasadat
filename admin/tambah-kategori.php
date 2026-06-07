<?php

include '../koneksi.php';

if(isset($_POST['simpan'])){

    $nama = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_kategori']
    );

    mysqli_query($koneksi,"
    INSERT INTO kategori(nama_kategori)
    VALUES('$nama')
    ");

    header("Location: kategori.php");
    exit();
}

?>

<!DOCTYPE html>

<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Tambah Kategori</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

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

<h2>Tambah Kategori</h2>

<p>Tambahkan kategori buku baru</p>

</div>

<div class="form-card">

<form method="POST">

<div class="form-group">

<label>Nama Kategori</label>

<input
type="text"
name="nama_kategori"
placeholder="Masukkan nama kategori"
required>

</div>

<div class="form-action">

<button
type="submit"
name="simpan"
class="btn-success">

<i class="fas fa-save"></i>
Simpan

</button>   

</div>

</form>

</div>

</div>

</div>

</body>
</html>
