<?php
include '../koneksi.php';

$query = mysqli_query($koneksi, "
SELECT * FROM user
WHERE role='user'
ORDER BY id_user DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Data Anggota</title>

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<!-- ICON -->
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

            <li>
                <a href="buku.php">
                    <i class="fas fa-book"></i>
                    <span>Data Buku</span>
                </a>
            </li>

            <li class="active">
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

            <h2>Data Anggota</h2>

        </div>

        <!-- TABLE -->
        <div class="table-container">

            <div class="table-header">

                <h3>Daftar Anggota</h3>

                <a href="tambah-anggota.php"
                class="btn-primary">

                    <i class="fas fa-plus"></i>
                    Tambah Anggota

                </a>

            </div>

            <!-- SEARCH -->
            <div class="search-box">

                <input type="text"
                id="searchInput"
                placeholder="Cari anggota...">

            </div>

            <!-- TABLE -->
            <div class="table-responsive">

                <table id="anggotaTable">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php
                    $no = 1;

                    while($data = mysqli_fetch_array($query)){
                    ?>

                        <tr>

                            <td>
                                <?= $no++; ?>
                            </td>

                            <td>
                                <?= $data['nama']; ?>
                            </td>

                            <td>
                                <?= $data['username']; ?>
                            </td>

                            <td>
                                <?= $data['email']; ?>
                            </td>

                            <td>
                                <?= $data['no_hp']; ?>
                            </td>

                            <td>
                                <?= $data['alamat']; ?>
                            </td>

                            <td>

                                <div class="action-button">

                                    <a href="edit-anggota.php?id=<?= $data['id_user']; ?>"
                                    class="btn-edit">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <a href="hapus-anggota.php?id=<?= $data['id_user']; ?>"
                                    class="btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus anggota?')">

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

<!-- SEARCH -->
<script>

const searchInput =
document.getElementById("searchInput");

searchInput.addEventListener("keyup", function(){

    let filter =
    searchInput.value.toLowerCase();

    let rows =
    document.querySelectorAll("#anggotaTable tbody tr");

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