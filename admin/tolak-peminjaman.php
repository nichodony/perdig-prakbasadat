<?php

include '../koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_array(mysqli_query($koneksi, "

SELECT *
FROM peminjaman
WHERE id_peminjaman='$id'

"));

if(isset($_POST['simpan'])){

    $catatan = mysqli_real_escape_string(
        $koneksi,
        $_POST['catatan_admin']
    );

    mysqli_query($koneksi, "

    UPDATE peminjaman

    SET

    status='ditolak',
    catatan_admin='$catatan'

    WHERE id_peminjaman='$id'

    ");

    echo "

    <script>

    alert('Peminjaman berhasil ditolak');

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

<title>Tolak Peminjaman</title>

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

            <h2>Tolak Peminjaman</h2>

            <p>
                Berikan alasan penolakan kepada peminjam
            </p>

        </div>

        <div class="form-container">

            <div class="form-header">

                <h3>

                    Alasan Penolakan

                </h3>

            </div>

            <form method="POST">

                <div class="form-group">

                    <label>

                        Catatan Admin

                    </label>

                    <textarea
                    name="catatan_admin"
                    required>Buku sedang tidak tersedia saat ini.</textarea>

                </div>

                <div class="btn-group">

                    <button
                    type="submit"
                    name="simpan"
                    class="btn-submit">

                        <i class="fas fa-times"></i>

                        Tolak Peminjaman

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