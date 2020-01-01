<?php
    require 'functions.php';
    session_start();

    // Cek user telah login sebagai admin
    if( !isset($_SESSION["login"]) &&  $_SESSION["jabatan"] == "Admin"  ){
        header("location:login_karyawan.php");
        exit;
    }else if ( isset($_SESSION["login"]) && $_SESSION["jabatan"] == "Supir" ) {
        header("javascript:history.go(-1)");
        exit;
    }
        
    $error = false;
    if ( isset($_POST["tambah_data"]) ) {
        $result = tambah_pegawai($_POST);
        if( $result > 0 ){
            $user_data = query("SELECT MAX(id_krwn) 'id_krwn' FROM karyawan")[0];

            $_SESSION["id_krwn"] = $user_data["id_krwn"];
            $_SESSION["jabatan_krwn"] = $_POST["jabatan_karyawan"];
            echo "
                <script>
                    alert('Tahap 1 berhasil');
                    document.location.href='tambah_user.php';
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
    <title>Tambah Pegawai</title>

    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h3 class="display-3 text-center my-2 mb-3">Tambah Data Pegawai</h3>

        <?php if( $error ): ?>        
        <div class="alert alert-danger text-center">
            Data tidak dapat ditambahkan <br>
            <?= mysqli_error($conn); ?>
        </div>
        <?php endif;?>

        <div id="form_tambah">
            <form action="" method="post">
                <div class="form-group">
                    <label for="nikKaryawan" class="">NIK Karyawan</label>
                    <input type="text" class="form-control" placeholder="NIK Karyawan.." name="nik_karyawan" autofocus>
                </div>

                <div class="form-group">
                    <label for="namaKaryawan" class="">Nama Karyawan</label>
                    <input type="text" class="form-control" placeholder="Nama Karyawan.." name="nama_karyawan">
                </div>

                <div class="form-group">
                    <label for="jenkelKaryawan" class="">Jenis Kelamin Karyawan</label>
                    <select name="jenkel_karyawan" id="" class="custom-select">
                        <option value="" aria-readonly="true">Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki - Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pengalamanKaryawan" class="">Pengalaman Karyawan</label>
                    <input type="number" min="0" class="form-control" placeholder="Pengalaman Karyawan.." name="pengalaman_karyawan">
                </div>

                <div class="form-group">
                    <label for="tanggalLahir" class="">Tanggal Lahir Karyawan</label>
                    <input type="date" class="form-control" min="01-01-1959" max="12-31-1997" placeholder="Tanggal Lahir Karyawan.." name="tglLahir_karyawan">
                </div>

                <div class="form-group">
                    <label for="alamatKaryawan" class="">Alamat Karyawan</label>
                    <select name="alamat_pemesan" id="" class="custom-select">
                        <option value="Jakarta">Jakarta</option>
                        <option value="Bandung">Bandung</option>
                        <option value="Semarang">Semarang</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                        <option value="Surabaya">Surabaya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="namaKaryawan" class="">Kepemilikan SIM B</label>
                    <select name="simb_karyawan" id="" class="custom-select">
                        <option value="" aria-readonly="true">Kepemilikan SIM B</option>
                        <option value="Y">Memiliki</option>
                        <option value="N">Belum Memiliki</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pendidikanKaryawan" class="">Pendidikan Karyawan</label>
                    <select name="pendidikan_karyawan" id="" class="custom-select">
                        <option value="" aria-readonly="true">Pendidikan Karyawan</option>
                        <option value="SD">Sekolah Dasar</option>
                        <option value="SMP">Sekolah Menengah Pertama</option>
                        <option value="SMA">Sekolah Menengah Atas</option>
                        <option value="SMK">Sekolah Menengah Kejuruan</option>
                        <option value="S1">Sarjana</option>
                        <option value="S2">Magister</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="telephoneKaryawan" class="">No Telephone Karyawan</label>
                    <input type="tel" class="form-control" placeholder="Telephone Karyawan.." name="telephone_karyawan">
                </div>

                <div class="form-group">
                    <label for="jabatanKaryawan">Jabatan Karyawan</label>
                    <select name="jabatan_karyawan" id="" class="custom-select">
                        <option value="" aria-readonly="true">Pilih Jabatan</option>
                        <option value="Supir">Supir</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>

                <div class="form-inline my-4">
                    <button type="submit" name="tambah_data" class="btn btn-primary mr-2">
                        <span class="fa fa-plus"></span>
                        Tambah Data
                    </button>
                    <a href="#" class="btn btn-danger">
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