<?php
include '../koneksi.php';

$query = mysqli_query($koneksi, "
SELECT buku.*, kategori.nama_kategori
FROM buku
LEFT JOIN kategori
ON buku.id_kategori = kategori.id_kategori
ORDER BY id_buku DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Data Buku</title>

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<!-- FONT AWESOME -->
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

            <h2>Data Buku</h2>

        </div>

        <!-- TABLE CONTAINER -->
        <div class="table-container">

            <!-- HEADER -->
            <div class="table-header">

                <h3>Daftar Buku</h3>

                <a href="tambah-buku.php"
                class="btn-primary">

                    <i class="fas fa-plus"></i>
                    Tambah Buku

                </a>

            </div>

            <!-- SEARCH -->
            <div class="search-box">

                <input type="text"
                placeholder="Cari buku..."
                id="searchInput">

            </div>

            <!-- TABLE -->
            <div class="table-responsive">

                <table id="bukuTable">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php
                    $no = 1;

                    while($data = mysqli_fetch_array($query)){
                    ?>

                        <tr>

                            <td><?= $no++; ?></td>

                            <td>

                                <img src="../uploads/<?= $data['cover']; ?>"
                                class="book-cover">

                            </td>

                            <td>
                                <?= $data['judul']; ?>
                            </td>

                            <td>
                                <?= $data['penulis']; ?>
                            </td>

                            <td>
                                <?= $data['penerbit']; ?>
                            </td>

                            <td>
                                <?= $data['tahun_terbit']; ?>
                            </td>

                            <td>
                                <?= $data['nama_kategori']; ?>
                            </td>

                            <td>
                                <?= $data['stok']; ?>
                            </td>

                            <td>
                                <div class="action-button">

                                    <a href="edit-buku.php?id=<?= $data['id_buku']; ?>"
                                    class="btn-warning">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>

                                    <a href="hapus-buku.php?id=<?= $data['id_buku']; ?>"
                                    class="btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus buku ini?')">
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

<!-- SEARCH SCRIPT -->
<script>

const searchInput =
document.getElementById("searchInput");

searchInput.addEventListener("keyup", function(){

    let filter =
    searchInput.value.toLowerCase();

    let rows =
    document.querySelectorAll("#bukuTable tbody tr");

    rows.forEach(row => {

        let text =
        row.innerText.toLowerCase();

        row.style.display =
        text.includes(filter)
        ? ""
        : "none";

    });

});

</script>

</body>
</html>