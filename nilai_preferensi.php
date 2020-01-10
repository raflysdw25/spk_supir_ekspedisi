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

    // Ambil table Bobot
    $bobot = query("SELECT jumlah_bobot FROM bobot_kriteria");

    // var_dump($bobot);

    $matrix = query("SELECT * FROM konversi_supir WHERE id_transaksi = '$id_transaksi'");


    
    // Nilai Maks dan Min
    $query_maxmin = "SELECT max(umur_supir) 'MaksUmur',
                            max(pengalaman) 'MaksPengalaman',
                            min(jarak_pengambilan) 'MinJarak',
                            max(status_supir) 'MaksStatus'
                    FROM konversi_supir WHERE id_transaksi = '$id_transaksi'";

    $maxmin = query($query_maxmin)[0];
    // var_dump($maxmin);die;

    $query_spk = "SELECT * FROM hasil_spk WHERE id_transaksi = '$id_transaksi'";
    $spk_check = query($query_spk);
    

    if( count($spk_check) > 0){
        $query_delete = "DELETE FROM hasil_spk WHERE id_transaksi = '$id_transaksi'";
        mysqli_query($conn,$query_delete);
        if (mysqli_affected_rows($conn) > 0) {
            echo "
                <script>
                    alert('Data Hasil SPK kosong');
                </script>
            ";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Penentuan Supir Ekspedisi</title>

    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
</head>
<body>
    <div id="header_title" class="container">
        <h6 class="display-4 my-4 font-weight-bold">Penentuan Supir Ekspedisi</h6>
        <p class="text-muted text-monospace">Penentuan dilakukan dengan metode Simple Additive Weighting</p>
    </div>

    <!-- Matrix Data Awal -->
    <div class="container">
        <p class="h6">Data Awal </p>
        <p class="text-monospace">ID Transaksi : <?= $matrix[0]["id_transaksi"]; ?></p>
            <table class="table table-responsive-sm table-bordered">
                <thead class="thead-dark">
                    <th>No</th>
                    <th>Nama Supir</th>
                    <th>Nilai Umur</th>
                    <th>Nilai Pengalaman</th>
                    <th>Nilai Jarak Pengambilan</th>
                    <th>Nilai Status Supir</th>
                    <th>Jumlah Poin</th>
                </thead>
                <tbody class="bg-light">
                    <?php 
                        $no = 1;
                        foreach($matrix as $mtx):
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= getNama($mtx["id_krwn"]); ?></td>
                            <td><?= $mtx["umur_supir"]; ?></td>
                            <td><?= $mtx["pengalaman"]; ?></td>
                            <td><?= $mtx["jarak_pengambilan"]; ?></td>
                            <td><?= $mtx["status_supir"]; ?></td>
                            <td>
                                <?= $mtx["umur_supir"] + $mtx["pengalaman"] + $mtx["jarak_pengambilan"] + $mtx["status_supir"]; ?>
                            </td>
                        </tr>    
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>

    <!-- Matix Data Normalisasi -->
    <div class="container">
        <p class="h6">Data Normalisasi</p>
        <p class="text-monospace">ID Transaksi : <?= $matrix[0]["id_transaksi"]; ?></p>
        <table class="table table-responsive-sm bordered">
            <thead class="thead-dark">
                <th>No</th>
                <th>Nama Supir</th>
                <th>Nilai Umur</th>
                <th>Nilai Pengalaman</th>
                <th>Nilai Jarak Pengambilan</th>
                <th>Nilai Status Supir</th>
            </thead>
            <tbody class="bg-light">
                <?php 
                    $no = 1;
                    foreach($matrix as $mtx):
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= getNama($mtx["id_krwn"]); ?></td>
                        <td><?= round($mtx["umur_supir"]/$maxmin["MaksUmur"],2); ?></td>
                        <td><?= round($mtx["pengalaman"]/$maxmin["MaksPengalaman"],2); ?></td>
                        <td><?= round($maxmin["MinJarak"]/$mtx["jarak_pengambilan"],2); ?></td>
                        <td><?= round($mtx["status_supir"]/$maxmin["MaksStatus"],2); ?></td>
                    </tr>    
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        
        <p class="h6">Mencari Nilai Preferensi Supir</p>
        <p class="text-monospace">ID Transaksi : <?= $matrix[0]["id_transaksi"]; ?></p>
        <table class="table table-responsive-sm table-bordered">
            <thead class="thead-dark">
                <th>No</th>
                <th>ID Supir</th>
                <th>Nama Supir</th>
                <th>Jumlah Poin</th>
                <th>Nilai Preferensi</th>
                <th>Keterangan</th>
            </thead>

            <?php 
                foreach($matrix as $mtx):
                    $id_karyawan = $mtx["id_krwn"];
                    $nama_supir = getNama($id_karyawan);
                    $jumlah_poin = $mtx["umur_supir"] + $mtx["pengalaman"] + $mtx["jarak_pengambilan"] + $mtx["status_supir"];
                    $nilai_preferensi = 
                    round(
                        (($mtx["umur_supir"]/$maxmin["MaksUmur"])*$bobot[3]["jumlah_bobot"])+
                        (($mtx["pengalaman"]/$maxmin["MaksPengalaman"])*$bobot[1]["jumlah_bobot"])+
                        (($maxmin["MinJarak"]/$mtx["jarak_pengambilan"])*$bobot[0]["jumlah_bobot"])+
                        (($mtx["status_supir"]/$maxmin["MaksStatus"])*$bobot[2]["jumlah_bobot"]),3);

                    $insert_hasil = "INSERT INTO hasil_spk
                                    VALUES('','$id_transaksi','$id_karyawan', '$jumlah_poin','$nilai_preferensi')";
                    mysqli_query($conn, $insert_hasil);
                endforeach;

                // Panggil data yang sudah ada didatabase
                $result = query("SELECT * FROM hasil_spk WHERE id_transaksi = '$id_transaksi' ORDER BY nilai_preferensi DESC");
                // var_dump($result[0]); die;

                $nomor = 1;
                $juara = "Supir Terpilih";
                $urutan = 1;
            ?>

            <tbody class="bg-light">
                <?php foreach($result as $item):
                    $id_karyawan_akhir = $item["id_krwn"]; 
                    $nama_hasil = getNama($id_karyawan_akhir);
                    $jumlah_akhir = $item["jumlah_poin"];
                    $nilai_preferensi_akhir = $item["nilai_preferensi"];
                    ?>

                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= $id_karyawan_akhir; ?></td>
                        <td><?= $nama_hasil; ?></td>
                        <td><?= $jumlah_akhir; ?></td>
                        <td><?= $nilai_preferensi_akhir; ?></td>
                        <td><?= $juara; ?></td>
                    </tr>
                <?php
                $urutan++; 
                if($urutan > 1){
                    $juara= " ";
                    $urutan = ' ';
                }
                endforeach;?>
            </tbody>
        </table>
    </div>
    
    <?php 

    ?>

    <div class="container my-4">
        <div id="btn_back" class="text-center">
            <a href="halaman_admin.php?id_krwn=<?= $result[0]["id_krwn"]; ?>&id_transaksi=<?= $id_transaksi; ?>" class="btn btn-primary">Pilih Supir</a>
            <a href="halaman_admin.php" class="btn btn-danger">Batalkan</a>
        </div>
    </div>



    <script src="libraries/jquery/jquery.js"></script>
    <script src="libraries/bootstrap/js/bootstrap.js"></script>
    <script src="scripts/main.js"></script>
</body>
</html>