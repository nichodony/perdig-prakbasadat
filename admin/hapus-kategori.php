<?php

include '../koneksi.php';

if(isset($_GET['id'])){

    $id = (int) $_GET['id'];

    $hapus = mysqli_query(
        $koneksi,
        "DELETE FROM kategori
         WHERE id_kategori = '$id'"
    );

    if($hapus){

        header("Location: kategori.php");
        exit();

    }else{

        echo "Error: " . mysqli_error($koneksi);

    }

}else{

    header("Location: kategori.php");
    exit();

}