<?php
include '../koneksi.php';

if(isset($_POST['submit'])){

    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $password = md5($_POST['password']);
    $role     = $_POST['role'];

    mysqli_query($koneksi,"
    INSERT INTO user(
        nama,
        username,
        email,
        no_hp,
        alamat,
        password,
        role,
        
    )
    VALUES(
        '$nama',
        '$username',
        '$email',
        '$no_hp',
        '$alamat',
        '$password',
        '$role'
    )
    ");

    echo "
    <script>
        alert('Anggota berhasil ditambahkan');
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

<title>Tambah Anggota</title>

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

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">

            <div>
                <h2>Tambah Anggota</h2>
                <p>Tambahkan data anggota baru</p>
            </div>

        </div>

        <!-- FORM -->
        <div class="form-container">

            <div class="form-header">
                <h3>Form Tambah Anggota</h3>
            </div>

            <form method="POST">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input
                    type="text"
                    name="nama"
                    required>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input
                    type="text"
                    name="username"
                    required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input
                    type="email"
                    name="email"
                    required>
                </div>

                <div class="form-group">
                    <label>No HP</label>
                    <input
                    type="text"
                    name="no_hp"
                    required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input
                    type="text"
                    name="alamat"
                    required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input
                    type="password"
                    name="password"
                    required>
                </div>

                <div class="form-group">
                    <label>Role</label>

                    <select
                    name="role"
                    required>

                        <option value="">
                            Pilih Role
                        </option>

                        <option value="admin">
                            Admin
                        </option>

                        <option value="user">
                            User
                        </option>

                    </select>

                </div>

                <button
                type="submit"
                name="submit"
                class="btn-submit">

                    <i class="fas fa-save"></i>
                    Simpan Anggota

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>