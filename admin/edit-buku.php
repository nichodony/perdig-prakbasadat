<?php
include '../koneksi.php';

$id = $_GET['id'];

$buku = mysqli_query($koneksi,"
SELECT * FROM buku
WHERE id_buku='$id'
");

$dataBuku = mysqli_fetch_assoc($buku);

$kategori = mysqli_query($koneksi,"
SELECT * FROM kategori
");

if(isset($_POST['submit'])){

    $judul     = $_POST['judul'];
    $penulis   = $_POST['penulis'];
    $penerbit  = $_POST['penerbit'];
    $tahun     = $_POST['tahun'];
    $deskripsi = $_POST['deskripsi'];
    $stok      = $_POST['stok'];
    $idKategori= $_POST['kategori'];

    $coverLama = $dataBuku['cover'];

    if($_FILES['cover']['name'] != ''){

        $coverBaru = $_FILES['cover']['name'];
        $tmp       = $_FILES['cover']['tmp_name'];

        move_uploaded_file(
            $tmp,
            "../uploads/".$coverBaru
        );

    }else{

        $coverBaru = $coverLama;
    }

    mysqli_query($koneksi,"
    UPDATE buku SET

        judul='$judul',
        penulis='$penulis',
        penerbit='$penerbit',
        tahun_terbit='$tahun',
        deskripsi='$deskripsi',
        stok='$stok',
        cover='$coverBaru',
        id_kategori='$idKategori'

    WHERE id_buku='$id'
    ");

    echo "
    <script>

        alert('Data buku berhasil diperbarui');

        window.location='buku.php';

    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Buku</title>

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

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">

            <h2>Edit Buku</h2>

        </div>

        <!-- FORM -->
        <div class="form-container">

            <div class="form-header">

                <h3>Form Edit Buku</h3>

            </div>

            <form method="POST"
            enctype="multipart/form-data">

                <!-- JUDUL -->
                <div class="form-group">

                    <label>Judul Buku</label>

                    <input
                    type="text"
                    name="judul"
                    value="<?= $dataBuku['judul']; ?>"
                    required>

                </div>

                <!-- PENULIS -->
                <div class="form-group">

                    <label>Penulis</label>

                    <input
                    type="text"
                    name="penulis"
                    value="<?= $dataBuku['penulis']; ?>"
                    required>

                </div>

                <!-- PENERBIT -->
                <div class="form-group">

                    <label>Penerbit</label>

                    <input
                    type="text"
                    name="penerbit"
                    value="<?= $dataBuku['penerbit']; ?>"
                    required>

                </div>

                <!-- TAHUN -->
                <div class="form-group">

                    <label>Tahun Terbit</label>

                    <input
                    type="number"
                    name="tahun"
                    value="<?= $dataBuku['tahun_terbit']; ?>"
                    required>

                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea
                    name="deskripsi"
                    rows="8"
                    placeholder="Masukkan deskripsi buku..."><?= isset($data) ? $data['deskripsi'] : ''; ?></textarea>

                </div>

                <!-- STOK -->
                <div class="form-group">

                    <label>Stok Buku</label>

                    <input
                    type="number"
                    name="stok"
                    value="<?= $dataBuku['stok']; ?>"
                    required>

                </div>

                <!-- KATEGORI -->
                <div class="form-group">

                    <label>Kategori</label>

                    <select name="kategori" required>

                        <?php
                        while($kat = mysqli_fetch_assoc($kategori)){
                        ?>

                        <option
                        value="<?= $kat['id_kategori']; ?>"

                        <?= ($kat['id_kategori'] == $dataBuku['id_kategori']) ? 'selected' : ''; ?>>

                        <?= $kat['nama_kategori']; ?>

                        </option>

                        <?php } ?>

                    </select>

                </div>

                <!-- COVER LAMA -->
                <div class="form-group">

                    <label>Cover Saat Ini</label>

                    <br><br>

                    <img
                    src="../uploads/<?= $dataBuku['cover']; ?>"
                    class="book-cover">

                </div>

                <!-- COVER BARU -->
                <div class="form-group">

                    <label>Ganti Cover (Opsional)</label>

                    <input
                    type="file"
                    name="cover">

                </div>

                <!-- BUTTON -->
                <button
                type="submit"
                name="submit"
                class="btn-submit">

                    <i class="fas fa-save"></i>
                    Update Buku

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>