<?php
include '../koneksi.php';

/* =========================
   SIMPAN DATA
========================= */

if(isset($_POST['submit'])){

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $namaFile = $_FILES['cover']['name'];
    $tmpName = $_FILES['cover']['tmp_name'];

    move_uploaded_file(
        $tmpName,
        "../uploads/".$namaFile
    );

    mysqli_query($koneksi, "
    INSERT INTO buku(
        judul,
        penulis,
        penerbit,
        tahun_terbit,
        deskripsi,
        cover,
        stok,
        id_kategori

    )

    VALUES(

        '$judul',
        '$penulis',
        '$penerbit',
        '$tahun',
        '$deskripsi',
        '$namaFile',
        '$stok',
        '$kategori'

    )

    ");

    echo "

    <script>

        alert('Buku berhasil ditambahkan');

        window.location='buku.php';

    </script>

    ";
}

$kategori = mysqli_query($koneksi, "
SELECT * FROM kategori
");

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Tambah Buku</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- CSS -->
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

            <li class="active">
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

        <!-- TOPBAR -->
        <div class="topbar">

            <h2>Tambah Buku</h2>

        </div>

        <!-- FORM -->
        <div class="form-container">

            <div class="form-header">

                <h3>Form Tambah Buku</h3>

            </div>

            <form method="POST"
            enctype="multipart/form-data">

                <!-- JUDUL -->
                <div class="form-group">

                    <label>Judul Buku</label>

                    <input type="text"
                    name="judul"
                    required>

                </div>

                <div class="form-group">

                    <label>Penulis</label>

                    <input type="text"
                    name="penulis"
                    required>

                </div>

                <div class="form-group">

                    <label>Penerbit</label>

                    <input type="text"
                    name="penerbit"
                    required>

                </div>

                <div class="form-group">

                    <label>Tahun Terbit</label>

                    <input type="number"
                    name="tahun"
                    required>

                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea
                    name="deskripsi"
                    rows="8"
                    placeholder="Masukkan deskripsi buku..."><?= isset($data) ? $data['deskripsi'] : ''; ?></textarea>

                </div>

                <div class="form-group">

                    <label>Stok Buku</label>

                    <input type="number"
                    name="stok"
                    required>

                </div>

                <div class="form-group">

                    <label>Kategori</label>

                    <select name="kategori"
                    required>

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        <?php
                        while($data = mysqli_fetch_array($kategori)){
                        ?>

                        <option value="<?= $data['id_kategori']; ?>">

                            <?= $data['nama_kategori']; ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <!-- COVER -->
                <div class="form-group">

                    <label>Cover Buku</label>

                    <input type="file"
                    name="cover"
                    required>

                </div>

                <!-- BUTTON -->
                <button type="submit"
                name="submit"
                class="btn-submit">

                    <i class="fas fa-save"></i>
                    Simpan Buku

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>