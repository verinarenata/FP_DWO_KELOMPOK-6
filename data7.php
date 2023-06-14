<?php
require('koneksi.php');

// $sql1 = "SELECT f.kategori kategori, 
// t.bulan as bulan,
// SUM(fp.lamapinjam) as lamapinjam 
// FROM film f, fakta_pendapatan fp, time t 
// WHERE (f.film_id = fp.film_id) AND (t.time_id = fp.time_id) 
// GROUP BY kategori, bulan";

$sql1 = "SELECT YEAR(dw.tanggallengkap) AS tahun, SUM(fp.jumlah_pembelian) AS total_produksi
        FROM faktapembelian fp
        INNER JOIN dimproduk dp ON fp.id_produk = dp.id_produk
        INNER JOIN dimwaktu dw ON fp.id_waktu = dw.id_waktu
        WHERE YEAR(dw.tanggallengkap) BETWEEN 2001 AND 2004
        GROUP BY YEAR(dw.tanggallengkap)
        ORDER BY YEAR(dw.tanggallengkap)";

$result1 = mysqli_query($conn,$sql1);

$produksi_per_tahun = array();

// while ($row = mysqli_fetch_array($result1)) {
//     array_push($lamapinjam,array(
//         "lamapinjam"=>$row['lamapinjam'],
//         "bulan" => $row['bulan'],
//         "kategori" => $row['kategori']
//     ));
// }

while ($row = mysqli_fetch_array($result1)) {
    array_push($produksi_per_tahun,array(
        "tahun"=>$row['tahun'],
        "total_produksi"=>$row['total_produksi'],
    ));
}
$data7 = json_encode($produksi_per_tahun);

?>