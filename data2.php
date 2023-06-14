<?php
include('koneksi.php');

$sql1 = "SELECT nama_vendor, kota, p.kategori_produk as kategori, 
        t.bulan as bulan,
       sum(fp.jumlah_pembelian) as pendapatan 
    FROM dimvendor s, dimproduk p, faktapembelian fp, dimwaktu t 
WHERE (s.id_vendor = fp.id_vendor) AND (t.id_waktu = fp.id_waktu) 
GROUP BY kategori_produk, bulan LIMIT 1000";

$result1 = mysqli_query($conn, $sql1);

$pendapatan = array();

while ($row = mysqli_fetch_array($result1)) {
    array_push($pendapatan,array(
        "nama_vendor"=>$row['nama_vendor'],
        "kota" => $row['kota'],
        "kategori" => $row['kategori'],
        "bulan" => $row['bulan'],
    ));
}

$data2 = json_encode($pendapatan);

?>