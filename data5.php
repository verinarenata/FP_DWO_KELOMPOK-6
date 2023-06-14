<?php
include('koneksi.php');

$sql = "SELECT dv.nama_vendor, dv.kota, SUM(fp.jumlah_pembelian) AS total_pembelian,
(SUM(fp.jumlah_pembelian) / (SELECT SUM(jumlah_pembelian) FROM faktapembelian)) * 100 AS persentase
FROM dimvendor dv
JOIN faktapembelian fp ON dv.id_vendor = fp.id_vendor
GROUP BY dv.id_vendor, dv.nama_vendor, dv.kota
ORDER BY total_pembelian DESC 
LIMIT 10";
$result = mysqli_query($conn,$sql);

$hasil = array();

while ($row = mysqli_fetch_array($result)) {
    array_push($hasil,array(
        "nama_vendor"=>$row['nama_vendor'],
        "kota"=>$row['kota'],
        "total_pembelian"=>$row['total_pembelian'],
        "persentase"=>$row['persentase']
    ));
}

$data5 = json_encode($hasil);

?>