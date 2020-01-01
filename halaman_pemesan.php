<?php

  require 'functions.php';

  session_start();
  if( !isset($_SESSION["login"]) && !isset($_SESSION["id_pemesan"])){
    header("location:login_pemesan.php");
    exit;
  }

  $id_pemesan = $_SESSION["id_pemesan"];
  $query_transaksi = "SELECT tr.id_transaksi, tr.jumlah_pesanan, tr.alamat_pengambilan,
                      tr.alamat_tujuan, tr.jenis_pengiriman, tr.tanggal_sampai, tr.status_pengiriman, 
                      tr.nama_krwn
                      FROM transaksi_pemesanan tr 
                      WHERE tr.id_pemesan = '$id_pemesan'";
  $transaksi_pemesan = query($query_transaksi);
  $jmlhtransaksi = count($transaksi_pemesan);

  
  $query_pemesan = "SELECT nama_pemesan FROM pemesan WHERE id_pemesan = '$id_pemesan'";
  $pemesan = query($query_pemesan)[0];
  // var_dump($pemesan); die;
  
  
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Pemesanan</title>

    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
</head>
<body>
    <!-- Header -->
    <div class="container">
      <div class="row my-4">   
        <div class="col-lg-7 my-3">
          <h1 class="display-4">Selamat Datang, <?= $pemesan["nama_pemesan"]; ?></h1>
          <small class="text-muted text-monospace">Dibawah ini adalah data pesanan yang anda lakukan</small>
        </div>

        <div id="button" class="col-lg-5 my-4 text-right text-white">
          <a class="btn btn-primary" onClick ='top.location="halaman_tambah_pesanan.php?id_pemesan=<?= $id_pemesan; ?>"'>
            <i class="fa fa-plus"></i> Tambah Pesanan
          </a>  
          <a href="logout.php" class="btn btn-danger px-3">
            <i class="fa fa-power-off"></i> Logout
          </a>
        </div>
      </div>

      <?php 
      if( isset($_SESSION["error_transaksi"])){
        $error_transaksi = $_SESSION["error_transaksi"];
        if($error_transaksi): ?>
          <div class="container alert alert-danger text-center">
            Transaksi gagal, silahkan coba lagi
          </div>
      <?php 
        $_SESSION["error_transaksi"] = [];
        endif; 
      }?>

    </div>

    <main id="content">
    <?php if($jmlhtransaksi == 0): ?>
      <div class="container alert alert-danger text-center">
        Tidak terdapat pesanan
      </div>
    <?php die; endif; ?>

      <div id="table_data" class="container">
        <table class="table table-bordered table-responsive-sm">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">ID Transaksi</th>
                  <th scope="col">Jumlah Pesanan</th>
                  <th scope="col">Alamat Pengambilan</th>
                  <th scope="col">Alamat Tujuan</th>
                  <th scope="col">Jenis Pengiriman</th>
                  <th scope="col">Tanggal Sampai</th>
                  <th scope="col">Status Pengiriman</th>
                </tr>
            </thead>
            <tbody class="bg-light">
                <?php foreach($transaksi_pemesan as $transaksi): ?>
                  <tr>
                    <td><?= $transaksi["id_transaksi"];?></td>
                    <td><?= $transaksi["jumlah_pesanan"];?></td>
                    <td><?= $transaksi["alamat_pengambilan"];?></td>
                    <td><?= $transaksi["alamat_tujuan"];?></td>
                    <td><?= $transaksi["jenis_pengiriman"];?></td>
                    <td><?= $transaksi["tanggal_sampai"];?></td>
                    <td>
                      <?php 
                      if($transaksi["nama_krwn"] == "Search Driver"):
                        echo "Search Driver";
                      else: 
                        $transaksi["status_pengiriman"];
                      endif;
                      ?>
                    </td>
                  </tr>
                <?php endforeach;?>
            </tbody>
        </table>
      </div>
    </main>
      
    


    <script src="libraries/jquery/jquery.js"></script>
    <script src="libraries/bootstrap/js/bootstrap.js"></script>
    <script src="scripts/main.js"></script>
</body>
</html>