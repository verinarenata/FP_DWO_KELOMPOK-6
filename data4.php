<?php
require('koneksi.php');

$sql = "SELECT f.kategori kategori, 
        t.bulan as bulan,
        COUNT(DISTINCT(fp.customer_id)) as pelanggan 
        FROM film f, customer c, fakta_pendapatan fp, time t 
        WHERE (c.customer_id = fp.customer_id) AND (t.time_id = fp.time_id) AND (f.film_id = fp.film_id) 
        GROUP BY kategori, bulan";
$result = mysqli_query($conn, $sql);

$hasil = array();

while ($row = mysqli_fetch_array($result)) {
    array_push($hasil,array(
        "kategori"=>$row['kategori'],
        "bulan"=>$row['bulan'],
        "pelanggan"=>$row['pelanggan']
    ));
}

$data4 = json_encode($hasil);
?>