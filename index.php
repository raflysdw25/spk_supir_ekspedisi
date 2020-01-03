<?php
    require 'functions.php';
    
    session_start();
    if( isset($_SESSION["login"])){
        if( isset($_SESSION["id_karyawan"]) ){
            if($_SESSION["id_karyawan"] == "Supir"){
                header("locaion:halaman_supir.php");
            }else{
                header("location:halaman_admin.php");
            }
        }else if( isset($_SESSION["id_pemesan"]) ){
            header("location:halaman_pemesan.php");
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Pendukung Keputusan Supir Ekspedisi</title>

    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

</head>
<body>
    
    <div class="container">
        <div id="content_button" class="text-center">
            <h1>SISTEM PENDUKUNG KEPUTUSAN SUPIR EKSPEDISI</h1>
            <p class="text-monospace h4">Silahkan pilih menu dibawah untuk melakukan login</p>
            <a href="login_karyawan.php" class="btn mx-3 my-4">
                <span class="fa fa-address-card fa-10x"></span> <br>
                <p class="my-2 h4">Masuk Sebagai Karyawan</p>
            </a>
            <a href="login_pemesan.php" class="btn mx-3 my-4">
                <span class="fa fa-building fa-10x"></span> <br>
                <p class="my-2 h4">Masuk Sebagai Cabang</p>
            </a>
        </div>
    </div>

    <script src="libraries/jquery/jquery.js"></script>
    <script src="libraries/bootstrap/js/bootstrap.js"></script>
    <script src="scripts/main.js"></script>
</body>
</html>