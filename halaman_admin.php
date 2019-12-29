<?php 
  require "functions.php";

  // Menampilkan halaman admin
  $query = "SELECT tr.id_transaksi, p.nama_pemesan, tr.jumlah_pesanan, tr.alamat_pengambilan,
            tr.alamat_tujuan, tr.jenis_pengiriman, tr.tanggal_sampai, tr.status_pengiriman, k.nama_krwn
            FROM transaksi_pemesanan tr JOIN pemesan p ON (tr.id_pemesan = p.id_pemesan) JOIN karyawan k ON
            (tr.nik_krwn = k.nik_krwn)";
  $result = query($query);
  $jmlhpesanan = count($result);
  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Admin</title>

    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

</head>
<body>
    <div class="container">
      <div class=" row my-4">

        <div class="col-lg-7 my-2">
          <h1 class="">Selamat Datang, Admin Super</h1>
          <p class="text-muted text-monospace">
            Data dibawah ini adalah data pesanan yang dibuat oleh seluruh cabang
          </p>
        </div>
        
        <div id="button" class=" col-lg-5 my-3 text-right">
          <a href="" class="btn btn-primary p-3">
            <span class="fa fa-plus"></span> Tambah Pegawai
          </a>

          <a href="" class="btn btn-danger p-3">
            <span class="fa fa-power-off"></span> Logout
          </a>
        </div>

        <br>
      </div>
    </div>  
    

  <main id="content">

    <?php if($jmlhpesanan == 0): ?>
      <div class="container alert alert-danger text-center">
        Tidak terdapat pesanan
      </div>
    <?php die; endif; ?>
    
    <div id="table-data" class="container">
      
      <table class="table table-bordered table-responsive-sm">
        <thead>
          <tr>
            <th scope="col">NO</th>
            <th scope="col">NAMA PEMESAN</th>
            <th scope="col">JUMLAH PESANAN</th>
            <th scope="col">ALAMAT PENGAMBILAN</th>
            <th scope="col">ALAMAT TUJUAN</th>
            <th scope="col">JENIS PENGIRIMAN</th>
            <th scope="col">TANGGAL SAMPAI</th>
            <th scope="col">PENGIRIM UNIT</th>
          </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($result as $rslt): ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $rslt["nama_pemesan"]; ?></td>
              <td><?= $rslt["jumlah_pesanan"]; ?></td>
              <td><?= $rslt["alamat_pengambilan"]; ?></td>
              <td><?= $rslt["alamat_tujuan"]; ?></td>
              <td><?= $rslt["jenis_pengiriman"]; ?></td>
              <td><?= $rslt["tanggal_sampai"]; ?></td>
              <td>
                <?php if($rslt["nik_krwn"] == "NULL"):?>
                    <a href="#" class="btn">Tentukan Supir</a>
                <?php else:?>
                  <p><?= $rslt["nama_krwn"]; ?></p>
                <?php endif;?>
              </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
      </table>
      
    </div>

  </main>
</body>
</html>