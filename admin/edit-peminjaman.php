<?php

include '../koneksi.php';

$id = $_GET['id'];

/* =========================
   DATA PEMINJAMAN
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

        alert('Data tidak ditemukan');

        window.location='peminjaman.php';

    </script>

    ";

    exit;
}

/* =========================
   UPDATE DATA
========================= */

if(isset($_POST['submit'])){

    $id_user = $_POST['id_user'];
    $id_buku_baru = $_POST['id_buku'];

    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $status_baru = $_POST['status'];

    $id_buku_lama = $data['id_buku'];
    $status_lama = $data['status'];

    /* =========================
       JIKA BUKU DIGANTI
    ========================= */

    if($id_buku_lama != $id_buku_baru){

        if($status_lama == 'dipinjam'){

            mysqli_query($koneksi, "

            UPDATE buku

            SET stok = stok + 1

            WHERE id_buku='$id_buku_lama'

            ");

            mysqli_query($koneksi, "

            UPDATE buku

            SET stok = stok - 1

            WHERE id_buku='$id_buku_baru'

            ");

        }

    }

    /* =========================
       STATUS BERUBAH
    ========================= */

    if($status_lama == 'dipinjam' && $status_baru == 'dikembalikan'){

        mysqli_query($koneksi, "

        UPDATE buku

        SET stok = stok + 1

        WHERE id_buku='$id_buku_baru'

        ");

    }

    if($status_lama == 'dikembalikan' && $status_baru == 'dipinjam'){

        mysqli_query($koneksi, "

        UPDATE buku

        SET stok = stok - 1

        WHERE id_buku='$id_buku_baru'

        ");

    }

    /* =========================
       UPDATE PEMINJAMAN
    ========================= */

    mysqli_query($koneksi, "

    UPDATE peminjaman

    SET

    id_user='$id_user',
    id_buku='$id_buku_baru',
    tanggal_pinjam='$tanggal_pinjam',
    tanggal_kembali='$tanggal_kembali',
    status='$status_baru'

    WHERE id_peminjaman='$id'

    ");

    echo "

    <script>

        alert('Data berhasil diperbarui');

        window.location='peminjaman.php';

    </script>

    ";

}

/* =========================
   DATA USER
========================= */

$user = mysqli_query($koneksi, "

SELECT *
FROM user

WHERE role='user'

ORDER BY nama ASC

");

/* =========================
   DATA BUKU
========================= */

$buku = mysqli_query($koneksi, "

SELECT *
FROM buku

ORDER BY judul ASC

");

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Edit Peminjaman</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet"
href="../style.css">

</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo">

            <i class="fas fa-book-open"></i>
            <span>PERDIG</span>

        </div>

        <ul class="menu">

            <li>

                <a href="index.php">

                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>

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

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">

            <h2>Edit Peminjaman</h2>

        </div>

        <!-- FORM -->
        <div class="form-container">

            <div class="form-header">

                <h3>Form Edit Peminjaman</h3>

            </div>

            <form method="POST">

                <div class="form-group">

                    <label>Nama Anggota</label>

                    <select name="id_user" required>

                        <?php while($u = mysqli_fetch_array($user)){ ?>

                        <option
                        value="<?= $u['id_user']; ?>"

                        <?= ($u['id_user']==$data['id_user'])
                        ? 'selected'
                        : ''; ?>>

                            <?= $u['nama']; ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Buku</label>

                    <select name="id_buku" required>

                        <?php while($b = mysqli_fetch_array($buku)){ ?>

                        <option
                        value="<?= $b['id_buku']; ?>"

                        <?= ($b['id_buku']==$data['id_buku'])
                        ? 'selected'
                        : ''; ?>>

                            <?= $b['judul']; ?>
                            (Stok: <?= $b['stok']; ?>)

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Tanggal Pinjam</label>

                    <input
                    type="date"
                    name="tanggal_pinjam"
                    value="<?= $data['tanggal_pinjam']; ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>Tanggal Kembali</label>

                    <input
                    type="date"
                    name="tanggal_kembali"
                    value="<?= $data['tanggal_kembali']; ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>Status</label>

                    <select name="status">

                        <option value="dipinjam"
                        <?= $data['status']=='dipinjam' ? 'selected' : ''; ?>>

                            Dipinjam

                        </option>

                        <option value="dikembalikan"
                        <?= $data['status']=='dikembalikan' ? 'selected' : ''; ?>>

                            Dikembalikan

                        </option>

                    </select>

                </div>

                <button
                type="submit"
                name="submit"
                class="btn-submit">

                    <i class="fas fa-save"></i>
                    Update Peminjaman

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>