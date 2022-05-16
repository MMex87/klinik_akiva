<?php
require 'fungsi.php';

// waktu
date_default_timezone_set('Asia/Jakarta');
$waktu_sekarang = new DateTime();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Kilink Akiva</title>
    <link rel="icon" href="../img/Logo Klinik.jpeg">

    <!-- Library JQuery -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>


    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <style>
        #graph {
            width: 100%;
            height: 500px;
        }
    </style>

</head>

<body style="background: #c4b8e7;">

    <nav class=" navbar navbar-expand-lg ps-4 pe-4  fixed-top" style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
                <li class="nav-item me-5 btn" style="background-color: #61529A; border-radius: 3px; width: 150px; text-align: center;">
                    <a href="laporan_pasien.php" class="nav-link " aria-current="page" style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">BACK</a>
                </li>
            </ul>
        </div>
        <a href="#" class=""><img src="../img/Logo Klinik.png" width="100" height="100" style="margin-right: 20px" /></a>
    </nav>

    <div class="card ms-3 me-3" style="margin-top: 100px;">
        <div class="card-header text-dark" style="background-color: #A595D6;">
            <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; "> CHART PENGUNJUNG KLINIK AKIVA</h1>
        </div>
        <div class="panel panel-primary">
            <div class="panel-body">
                <div id="graph"></div>
            </div>
        </div>
    </div>



</body>

<script>
    am5.ready(function() {

        // buat root elemet
        var root = am5.Root.new("graph");

        // set tama
        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        // buat chart
        var chart =
            root.container.children.push(am5percent.PieChart.new(root, {
                layout: root.verticalLayout
            }));

        // buat series
        var series =
            chart.series.push(am5percent.PieSeries.new(root, {
                valueField: "value",
                categoryField: "category"
            }));

        // set Data
        series.data.setAll([
            <?php
            $query = mysqli_query($konek, "SELECT DISTINCT alamat FROM pasien");

            while ($row = mysqli_fetch_array($query)) {
                $alamat = $row['alamat'];

                $data = query("SELECT COUNT(d.a) as jumlah FROM diagnosa d JOIN pasien p JOIN pendaftaran c on p.id_pasien = c.id_pasien AND c.id_pendaftaran = d.id_pendaftaran WHERE p.alamat = '$alamat'")[0];
                $jumlah = $data['jumlah'];
            ?> {
                    value: <?php echo $jumlah; ?>,
                    category: '<?php echo $alamat ?>'
                },
            <?php
            }
            ?>
        ]);
        // set Legend
        var legend = chart.children.push(am5.Legend.new(root, {
            centerX: am5.percent(50),
            x: am5.percent(50),
            marginTop: 15,
            marginBottom: 15
        }));

        legend.data.setAll(series.dataItems);
        series.appear(1000, 100);
    });
</script>


</html>