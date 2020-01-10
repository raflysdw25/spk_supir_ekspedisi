<?php 
  require 'functions.php';
  session_start();
  if ( !isset($_SESSION["login"]) && !isset($_SESSION["id_pemesan"]) ) {
    echo "
            <script>
                alert('Belum melakukan login, silahkan login terlebih dahulu');
                document.location.href='login_pemesan.php';
            </script>
        ";
    exit;
  }

  $id_pemesan = $_GET['id_pemesan'];
  // var_dump($id_pemesan); die;

  $query_all = "SELECT * FROM pemesan WHERE id_pemesan != $id_pemesan";
  $pemesan_all = query($query_all);

  $query_one = "SELECT * FROM pemesan WHERE id_pemesan =$id_pemesan";
  $pemesan_one = query($query_one)[0];


  if( isset($_POST["submit"]) ) {
      // var_dump($_POST); die;
      $transaksi = tambah_pesanan($_POST);

    if( $transaksi > 0){
      echo "
        <script>
          alert('Pemesanan berhasil ditambahkan!');
          document.location.href='halaman_pemesan.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Pesanan gagal ditambahkan!');
          
        </script>
      ";
       echo mysqli_error($conn); 
      $_SESSION["error_transaksi"] = true;
    }

  }

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
	  <div class="container" style="margin-top: 5%"> 
        <div id="form_tambah">
          <h1 class="text-center display-4">Tambah Pesanan</h1>
            <form class="" action="" method="POST">
                
                <!-- Atur nama pemesan sesuai dengan id_pemesan -->
                <div class="form-group">
                  <label class="" for="Nama Pesanan">Nama Pemesan</label>
                  <input type="hidden" name="id_pemesan" value="<?= $pemesan_one["id_pemesan"];?>">
                  <input type="text" class="form-control" id="Nama Pesanan" " name="" value="<?= $pemesan_one["nama_pemesan"];?>" readonly>
                </div>

                <div class="form-group">
                  <label for="jumlahPesanan">Jumlah Pesanan</label>
                  <input type="number" name="Jumlah_Pesanan" id="" class="form-control" placeholder="Jumlah Pesanan" aria-describedby="helpId">
                </div>


                <!-- Atur sesuai alamat pemesan sesuai dengan id_pemesan -->
                <div class="form-group">
                  <label class="" for="AlamatTujuan">Cabang Tujuan</label>
                  <input type="text" name="Alamat_Tujuan" id="" class="form-control" value="<?= $pemesan_one["nama_pemesan"];?>" readonly>
                </div>


                <!-- Buat list alamat tujuan, ambil dari database, kemudian valuenya diubah dengan alamatnya dari pemesan -->
                <div class="form-group">
                  <label class="" for="AlamatPengambilan">Cabang Pengambilan</label>
                  <select name="Alamat_Pengambilan" id="AlamatTujuan" class="custom-select">
                      <option value="" aria-readonly="true">Pilih Alamat Tujuan</option>
                      <?php foreach($pemesan_all as $pemesan): ?>
                        <option value="<?= $pemesan["nama_pemesan"]; ?>"> <?= $pemesan["nama_pemesan"]; ?> </option>
                      <?php endforeach;?>
                  </select>
                </div>
                
                <div class="form-group"> 
                  <label class="control-label" for="JenisPengiriman">Jenis Pengiriman</label>
                  <br>
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="carcarrier" 
                      value="Car Carrier" name="Jenis_Pengiriman">
                      <label class="form-check-label" for="carcarrier">Car Carrier</label>
                  </div>
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="safetyride" 
                      value="Safety Ride" name="Jenis_Pengiriman">
                      <label class="form-check-label" for="safetyride">Safety Ride</label>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="" for="tanggal">Tanggal Sampai</label>
                  <input type="date" name="Tanggal" id="tanggal" class="form-control" required>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-success" name="submit">Tambah Pesanan</button>
                  <a href="halaman_pemesan.php" class="btn btn-danger text-white">Batalkan Pesanan</a>
                </div>

            </form>
        </div>
	</div>
</body>
</html>