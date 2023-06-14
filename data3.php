<?php
include('koneksi.php'); 


$sql1 = "SELECT p.nama_produk, t.bulan, SUM(fp.jumlah_pembelian) AS total_terjual
        FROM dimproduk p
        INNER JOIN faktapembelian fp ON p.id_produk = fp.id_produk
        INNER JOIN dimwaktu t ON t.id_waktu = fp.id_waktu
        WHERE t.tahun = 2003
        GROUP BY p.nama_produk, t.bulan
        ORDER BY t.bulan ASC
        LIMIT 100"; //8788 banyak data

$result1 = mysqli_query($conn, $sql1);

$produk_terjual = array();


while ($row = mysqli_fetch_array($result1)) {
    array_push($produk_terjual,array(
        "bulan"=>$row['bulan'],
        "nama_produk"=>$row['nama_produk'],
        "total_terjual"=>$row['total_terjual'],
    ));
}

$data3 = json_encode($produk_terjual);

?>