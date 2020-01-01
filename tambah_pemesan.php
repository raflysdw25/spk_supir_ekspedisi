<?php
    require 'functions.php';
    session_start();

        
    $error = false;
    if ( isset($_POST["tambah_data"]) ) {
        $result = tambah_pemesan($_POST);
        if( $result > 0 ){
            echo "
                <script>
                    alert('Daftar Cabang berhasil. Silahkan lakukan login');
                    document.location.href='login_pemesan.php';
                </script>
            ";
        }else{
            $error = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Cabang Baru</title>

    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h3 class="display-3 text-center my-2 mb-3">Tambah Data Cabang</h3>

        <?php if( $error ): ?>        
        <div class="alert alert-danger text-center">
            Data tidak dapat ditambahkan <br>
            <?= mysqli_error($conn); ?>
        </div>
        <?php endif;?>

        <div id="form_tambah">
            <form action="" method="post">
                <div class="form-group">
                    <label for="username" class="">Username</label>
                    <input type="text" class="form-control" placeholder="Username.." name="username" autofocus>
                </div>

                <div class="form-group">
                    <label for="password" class="">Password</label>
                    <input type="password" class="form-control" placeholder="Password.." name="password">
                </div>

                <div class="form-group">
                    <label for="namaCabang" class="">Nama Cabang</label>
                    <input type="text" class="form-control" placeholder="Nama Cabang.." name="nama_pemesan">
                </div>

                <div class="form-group">
                    <label for="alamatCabang" class="">Alamat Cabang</label>
                    <select name="alamat_pemesan" id="" class="custom-select">
                        <option value="" aria-readonly="true">Pilih Lokasi Cabang</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Bandung">Bandung</option>
                        <option value="Semarang">Semarang</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                        <option value="Surabaya">Surabaya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="telephoneCabang" class="">No Telephone Cabang</label>
                    <input type="tel" class="form-control" placeholder="Telephone Cabang.." name="telephone_pemesan">
                </div>


                <div class="form-inline my-4">
                    <button type="submit" name="tambah_data" class="btn btn-primary mr-2">
                        <span class="fa fa-plus"></span>
                        Tambah Data
                    </button>
                    <a href="login_pemesan.php" class="btn btn-danger">
                        <span class="fa fa-close"></span>
                        Batalkan
                    </a>
                </div>
            </form>
        </div>
    </div>



    <script src="libraries/jquery/jquery.js"></script>
    <script src="libraries/bootstrap/js/bootstrap.js"></script>
    <script src="scripts/main.js"></script>
</body>
</html>