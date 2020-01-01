<?php 
require 'functions.php';

if( isset($_POST["submit"]) ) {


if( tambah_pesanan($_POST) > 0){
	echo "
		<script>
			alert('Pemesanan berhasil ditambahkan!');
			document.location.href = 'halaman_pemesan.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Pemesanan gagal ditambahkan!');
			document.location.href = 'halaman_tambah_pemesanan.php';
		</script>
	";
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
        <h1 class="text-center">Tambah Pesanan</h1>

        <form class="" action="">
          
          <div class="form-group">
            <label class="" for="Nama Pesanan">Nama Pesanan</label>
            <input type="Nama Pesanan" class="form-control" id="Nama Pesanan" " name="Nama Pesanan" required>
          </div>

          <div class="form-group">
            <label class="" for="AlamatPemesanan">Alamat Pemesanan</label>
            <select name="Alamat Pemesanan" id="AlamatPemesanan" class="custom-select">
                <option value="">Jakarta</option>
                <option value="">Bandung</option>
                <option value="">Semarang</option>
                <option value="">Yogyakarta</option>
                <option value="">Surabaya</option>
            </select>
          </div>

          <div class="form-group">
            <label class="" for="AlamatTujuan">Alamat Tujuan</label>
            <select name="Alamat Tujuan" id="AlamatTujuan" class="custom-select">
                <option value="">Jakarta</option>
                <option value="">Bandung</option>
                <option value="">Semarang</option>
                <option value="">Yogyakarta</option>
                <option value="">Surabaya</option>
            </select>
          </div>
          
          <div class="form-group"> 
            <label class="control-label" for="JenisPengiriman" required>Jenis Pengiriman</label>
            <br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="carcarrier" 
                value="Car Carrier" name="Jenis Pengiriman">
                <label class="form-check-label" for="carcarrier">Car Carrier</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="safetyride" 
                value="Safety Ride" name="Jenis Pengiriman">
                <label class="form-check-label" for="safetyride">Safety Ride</label>
            </div>
          </div>
          
          <div class="form-group">
            <label class="" for="tanggal">Tanggal Sampai</label>
            <input type="date" name="Tanggal" id="tanggal" class="form-control" required>
          </div>
          
          <div class="text-center">
            <button type="submit" class="btn btn-success" name="submit">Tambah Pesanan</button>
            <a class="btn btn-danger text-white">Batalkan Pesanan</a>
          </div>
    </form>
  </div>

	</form>
	</div>
</body>
</html>