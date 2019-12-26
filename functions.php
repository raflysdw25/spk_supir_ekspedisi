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
?>