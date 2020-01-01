<?php
    // Buat Koneksi
    $conn = mysqli_connect('localhost', 'root', '', 'spk_supir_ekspedisi');

    //Read Data
    function query($query){
        global $conn;

        $rows = [];
        $result = mysqli_query($conn,$query);

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }


    // Insert Data
    function tambah_pegawai($data){
        global $conn;

        $nik = htmlspecialchars($data["nik_karyawan"]);
        $nama = htmlspecialchars($data["nama_karyawan"]);
        $jenkel = htmlspecialchars($data["jenkel_karyawan"]);
        $pengalaman = htmlspecialchars($data["pengalaman_karyawan"]);
        
        $tanggal = strtotime($data["tglLahir_karyawan"]);
        if ( $tanggal ) {
            $tanggal_lahir = date('Y-m-d', $tanggal);
        }

        $alamat = htmlspecialchars($data["alamat_karyawan"]);
        $simb = htmlspecialchars($data["simb_karyawan"]);
        $pendidikan = htmlspecialchars($data["pendidikan_karyawan"]);
        $telephone = htmlspecialchars($data["telephone_karyawan"]);

        $status = "Not Available";
        $jabatan = htmlspecialchars($data["jabatan_karyawan"]);

        $query = "INSERT INTO karyawan
                    VALUES 
                    (
                        '','$nik','$nama',
                        $pengalaman,'$tanggal_lahir','$alamat',
                        '$simb', '$pendidikan', '$jenkel', '$telephone',
                        '$status', '$jabatan'
                    )";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);

    }

    function tambah_user($data){
        global $conn;

        $id_krwn = htmlspecialchars($data["id_krwn"]);
        $level = htmlspecialchars($data["jabatan_krwn"]);
        $username = htmlspecialchars($data["username"]);
        $password = mysqli_real_escape_string($conn, $data["password"]);

        // Cek Username di database, kalo sama tidak bisa mendaftar
        $result = query("SELECT username_user FROM users WHERE username_user = '$username'");
        if ( count($result) > 0 ) {
            echo"
                <script> 
                    alert('Username sudah terdaftar');
                    document.location.href='tambah_user.php';
                </script>
            ";

            return false;
        }

        // Hash password
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users
                    VALUES 
                    ('','$id_krwn', '$username', '$password', '$level')";
        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);


    }
    

    
?>