<!DOCTYPE html>
<html lang="en">
<!-- Siapa vendor yang paling banyak menyuplai barang -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Adventure Works Cycles</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/styleGraph.css">
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

</head>

<body id="page-top">

<?php 
//data barchart
include ('data6.php');

$data6 = json_decode($data6, TRUE);
?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php";?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                
                <div id="container" class="grafik"></div>
                <p class="highcharts-description">
                Berikut merupakan grafik diagram pie untuk menunjukkan siapa vendor yang paling banyak menyuplai produk.
                </p>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Dashboard Adventure Works Cycles</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript">
        //create linechart
        Highcharts.chart('container', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Competent Vendors'
            },
            subtitle: {
                text: 'Source: Database Adventure Works Cycles'
            },
        
            accessibility: {
                announceNewData: {
                    enabled: true
                },
                point: {
                    valueSuffix: '%'
                }
            },
        
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y:.1f}%'
                    }
                }
            },
        
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },
        
            series: [
                {
                    name: "Vendor",
                    colorByPoint: true,
                    data: [
                        <?php foreach ($data6 as $data):?>
                        {
                            name: '<?= $data["nama_vendor"]; ?>',
                            y: <?= $data["persentase"]; ?>,
                            drilldown: '<?= $data["id_vendor"]; ?>'
                        },
                        <?php endforeach;?>
                    ]
                }
            ],
            drilldown: {
                series: [
                    <?php for ($i=0; $i < count($data6); $i+=5):?>
                    {
                        name: "<?= $data6[$i]["id_produk"]; ?>",
                        id: "<?= $data6[$i]["kota"]; ?>",
                        data: [
                            <?php for ($a=$i; $a < $i+5; $a++):?>
                            [
                                "<?= $data6[$a]["bulan"]; ?>",
                                <?= floatval($data6[$a]["persentase"]); ?>
                            ],
                            <?php endfor;?>
                        ]
                    },
                    <?php endfor;?>
                ]}
        });
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.min.js"></script>


</body>

</html>