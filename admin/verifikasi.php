<?php

include '../koneksi.php';

if(!isset($_GET['id'])){
    header("Location: peminjaman.php");
    exit();
}

$id = $_GET['id'];

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
WHERE peminjaman.id_peminjaman = '$id'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    header("Location: peminjaman.php");
    exit();
}

$error = "";

if(isset($_POST['verifikasi'])){

    $kode = trim($_POST['kode']);

    if($kode == $data['kode_peminjaman']){

        mysqli_query($koneksi,"
        UPDATE peminjaman
        SET status='dipinjam'
        WHERE id_peminjaman='$id'
        ");

        echo "
        <script>
            alert('Verifikasi berhasil!');
            window.location='peminjaman.php';
        </script>
        ";
        exit();

    }else{

        $error = "Kode peminjaman tidak sesuai!";

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Verifikasi Peminjaman</title>

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

            <li class="active">
                <a href="peminjaman.php">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Peminjaman</span>
                </a>
            </li>

            <li>
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

            <h2>Verifikasi Peminjaman</h2>

            <p>
                Cocokkan kode yang dibawa anggota
            </p>

        </div>

        <div class="table-container">

            <div class="table-header">

                <h3>
                    Detail Peminjaman
                </h3>

            </div>

            <?php if($error != ""){ ?>

                <div class="alert-danger">

                    <?= $error; ?>

                </div>

            <?php } ?>

            <div class="verify-card">

                <div class="verify-row">

                    <label>Nama Anggota</label>

                    <div>
                        <?= $data['nama']; ?>
                    </div>

                </div>

                <div class="verify-row">

                    <label>Judul Buku</label>

                    <div>
                        <?= $data['judul']; ?>
                    </div>

                </div>

                <div class="verify-row">

                    <label>Status</label>

                    <div>

                        <span class="status disetujui">

                            <?= ucfirst($data['status']); ?>

                        </span>

                    </div>

                </div>

                <form method="POST">

                    <div class="form-group">

                        <label>

                            Masukkan Kode Peminjaman

                        </label>

                        <input
                        type="text"
                        name="kode"
                        placeholder="Contoh: PERDIG123456"
                        required>

                    </div>

                    <div class="button-group">

                        <button
                        type="submit"
                        name="verifikasi"
                        class="btn-success">

                            <i class="fas fa-check"></i>

                            Verifikasi

                        </button>

                        <a
                        href="peminjaman.php"
                        class="btn-delete">

                            <i class="fas fa-arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>