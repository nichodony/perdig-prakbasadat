<?php
include '../koneksi.php';

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
ORDER BY peminjaman.id_peminjaman DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Peminjaman</title>

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

            <h2>Data Peminjaman</h2>

            <p>Kelola seluruh transaksi peminjaman</p>

        </div>

        <div class="table-container">

            <div class="table-header">

                <h3>Daftar Peminjaman</h3>

                <a href="laporan-peminjaman.php"
                class="btn-primary"
                target="_blank">

                    <i class="fas fa-print"></i>

                    Cetak Laporan

                </a>

            </div>

            <div class="search-box">

                <i class="fas fa-search"></i>

                <input
                type="text"
                id="searchInput"
                placeholder="Cari data peminjaman...">

            </div>

            <div class="table-responsive">

                <table id="peminjamanTable">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Status</th>
                            <th>Kode</th>
                            <th>Catatan</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php $no = 1; ?>

                    <?php while($data = mysqli_fetch_assoc($query)){ ?>

                        <tr>

                            <td><?= $no++; ?></td>

                            <td><?= $data['nama']; ?></td>

                            <td><?= $data['judul']; ?></td>

                            <td>

                                <span class="status <?= strtolower($data['status']); ?>">

                                    <?= ucfirst($data['status']); ?>

                                </span>

                            </td>

                            <td>

                                <?= !empty($data['kode_peminjaman'])
                                ? $data['kode_peminjaman']
                                : '-'; ?>

                            </td>

                            <td>

                                <?= !empty($data['catatan_admin'])
                                ? $data['catatan_admin']
                                : '-'; ?>

                            </td>

                            <td>

                                <div class="action-button">

                                    <?php if(strtolower($data['status']) == 'menunggu'){ ?>

                                        <a
                                        href="setujui-peminjaman.php?id=<?= $data['id_peminjaman']; ?>"
                                        class="btn-success">

                                            <i class="fas fa-check"></i>

                                            Setujui

                                        </a>

                                        <a
                                        href="tolak-peminjaman.php?id=<?= $data['id_peminjaman']; ?>"
                                        class="btn-danger1">

                                            <i class="fas fa-times"></i>

                                            Tolak

                                        </a>

                                    <?php } ?>

                                    <?php if(strtolower($data['status']) == 'disetujui'){ ?>

                                        <a
                                        href="verifikasi.php?id=<?= $data['id_peminjaman']; ?>"
                                        class="btn-primary">

                                            <i class="fas fa-shield-alt"></i>

                                            Verifikasi

                                        </a>

                                    <?php } ?>

                                    <?php if(strtolower($data['status']) == 'dipinjam'){ ?>

                                        <a
                                        href="pengembalian.php?id=<?= $data['id_peminjaman']; ?>"
                                        class="btn-kembali">

                                            <i class="fas fa-undo"></i>

                                            Kembalikan

                                        </a>

                                    <?php } ?>

                                    <?php if(strtolower($data['status']) == 'dikembalikan'){ ?>

                                        <span class="status selesai">

                                            Selesai

                                        </span>

                                    <?php } ?>

                                    <?php if(strtolower($data['status']) == 'ditolak'){ ?>

                                        <span class="status ditolak">

                                            Ditolak

                                        </span>

                                    <?php } ?>

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

<script>

document
.getElementById('searchInput')
.addEventListener('keyup', function(){

    let filter = this.value.toLowerCase();

    document
    .querySelectorAll('#peminjamanTable tbody tr')
    .forEach(row => {

        row.style.display =
        row.innerText.toLowerCase().includes(filter)
        ? ''
        : 'none';

    });

});

</script>

</body>
</html>