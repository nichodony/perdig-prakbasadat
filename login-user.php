<?php
session_start();

include 'koneksi.php';

/* =========================
   LOGIN USER
========================= */

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "

    SELECT * FROM user

    WHERE username='$username'
    AND password='$password'
    AND role='user'

    ");

    if(mysqli_num_rows($query) > 0){

        $data = mysqli_fetch_array($query);

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = 'user';

        header("Location: user/index.php");

    } else {

        $error = "Username atau password salah!";

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Login User - PERDIG</title>

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

.login-card{

    width:100%;
    max-width:430px;

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

.login-btn{

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

.login-btn:hover{

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

.register-link{

    text-align:center;

    margin-top:20px;
}

.register-link a{

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

<div class="login-card">

    <!-- LOGO -->
    <div class="logo">

        <i class="fas fa-user-graduate"></i>

        <h1>Login User</h1>

        <p>PERDIG Library</p>

    </div>

    <!-- ERROR -->
    <?php if(isset($error)){ ?>

        <div class="error">

            <?= $error; ?>

        </div>

    <?php } ?>

    <!-- FORM -->
    <form method="POST">

        <!-- USERNAME -->
        <div class="form-group">

            <label>Username</label>

            <input type="text"
            name="username"
            placeholder="Masukkan username"
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
        name="login"
        class="login-btn">

            <i class="fas fa-sign-in-alt"></i>
            Login

        </button>

    </form>

    <!-- REGISTER -->
    <div class="register-link">

        Belum punya akun?

        <a href="register.php">

            Register disini

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