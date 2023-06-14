<?php
include('koneksi.php');

$sql = "SELECT
dv.nama_vendor,
dv.id_vendor,
dv.kota,
MAX(fp.id_produk) AS id_produk,
SUM(fp.jumlah_pembelian) AS total_pembelian,
(SUM(fp.jumlah_pembelian) / (SELECT SUM(jumlah_pembelian) FROM faktapembelian)) * 100 AS persentase,
dw.bulan
FROM
dimvendor dv
JOIN faktapembelian fp ON dv.id_vendor = fp.id_vendor
JOIN dimwaktu dw ON fp.id_waktu = dw.id_waktu
GROUP BY
dv.id_vendor
ORDER BY
total_pembelian DESC
LIMIT 10";
$result = mysqli_query($conn,$sql);

$hasil = array();

while ($row = mysqli_fetch_array($result)) {
    array_push($hasil,array(
        "nama_vendor"=>$row['nama_vendor'],
        "id_vendor"=>$row['id_vendor'],
        "kota"=>$row['kota'],
        "id_produk"=>$row['id_produk'],
        "bulan"=>$row['bulan'],
        "persentase"=>$row['persentase'],
        "total_pembelian"=>$row['total_pembelian']
    ));
}

$data6 = json_encode($hasil);

?>