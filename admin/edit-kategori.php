<?php

include '../koneksi.php';

$id = $_GET['id'];

$query = mysqli_query(
$koneksi,
"SELECT * FROM kategori
WHERE id_kategori='$id'"
);

$data = mysqli_fetch_assoc($query);

if(!$data){

    header("Location: kategori.php");
    exit();

}

if(isset($_POST['update'])){

    $nama = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_kategori']
    );

    mysqli_query($koneksi,"
    UPDATE kategori
    SET nama_kategori='$nama'
    WHERE id_kategori='$id'
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

<title>Edit Kategori</title>

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

<h2>Edit Kategori</h2>

<p>Perbarui data kategori</p>

</div>

<div class="form-card">

<form method="POST">

<div class="form-group">

<label>Nama Kategori</label>

<input
type="text"
name="nama_kategori"
value="<?= $data['nama_kategori']; ?>"
required>

</div>

<div class="form-action">

<button
type="submit"
name="update"
class="btn-success">

<i class="fas fa-save"></i>
Update

</button>

<a href="kategori.php"
class="btn-delete">

Kembali

</a>

</div>

</form>

</div>

</div>

</div>

</body>
</html>
