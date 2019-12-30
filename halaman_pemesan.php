<?php

      require 'functions.php';

      session_start();
      if ( !isset($_SESSION["login"]) && !isset($_SESSION["id_pemesan"])) {
        header("location:login_pemesan.php");
        exit;
      }
      
      $id_pemesan = $_SESSION["id_pemesan"];

      // Data pemesan
      $pemesan = query("SELECT * FROM pemesan WHERE id_pemesan = $id_pemesan")[0];

      // $result = query("SELECT * FROM transaksi_pemesanan WHERE id_pemesan = $id_pemesan");
      $query = "SELECT tr.id_transaksi, tr.jumlah_pesanan, tr.alamat_pengambilan,
                tr.alamat_tujuan, tr.jenis_pengiriman, tr.tanggal_sampai,
                tr.status_pengiriman, k.nama_krwn 
                FROM transaksi_pemesanan tr JOIN karyawan k ON (tr.id_krwn = k.id_krwn)
                JOIN pemesan p ON (tr.id_pemesan = p.id_pemesan)
                WHERE tr.id_pemesan = $id_pemesan"; //Untuk where id_pemesan
      $result = query($query);
      // var_dump($result); die;
      $jmlpesanan = count($result);


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
    <div class="container">

      <div class="title my-3">
        <h1 class="display-4">Selamat Datang, <?= $pemesan["nama_pemesan"]; ?></h1>
        <small class="text-muted text-monospace">Dibawah ini adalah data pesanan yang anda lakukan</small>
      </div>

      <div id="button" class="my-4">
        <a href="#" class="btn btn-primary">
          <i class="fa fa-plus"></i> Tambah Pesanan
        </a>  
        <a href="logout_pemesan.php" class="btn btn-danger float-right px-3">
          <i class="fa fa-power-off"></i> Logout
        </a>
      </div>
      </div>

      <main id="content">
      <?php if($jmlpesanan == 0):?>
          <div class="container alert alert-danger text-center">
            Tidak terdapat pesanan
          </div>
      <?php die; endif; ?>  

      <div id="table-data" class="container">
        <table class="table table-bordered table-responsive-sm">
            <thead>
                <tr>
                  <th scope="col">ID Transaksi</th>
                  <th scope="col">Jumlah Pesanan</th>
                  <th scope="col">Alamat Pengambilan</th>
                  <th scope="col">Alamat Tujuan</th>
                  <th scope="col">Jenis Pengiriman</th>
                  <th scope="col">Tanggal Sampai</th>
                  <th scope="col">Status Pengiriman</th>
                  <th scope="col">Pengirim</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($result as $rslt): ?>
              <tr>
                <td><?= $rslt["id_transaksi"]; ?></td>
                <td><?= $rslt["jumlah_pesanan"]; ?></td>
                <td><?= $rslt["alamat_pengambilan"]; ?></td>
                <td><?= $rslt["alamat_tujuan"]; ?></td>
                <td><?= $rslt["jenis_pengiriman"]; ?></td>
                <td><?= $rslt["tanggal_sampai"]; ?></td>
                <td><?= $rslt["status_pengiriman"]; ?></td>
                <td><?= $rslt["nama_krwn"]; ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
      </div>
      </main>

    <script src="libraries/jquery/jquery.js"></script>
    <script src="libraries/bootstrap/js/bootstrap.js"></script>
    <script src="scripts/main.js"></script>
</body>
</html>