<?php
    require 'functions.php';
    session_start();

    if( isset($_SESSION["login"]) && isset($_SESSION["id_karyawan"]) ){
        if($_SESSION["jabatan"] == "Admin"){
            header("location:halaman_admin.php");
            exit;
        }else{
            header("location:halama_supir.php");
            exit;
        }
    }

    if( isset($_POST["login"]) ){

        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username_user = '$username'");

        //cek username
        if(mysqli_num_rows($result) === 1 ) {

            //cek password
            $row = mysqli_fetch_assoc($result);
            if( password_verify($password, $row["password_user"]) ) {
                $_SESSION["login"] = true;
                $_SESSION["id_karyawan"] = $row["id_krwn"];
                if( $row["level_user"] == 'Admin' ){
                    $_SESSION["jabatan"] = $row["level_user"];
                    header("location: halaman_admin.php");
                    exit;
                }else if( $row["level_user"] == 'Supir' ){
                    $_SESSION["jabatan"] = $row["level_user"];
                    header("location: halaman_supir.php");
                    exit;
                }
                

            }

        }

        $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login Karyawan</title>

    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

</head>
  <body>
    <div class="container">
      
    
      <div id="card-login" class="card">
          <div class="card-body">
              <h4 class="text-center mb-4 display-4">Login Karyawan Supir Ekspedisi</h4>
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username Anda">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                            </div>
                            <input type="Password" name="password" class="form-control" placeholder="Masukkan Password Anda">
                        </div>
                    </div>

                    <div id="btn-login" class="my-3">
                        <button type="submit" name="login" class="btn btn-primary btn-block">SUBMIT</button>
                        <a href="index.php" class="btn btn-block text-muted btn-link">Kembali</a>
                    </div>
                </form>
          </div>
      </div>

      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>