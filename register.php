<?php

include 'koneksi.php';

/* =========================
   REGISTER
========================= */

if(isset($_POST['register'])){

    $nama       = $_POST['nama'];
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = md5($_POST['password']);
    $no_hp      = $_POST['no_hp'];
    $alamat     = $_POST['alamat'];

    /* CEK USERNAME */
    $cek = mysqli_query($koneksi, "

    SELECT * FROM user

    WHERE username='$username'

    ");

    if(mysqli_num_rows($cek) > 0){

        $error = "Username sudah digunakan!";

    } else {

        mysqli_query($koneksi, "

        INSERT INTO user
        (
            nama,
            username,
            password,
            role,
            email,
            no_hp,
            alamat
        )

        VALUES
        (
            '$nama',
            '$username',
            '$password',
            'user',
            '$email',
            '$no_hp',
            '$alamat'

        )

        ");

        $success = "Register berhasil!";

    }

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Register - PERDIG</title>

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<!-- ICON -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;

    font-family:'Poppins',sans-serif;
}

body{

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(
        135deg,
        #6366f1,
        #8b5cf6
    );

    padding:20px;
}

.register-card{

    width:100%;
    max-width:450px;

    background:white;

    padding:40px;

    border-radius:30px;

    box-shadow:
    0 20px 40px rgba(0,0,0,0.15);
}

.logo{

    text-align:center;

    margin-bottom:30px;
}

.logo i{

    font-size:60px;

    color:#6366f1;

    margin-bottom:10px;
}

.logo h1{

    font-size:34px;

    color:#1e293b;
}

.logo p{

    color:#64748b;
}

.form-group{

    margin-bottom:20px;
}

.form-group label{

    display:block;

    margin-bottom:8px;

    font-weight:500;

    color:#334155;
}

.form-group input{

    width:100%;

    padding:14px 16px;

    border:none;

    border-radius:14px;

    background:#f1f5f9;

    outline:none;

    font-size:15px;
}

.register-btn{

    width:100%;

    border:none;

    padding:14px;

    border-radius:14px;

    background:
    linear-gradient(
        135deg,
        #6366f1,
        #8b5cf6
    );

    color:white;

    font-size:16px;

    font-weight:600;

    cursor:pointer;

    transition:0.3s;
}

.register-btn:hover{

    transform:translateY(-2px);
}

.error{

    background:#fee2e2;

    color:#dc2626;

    padding:12px;

    border-radius:12px;

    margin-bottom:20px;

    font-size:14px;
}

.success{

    background:#dcfce7;

    color:#16a34a;

    padding:12px;

    border-radius:12px;

    margin-bottom:20px;

    font-size:14px;
}

.login-link{

    text-align:center;

    margin-top:20px;
}

.login-link a{

    text-decoration:none;

    color:#6366f1;

    font-weight:600;
}

.back-link{

    text-align:center;

    margin-top:15px;
}

.back-link a{

    text-decoration:none;

    color:#64748b;

    font-size:14px;
}

.footer{

    text-align:center;

    margin-top:25px;

    color:#64748b;

    font-size:14px;
}

</style>

</head>

<body>

<div class="register-card">

    <!-- LOGO -->
    <div class="logo">

        <i class="fas fa-user-plus"></i>

        <h1>Register</h1>

        <p>Buat akun PERDIG Library</p>

    </div>

    <!-- ERROR -->
    <?php if(isset($error)){ ?>

        <div class="error">

            <?= $error; ?>

        </div>

    <?php } ?>

    <!-- SUCCESS -->
    <?php if(isset($success)){ ?>

        <div class="success">

            <?= $success; ?>

        </div>

    <?php } ?>

    <!-- FORM -->
    <form method="POST">

        <!-- NAMA -->
        <div class="form-group">

            <label>Nama Lengkap</label>

            <input type="text"
            name="nama"
            placeholder="Masukkan nama lengkap"
            required>

        </div>

        <!-- USERNAME -->
        <div class="form-group">

            <label>Username</label>

            <input type="text"
            name="username"
            placeholder="Masukkan username"
            required>

        </div>

        <!-- EMAIL -->
        <div class="form-group">

            <label>Email</label>

            <input type="email"
            name="email"
            placeholder="Masukkan email"
            required>

        </div>

        <div class="form-group">

            <label>No HP</label>

            <input type="text"
            name="no_hp"
            placeholder="Masukkan nomor hp"
            required>

        </div>

        <div class="form-group">

            <label>Alamat</label>

            <input type="text"
            name="alamat"
            placeholder="Masukkan alamat"
            required>

        </div>

        <!-- PASSWORD -->
        <div class="form-group">

            <label>Password</label>

            <input type="password"
            name="password"
            placeholder="Masukkan password"
            required>

        </div>

        <!-- BUTTON -->
        <button type="submit"
        name="register"
        class="register-btn">

            <i class="fas fa-user-plus"></i>
            Register

        </button>

    </form>

    <!-- LOGIN -->
    <div class="login-link">

        Sudah punya akun?

        <a href="login-user.php">

            Login disini

        </a>

    </div>

    <!-- BACK -->
    <div class="back-link">

        <a href="index.php">

            Kembali

        </a>

    </div>

    <!-- FOOTER -->
    <div class="footer">

        © 2026 PERDIG Library

    </div>

</div>

</body>
</html>