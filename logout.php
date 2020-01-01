<?php 
    session_start();
    if( isset($_SESSION["id_pemesan"]) ){
        $_SESSION = [];
        session_unset();
        session_destroy();

        header("location:login_pemesan.php");
    }else if( isset($_SESSION["id_karyawan"]) ){
        $_SESSION = [];
        session_unset();
        session_destroy();

        header("location:login_karyawan.php");
    }
?>