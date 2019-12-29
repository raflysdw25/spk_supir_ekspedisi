<?php
    require 'functions.php';
    session_start();

     // Cek user telah login sebagai admin
    // if( !isset($_SESSION["login"]) &&  $_SESSION["jabatan"] == "Admin"  ){
    //     header("location:login_karyawan.php");
    //     exit;
    // }else if ( isset($_SESSION["login"]) && $_SESSION["jabatan"] == "Supir" ) {
        // header("location:" . $_SERVER["HTTP_REFERER"]);
    //     exit;
    // }


    if( !isset($_SESSION["id_krwn"]) && !isset($_SESSION["jabatan_krwn"]) ){
        header("location:tambah_pegawai.php");
        exit;
    }
    

    $id_krwn = $_SESSION["id_krwn"];
    $level_user = $_SESSION["jabatan_krwn"];
    // var_dump($id_krwn);
    // var_dump($level_user); die;

    if( isset($_POST["tambah_user"]) ){
        $result = tambah_user($_POST);

        if( $result > 0 ){
            echo "
                <script>
                    alert('Penambahan pegawai berhasil');
                    document.location.href='halaman_admin.php';
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
    <title>Buat User</title>

    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div id="card-login" class="card">
            <div class="card-body">
                <h4 class="display-4">Buat User</h4>
                <form action="" method="POST">
                    <input type="hidden" name="id_krwn" value="<?= $id_krwn; ?>">
                    <div class="form-group">
                        <label for="usernameUser">Username</label>
                        <input type="text" class="form-control" name="username">
                    </div>

                    <div class="form-group">
                        <label for="passwordUser">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>

                    <div class="form-group">
                        <label for="levelUser">Level User</label>
                        <input type="text" value="<?= $level_user; ?>" class="form-control" name="jabatan_krwn" readonly>
                    </div>

                    <button type="submit" name="tambah_user" class="btn btn-primary btn-block">Buat User</button>
                </form>
            </div>
        </div>
    </div>



    <script src="libraries/jquery/jquery.js"></script>
    <script src="libraries/bootstrap/js/bootstrap.js"></script>
    <script src="scripts/main.js"></script>
</body>
</html>