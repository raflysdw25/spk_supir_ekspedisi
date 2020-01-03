<?php 
  require "functions.php";

  session_start();
  // var_dump($_SESSION["login"]);
  // var_dump($_SESSION["id_karyawan"]);
  // Cek user telah login sebagai admin
  if( !isset($_SESSION["login"]) && !isset($_SESSION["id_karyawan"]) && ($_SESSION["jabatan"] == "Admin")  ){
      header("location:login_karyawan.php");
      exit;
  }

  if( isset($_GET["id_krwn"]) && isset($_GET["id_transaksi"]) ){
    $id = $_GET["id_krwn"];
    $id_transaksi = $_GET["id_transaksi"];
    $query_karyawan = "SELECT * FROM karyawan WHERE id_krwn = '$id'";
    $result_krwn = query($query_karyawan)[0];
    // $update_status = $result_krwn["status_krwn"];
    // $query_update_status = "UPDATE karyawan SET status_krwn = '$update_status' 
    //                         WHERE id_krwn ='$id'";
    // mysqli_query($conn,$query_update_status);

    $update_nama = $result_krwn["nama_krwn"];
    $query_update = "UPDATE transaksi_pemesanan SET nama_krwn = '$update_nama' 
                      WHERE id_transaksi ='$id_transaksi'";
    mysqli_query($conn, $query_update);
    
    if ( mysqli_affected_rows($conn) > 0 ) {
        echo "
          <script>
              alert('Data Transaksi '$id_transaksi' sudah mendapatkan driver');
          </script>
        ";
    }
  }

  $id_karyawan = $_SESSION["id_karyawan"];
  $jabatan = $_SESSION["jabatan"];
  // var_dump($id_karyawan); var_dump($jabatan); die;

  // Menampilkan halaman admin

  // Query Transaksi
  $query = "SELECT tr.id_transaksi, p.nama_pemesan, tr.jumlah_pesanan, tr.alamat_pengambilan,
            tr.alamat_tujuan, tr.jenis_pengiriman, tr.tanggal_sampai, tr.status_pengiriman, 
            tr.nama_krwn
            FROM transaksi_pemesanan tr JOIN pemesan p ON (tr.id_pemesan = p.id_pemesan)";
  $result = query($query);
  $jmlhpesanan = count($result);

  // Query data Admin
  $query_admin = "SELECT * FROM karyawan WHERE id_krwn = '$id_karyawan' AND jabatan_krwn = '$jabatan'";
  $admin = query($query_admin)[0];
  // var_dump($admin); die;


  
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
          <h1 class="">Selamat Datang, <?= $admin["nama_krwn"]; ?></h1>
          <p class="text-muted text-monospace">
            Data dibawah ini adalah data pesanan yang dibuat oleh seluruh cabang
          </p>
        </div>
        
        <div id="button" class=" col-lg-5 my-3 text-right">
          <a href="tambah_pegawai.php" class="btn btn-primary p-3">
            <span class="fa fa-plus"></span> Tambah Pegawai
          </a>

          <a href="logout.php" class="btn btn-danger p-3">
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
    
    <div id="table_data" class="container">
      
      <table class="table table-bordered table-responsive-sm">
        <thead class="thead-dark">
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
        <tbody class="bg-light">
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
                <?php if($rslt["nama_krwn"] == "Search Driver"):?>
                    <a href="konversi_data.php?id_transaksi=<?= $rslt["id_transaksi"];?>" class="btn btn-primary">Tentukan Supir</a>
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