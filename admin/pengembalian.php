<?php

include '../koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_array(mysqli_query($koneksi, "

SELECT
peminjaman.*,
buku.judul

FROM peminjaman

LEFT JOIN buku
ON peminjaman.id_buku = buku.id_buku

WHERE id_peminjaman='$id'

"));

if(!$data){

    echo "
    <script>
    alert('Data tidak ditemukan');
    window.location='peminjaman.php';
    </script>
    ";
    exit();

}

if(isset($_POST['kembalikan'])){

    mysqli_query($koneksi, "

    UPDATE peminjaman

    SET
    status='dikembalikan'

    WHERE id_peminjaman='$id'

    ");

    mysqli_query($koneksi, "

    UPDATE buku

    SET stok = stok + 1

    WHERE id_buku='".$data['id_buku']."'

    ");

    echo "

    <script>

    alert('Buku berhasil dikembalikan');

    window.location='peminjaman.php';

    </script>

    ";

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Pengembalian Buku</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet"
href="../style.css">

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

        </ul>

    </div>

    <div class="main">

        <div class="topbar">

            <h2>Pengembalian Buku</h2>

            <p>
                Konfirmasi pengembalian buku
            </p>

        </div>

        <div class="form-container">

            <div class="form-header">

                <h3>

                    Detail Pengembalian

                </h3>

            </div>

            <div class="form-group">

                <label>Judul Buku</label>

                <input
                type="text"
                value="<?= $data['judul']; ?>"
                readonly>

            </div>

            <div class="form-group">

                <label>Kode Peminjaman</label>

                <input
                type="text"
                value="<?= $data['kode_peminjaman']; ?>"
                readonly>

            </div>

            <div class="form-group">

                <label>Status Saat Ini</label>

                <input
                type="text"
                value="<?= ucfirst($data['status']); ?>"
                readonly>

            </div>

            <form method="POST">

                <div class="btn-group">

                    <button
                    type="submit"
                    name="kembalikan"
                    class="btn-submit">

                        <i class="fas fa-undo"></i>

                        Konfirmasi Pengembalian

                    </button>

                    <a
                    href="peminjaman.php"
                    class="btn-cancel">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>