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

    
    // Function Konversi Umur
    function umur_karyawan($birthdate) {
        $birthdate = date('Ymd', strtotime($birthdate));
        $diff = date('Ymd') - $birthdate;
        return substr($diff, 0, -4);
    }

    // Mendapatkan nama
    function getNama($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM karyawan WHERE id_krwn = '$id'");

        $calon = mysqli_fetch_assoc($result);

        return $calon["nama_krwn"];
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

    // Tombol Tambah Pesanan

    function tambah_pesanan($data){
        global $conn;

        $id_pemesan = $data["id_pemesan"];
        $jumlah_pesanan = htmlspecialchars($data["Jumlah_Pesanan"]);
        $alamat_pengambilan = htmlspecialchars($data["Alamat_Pengambilan"]);
        $alamat_tujuan = htmlspecialchars($data["Alamat_Tujuan"]);
        $jenis_pengiriman = htmlspecialchars($data["Jenis_Pengiriman"]);
        $status = "Search Driver";
        
        $tanggal = strtotime($data["Tanggal"]);
        if( $tanggal ){
            $tanggal_sampai = date('Y-m-d', $tanggal);
        }
        
        $nama_krwn = "Search Driver";

        $query = "INSERT INTO transaksi_pemesanan VALUES ('','$id_pemesan', '$jumlah_pesanan','$alamat_pengambilan','$alamat_tujuan','$jenis_pengiriman','$tanggal_sampai','$status','$nama_krwn')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
    
    // Tambah Cabang
    function tambah_pemesan($data){
        global $conn;

        $username = htmlspecialchars($data["username"]);
        $nama_cabang = htmlspecialchars($data["nama_pemesan"]);
        // Cek Username di database, kalo sama tidak bisa mendaftar
        $result = query("SELECT username_pmsn, nama_pemesan FROM pemesan WHERE username_pmsn = '$username' AND nama_pemesan = '$nama_cabang'");
        if ( count($result) > 0 ) {
            echo"
                <script> 
                    alert('Username sudah terdaftar');
                </script>
            ";

            return false;
        }

        $password = mysqli_real_escape_string($conn, $data["password"]);

        // Hash password
        $password = password_hash($password, PASSWORD_DEFAULT);

        
        $alamat_cabang = $data["alamat_pemesan"];

        // Set telephone jadi hanya angka
        $telephone_cabang = htmlspecialchars($data["telephone_pemesan"]);

        $query = "INSERT INTO pemesan
                    VALUES 
                    ('','$username', '$password', '$nama_cabang', '$alamat_cabang', '$telephone_cabang')";
        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
    }
    
?>