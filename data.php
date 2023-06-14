<?php
require('koneksi.php');
//Produk apa yang terjual paling banyak dalam tahun 2003
// $sql = "SELECT s.nama_kota nama_toko, 
//         SUM(p.amount) AS total
//         FROM store s, fakta_pendapatan p 
//         WHERE s.store_id = p.store_id GROUP BY s.nama_kota";
// $result = mysqli_query($conn,$sql);

// $hasil = array();

$sql1 = "SELECT p.nama_produk, t.bulan, SUM(fp.jumlah_pembelian) AS total_terjual
        FROM dimproduk p
        INNER JOIN faktapembelian fp ON p.id_produk = fp.id_produk
        INNER JOIN dimwaktu t ON t.id_waktu = fp.id_waktu
        WHERE t.tahun = 2003 AND t.bulan <= 12
        GROUP BY p.nama_produk, t.bulan
        ORDER BY t.bulan ASC
        LIMIT 1000";

$result1 = mysqli_query($conn,$sql1);

$hasil = array();

// while ($row = mysqli_fetch_array($result)) {
//     array_push($hasil,array(
//         "name"=>$row['nama_toko'],
//         "total"=>$row['total']
//     ));
// }

    while ($row = mysqli_fetch_array($result1)) {
        array_push($hasil,array(
            "nama_produk"=>$row['nama_produk'],
            "bulan"=>$row['bulan'],
            "total_terjual"=>$row['total_terjual'],
        ));
    // $hasil[$row['bulan']][$row['nama_produk']] = $row['total_terjual'];
}

$data = json_encode($hasil);

?>