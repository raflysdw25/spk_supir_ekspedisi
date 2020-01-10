<?php
    require 'functions.php';
    session_start();
    // Cek user telah login sebagai admin
    if( !isset($_SESSION["login"]) && !isset($_SESSION["id_karyawan"]) && !isset($_SESSION["jabatan"])){        
        echo "
            <script>
                alert('Belum melakukan login, silahkan login terlebih dahulu');
                document.location.href='login_karyawan.php';
            </script>
        ";
            exit;
    }else if($_SESSION["jabatan"] != "Admin"){
        echo "
        <script>
            alert('Anda bukan admin, silahkan login sebagai admin');
            document.location.href='login_karyawan.php';
        </script>
        ";
        session_destroy();
         exit;
    }

    $id_transaksi = $_GET["id_transaksi"];

    // Ambil data supir
    $query_supir = "SELECT * FROM karyawan WHERE jabatan_krwn = 'Supir'";
    $supir = query($query_supir);

    // Ambil data transaksi sesuai id transaksinya
    $query_transaksi = "SELECT tr.id_transaksi, tr.id_pemesan, tr.alamat_pengambilan
                        FROM transaksi_pemesanan tr JOIN pemesan p ON (tr.id_pemesan = p.id_pemesan) 
                        WHERE tr.id_transaksi = $id_transaksi";
    $transaksi = query($query_transaksi)[0];


    // Ambil data pemesan berdasarkan alamat pengambilannya
    $tempat_pengambilan = $transaksi["alamat_pengambilan"];
    $query_pengambilan = "SELECT alamat_pemesan FROM pemesan WHERE nama_pemesan = '$tempat_pengambilan'";
    $pengambilan = query($query_pengambilan)[0];

    // Pengecekan jika untuk id transaksi yang ingin dikonversikan sudah diada datanya atau belum
    $query_konversi = "SELECT * FROM konversi_supir WHERE id_transaksi = '$id_transaksi'";
    $konversi_check = query($query_konversi);

    if( count($konversi_check) > 0){
        $query_delete = "DELETE FROM konversi_supir WHERE id_transaksi = '$id_transaksi'";
        mysqli_query($conn,$query_delete);
        if (mysqli_affected_rows($conn) > 0) {
            echo "
                <script>
                    alert('Data Konversi kosong');
                </script>
            ";
        }
    }
    

    // Proses konversi data supir
    foreach ($supir as $spr):
        $id_krwn = $spr["id_krwn"];

        // Konversi data Umur karyawan
        $umur = umur_karyawan($spr["tanggal_lahir_krwn"]);
        $umur_krwn = (int) $umur;
        if($umur_krwn>= 21 && $umur_krwn<=30){
            $nilai_umur = 1;
        }else if($umur_krwn>= 31 && $umur_krwn<=40){
            $nilai_umur = 2;
        }else if($umur_krwn>= 41 && $umur_krwn<=50){
            $nilai_umur = 3;
        }else if($umur_krwn>= 51){
            $nilai_umur = 4;
        }
        
        
        // Konversi data pengalaman karyawan
        $pengalaman = $spr["pengalaman_krwn"];
        $pengalaman_krwn = (int) $pengalaman;
        if($pengalaman_krwn>= 0 && $pengalaman_krwn<=5){
            $nilai_pengalaman = 1;
        }else if($pengalaman_krwn>= 6 && $pengalaman_krwn<=10){
            $nilai_pengalaman = 2;
        }else if($pengalaman_krwn>= 11 && $pengalaman_krwn<=15){
            $nilai_pengalaman = 3;
        }else if($pengalaman_krwn>= 16){
            $nilai_pengalaman = 4;
        }

        // Konversi data jarak pengambilan
        $alamat = $spr["alamat_krwn"];
        $alamat_pengambilan = $pengambilan["alamat_pemesan"];

        if ( $alamat == $alamat_pengambilan) {
            $alamat_krwn = (int) random_int(1,100);
        }else if ( ( ($alamat == "Jakarta") && ($alamat_pengambilan == "Bandung") ) || ( ($alamat == "Bandung") && ($alamat_pengambilan == "Jakarta") )  ) {
            $jarak_pengambilan = 151;
        }else if ( ( ($alamat == "Jakarta") && ($alamat_pengambilan == "Semarang") ) || ( ($alamat == "Semarang") && ($alamat_pengambilan == "Jakarta") )  ) {
            $jarak_pengambilan = 442;
        }else if ( ( ($alamat == "Jakarta") && ($alamat_pengambilan == "Yogyakarta") ) || ( ($alamat == "Yogyakarta") && ($alamat_pengambilan == "Jakarta") ) ) {
            $jarak_pengambilan = 562;
        }else if ( ( ($alamat == "Jakarta") && ($alamat_pengambilan == "Surabaya") ) || ( ($alamat == "Surabaya") && ($alamat_pengambilan == "Jakarta") )  ) {
            $jarak_pengambilan = 781;
        }else if ( ( ($alamat == "Bandung") && ($alamat_pengambilan == "Semarang") ) || ( ($alamat == "Semarang") && ($alamat_pengambilan == "Bandung") )  ) {
            $jarak_pengambilan = 439;
        }else if ( ( ($alamat == "Bandung") && ($alamat_pengambilan == "Yogyakarta") ) || ( ($alamat == "Yogyakarta") && ($alamat_pengambilan == "Bandung") )  ) {
            $jarak_pengambilan = 559;
        }else if ( ( ($alamat == "Bandung") && ($alamat_pengambilan == "Surabaya") ) || ( ($alamat == "Surabaya") && ($alamat_pengambilan == "Bandung") )  ) {
            $jarak_pengambilan = 779;
        }else if ( ( ($alamat == "Semarang") && ($alamat_pengambilan == "Yogyakarta") ) || ( ($alamat == "Yogyakarta") && ($alamat_pengambilan == "Semarang") )  ) {
            $jarak_pengambilan = 128;
        }else if ( ( ($alamat == "Semarang") && ($alamat_pengambilan == "Surabaya") ) || ( ($alamat == "Surabaya") && ($alamat_pengambilan == "Semarang") )  ) {
            $jarak_pengambilan = 348;
        }else if ( ( ($alamat == "Yogyakarta") && ($alamat_pengambilan == "Surabaya") ) || ( ($alamat == "Surabaya") && ($alamat_pengambilan == "Yogyakarta") )  ) {
            $jarak_pengambilan = 324;
        }

        // jarak pengambilan
        if($jarak_pengambilan>= 0 && $jarak_pengambilan<=300){
            $nilai_jarak = 1;
        }else if($jarak_pengambilan>= 301 && $jarak_pengambilan<=600){
            $nilai_jarak = 2;
        }else if($jarak_pengambilan>= 601 && $jarak_pengambilan<=900){
            $nilai_jarak = 3;
        }else if($jarak_pengambilan>= 901){
            $nilai_jarak = 4;
        }
                
       
        // Konversi data Status Karyawan
        $status_krwn = $spr["status_krwn"];
        if($status_krwn == "Available"){
            $nilai_status = 2;
        }else if($status_krwn == "Not Available"){
            $nilai_status = 1;
        }

        $insert_query = "INSERT INTO konversi_supir
                            VALUES
                            ('','$id_krwn','$id_transaksi','$nilai_umur','$nilai_pengalaman','$nilai_jarak','$nilai_status')";
        $insert_nilai = mysqli_query($conn,$insert_query);

    endforeach;

    if ( mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Data supir berhasil dikonversi');
            </script>
        ";

        header('location:nilai_preferensi.php?id_transaksi='.$id_transaksi);
    }
?>