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
            <input type="Nama Pesanan" class="form-control" id="Nama Pesanan" " name="Nama Pesanan">
          </div>

          <div class="form-group">
            <label class="" for="AlamatPemesanan">Alamat Pemesanan</label>
            <select name="cabang" id="AlamatPemesanan" class="custom-select">
                <option value="">Jakarta</option>
                <option value="">Bandung</option>
                <option value="">Semarang</option>
                <option value="">Yogyakarta</option>
                <option value="">Surabaya</option>
            </select>
          </div>

          <div class="form-group">
            <label class="" for="AlamatTujuan">Alamat Tujuan</label>
            <select name="cabang" id="AlamatTujuan" class="custom-select">
                <option value="">Jakarta</option>
                <option value="">Bandung</option>
                <option value="">Semarang</option>
                <option value="">Yogyakarta</option>
                <option value="">Surabaya</option>
            </select>
          </div>
          
          <div class="form-group"> 
            <label class="control-label" for="JenisPengiriman">Jenis Pengiriman</label>
            <br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="carcarrier" 
                value="Car Carrier" name="jenis_pengiriman">
                <label class="form-check-label" for="carcarrier">Car Carrier</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="safetyride" 
                value="Safety Ride" name="jenis_pengiriman">
                <label class="form-check-label" for="safetyride">Safety Ride</label>
            </div>
          </div>
          
          <div class="form-group">
            <label class="" for="tanggal">Tanggal Sampai</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control">
          </div>
          
          <div class="text-center">
            <button type="submit" class="btn btn-success">Tambah Pesanan</button>
            <a class="btn btn-danger text-white">Batalkan Pesanan</a>
          </div>
    </form>
  </div>

	</form>
	</div>
</body>
</html>