<?php
include '../koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi,"
SELECT * FROM user
WHERE id_user='$id'
");

$data = mysqli_fetch_assoc($query);

if(isset($_POST['submit'])){

    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $role     = $_POST['role'];;

    mysqli_query($koneksi,"
    UPDATE user SET

        nama='$nama',
        username='$username',
        email='$email',
        no_hp='$no_hp',
        alamat='$alamat',
        role='$role'

    WHERE id_user='$id'
    ");

    echo "
    <script>

        alert('Data anggota berhasil diperbarui');

        window.location='anggota.php';

    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Anggota</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

        <div class="topbar">

            <h2>Edit Anggota</h2>

        </div>

        <div class="form-container">

            <div class="form-header">

                <h3>Form Edit Anggota</h3>

            </div>

            <form method="POST">

                <div class="form-group">

                    <label>Nama Lengkap</label>

                    <input
                    type="text"
                    name="nama"
                    value="<?= $data['nama']; ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>Username</label>

                    <input
                    type="text"
                    name="username"
                    value="<?= $data['username']; ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>Email</label>

                    <input
                    type="email"
                    name="email"
                    value="<?= $data['email']; ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>No HP</label>

                    <input
                    type="text"
                    name="no_hp"
                    value="<?= $data['no_hp']; ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>Alamat</label>

                    <input
                    type="text"
                    name="alamat"
                    value="<?= $data['alamat']; ?>"
                    required>

                </div>

                <div class="form-group">

                    <label>Role</label>

                    <select
                    name="role"
                    required>

                        <option value="admin"
                        <?= ($data['role']=='admin') ? 'selected' : ''; ?>>
                        Admin
                        </option>

                        <option value="user"
                        <?= ($data['role']=='user') ? 'selected' : ''; ?>>
                        User
                        </option>

                    </select>

                </div>

                <button
                type="submit"
                name="submit"
                class="btn-submit">

                    <i class="fas fa-save"></i>
                    Update Anggota

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>
