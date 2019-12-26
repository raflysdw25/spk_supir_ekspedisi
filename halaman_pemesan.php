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
        <h1 class="display-4">Selamat Datang, Cabang Bogor</h1>
        <small class="text-muted text-monospace">Dibawah ini adalah data pesanan yang anda lakukan</small>
      </div>

      <div id="button" class="my-4">
        <a class="btn btn-primary">
          <i class="fa fa-plus"></i> Tambah Pesanan
        </a>  
        <a class="btn btn-danger float-right px-3">
          <i class="fa fa-power-off"></i> Logout
        </a>
      </div>

      <div class="text-left">
        
      </div>

      <table class="table table-bordered table-responsive-sm">
          <thead>
              <tr>
                <th scope="col">ID Transaksi</th>
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
            
          </tbody>
      </table>
    </div>


    <script src="libraries/jquery/jquery.js"></script>
    <script src="libraries/bootstrap/js/bootstrap.js"></script>
    <script src="scripts/main.js"></script>
</body>
</html>