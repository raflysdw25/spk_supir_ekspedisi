<?php
  require "functions.php";

  // nik_krwn dengan jabatan supir


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
    <title>Halaman Supir</title>

    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

</head>
<body>
    <div class="container my-5">
      <div class="row my-4">
          <div class="col-lg-7 my-2">
            <h1 class="display-4">Selamat Datang, Rafly Sadewa</h1>
            <p class="text-muted text-monospace">
              Dibawah ini adalah data pesanan yang anda dapatkan
            </p>
          </div>
          
          <div class="col-lg-5 my-3">
            <form action="" class="form-inline float-right">
              <select name="" id="" class="custom-select mr-2">
                <option value="Available">Available</option>
                <option value="Not Available">Not Available</option>
              </select>

              <button class="btn btn-primary mr-2">Set Status</button>

              <a class="btn btn-danger text-white float-right my-2">
                  <i class="fa fa-power-off"></i> Logout
              </a>
            </form>
          </div>
      </div>
    </div>
      
    <main id="content">

      <?php if($jmlhpesanan == 0): ?>
        <div class="container alert alert-danger text-center">
          Tidak terdapat pesanan
        </div>
      <?php die; endif; ?>

      <div id="table-data" class="container">

        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">NO</th>
              <th scope="col">Pemesan</th>
              <th scope="col">Jumlah Pesanan</th>
              <th scope="col">Alamat Pengambilan</th>
              <th scope="col">Alamat Tujuan</th>
              <th scope="col">Jenis Pengiriman</th>
              <th scope="col">Tanggal Sampai</th>
              <th scope="col">Status Pengiriman</th>
            </tr>
          </thead>

          <tbody>
            <?php $no = 1;
            foreach($result as $rslt):?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $rslt["nama_pemesan"]; ?></td>
              <td><?= $rslt["jumlah_pesanan"]; ?></td>
              <td><?= $rslt["alamat_pengambilan"]; ?></td>
              <td><?= $rslt["alamat_tujuan"]; ?></td>
              <td><?= $rslt["jenis_pengiriman"]; ?></td>
              <td><?= $rslt["tanggal_sampai"]; ?></td>
              <td>                
                  <?php if($rslt["status_pengiriman"] == "On Progress"):?>
                    <div class="badge badge-success text-wrap">
                      On Progress
                    </div>
                  <?php else:?>
                    <div class="badge badge-success text-wrap">
                      Searching Driver
                    </div>
                  <?php endif;?>
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