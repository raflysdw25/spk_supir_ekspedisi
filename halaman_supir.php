<?php
  require "functions.php";
  // nik_krwn dengan jabatan supir
  session_start();
  // Cek user telah login sebagai supir
  if( !isset($_SESSION["login"]) && !isset($_SESSION["id_karyawan"]) && !isset($_SESSION["jabatan"])){        
    echo "
        <script>
            alert('Belum melakukan login, silahkan login terlebih dahulu');
            document.location.href='login_karyawan.php';
        </script>
    ";
        exit;
  }else if($_SESSION["jabatan"] != "Supir"){
      echo "
      <script>
          alert('Anda bukan supir, silahkan login sebagai supir');
          document.location.href='login_karyawan.php';
      </script>
      ";
      session_destroy();
      exit;
  }

  $id_karyawan = $_SESSION["id_karyawan"];
  $jabatan = $_SESSION["jabatan"];
  // var_dump($id_karyawan); var_dump($jabatan); die;

  // Query data Supir
  $query_supir = "SELECT * FROM karyawan WHERE id_krwn = '$id_karyawan' AND jabatan_krwn = '$jabatan'";
  $supir = query($query_supir)[0];
  $nama_krwn = $supir["nama_krwn"];

  // Menampilkan halaman admin
  $query = "SELECT tr.id_transaksi, p.nama_pemesan, tr.jumlah_pesanan, tr.alamat_pengambilan,
            tr.alamat_tujuan, tr.jenis_pengiriman, tr.tanggal_sampai, tr.status_pengiriman
            FROM transaksi_pemesanan tr JOIN pemesan p ON (tr.id_pemesan = p.id_pemesan)
            WHERE tr.nama_krwn = '$nama_krwn'
            ORDER BY tr.id_transaksi DESC";
  $result = query($query);
  $jmlhpesanan = count($result);

  


  // Ubah Status Supir
  if( isset($_POST["status"]) ){
     $status_krwn = $_POST["status_karyawan"];

     $query_status = "UPDATE karyawan SET status_krwn = '$status_krwn' 
                      WHERE id_krwn = '$id_karyawan'";
     $update_status = mysqli_query($conn, $query_status);

     if( mysqli_affected_rows($conn) > 0 ){
       header("location:halaman_supir.php");
       exit;
     }

  }

  // Ubah Status Pengiriman
  if( isset($_GET["id_transaksi"]) && isset($_GET["status_pengiriman"]) ){
    $id_transaksi = $_GET["id_transaksi"];
    $status_pengiriman = $_GET["status_pengiriman"];

    $query_pengiriman = "UPDATE transaksi_pemesanan SET status_pengiriman ='$status_pengiriman'
                         WHERE id_transaksi = '$id_transaksi'";
    $update_pengiriman = mysqli_query($conn, $query_pengiriman);

    if( mysqli_affected_rows($conn) > 0 ){
      header("location:halaman_supir.php");
      exit;
    }
  }
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
            <h1 class="display-4">Selamat Datang, <?= $supir["nama_krwn"]; ?> </h1>
            <p class="text-muted text-monospace">
              Dibawah ini adalah data pesanan yang anda dapatkan
            </p>
          </div>
          
          <div class="col-lg-5 my-3">
            <form action="" method="POST" class="form-inline float-right">
              <select name="status_karyawan" id="" class="custom-select mr-2">
                <option value="Available" <?php if($supir["status_krwn"] == "Available") echo "selected"; ?> >Available</option>
                <option value="Not Available" <?php if($supir["status_krwn"] == "Not Available") echo "selected";?> >Not Available</option>
              </select>

              <button type="submit" name="status" class="btn btn-primary mr-2">Set Status</button>

              <a href="logout.php" class="btn btn-danger text-white float-right my-2">
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

      <div id="table_data" class="container">

        <table class="table table-bordered table-responsive-sm">
          <thead class="thead-dark">
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

          <tbody class="bg-light">
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
                    <div class="badge badge-secondary text-wrap">
                      On Progress
                    </div>
                    <a 
                    href="halaman_supir.php?id_transaksi=<?= $rslt["id_transaksi"];?>&status_pengiriman=<?= 'Deliver' ?>" 
                    class="btn btn-success">Deliver</a>
                  <?php elseif($rslt["status_pengiriman"] == "Deliver"):?>
                    <div class="badge badge-warning text-wrap">
                      Deliver
                    </div>
                    <a 
                    href="halaman_supir.php?id_transaksi=<?= $rslt["id_transaksi"];?>&status_pengiriman=<?= 'Delivered' ?>" 
                    class="btn btn-success">Finish</a>  
                  <?php else:?>
                    <div class="badge badge-success text-wrap">
                      Delivered
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