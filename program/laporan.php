<?php
require 'fungsi.php';

// waktu
date_default_timezone_set('Asia/Jakarta');
$waktu_sekarang = new DateTime();

// input tanggal

date_default_timezone_set('Asia/Jakarta');
$tanggal = date("Y-m-d");

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css_laporan.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Kilink Akiva</title>
    <link rel="icon" href="../img/Logo Klinik.jpeg">

    <!-- JQuery TimeStamp -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>

    <title>Klinik Akiva</title>
</head>

<body style="background: #c4b8e7;">

    <nav class="navbar navbar-expand-lg ps-4 pe-4" style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
                <li class="nav-item me-5 btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px; text-align: center;">
                    <a href="pendaftaran.php" class="nav-link" aria-current="page" style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">PENDAFTARAN</a>
                </li>
                <li class=" nav-item me-5 btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px">
                    <a href="obat.php" class="nav-link" style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">OBAT</a>
                </li>
                <li class="nav-item me-5 btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px">
                    <a href="pasien.php" class="nav-link" style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">PASIEN</a>
                </li>
                <li class=" nav-item btn" style="background-color: #61529A; border-radius: 3px; width: 150px">
                    <a href="laporan.php" class="nav-link" style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">LAPORAN</a>
                </li>
            </ul>
        </div>
        <a href="#" class=""><img src="../img/Logo Klinik.png" width="100" height="100" style="margin-right: 20px" /></a>
    </nav>

    <div class="container-fluid1 ps-5 pe-5">
        <div class="row pt-3 container-fluid ms-1">
            <div class='col-5'>
                <h1 style="color: #6B59AE ; font-family: 'Roboto Mono', monospace; font-weight:500;">LAPORAN</h1>
            </div>

            <div class='col-7 align-top mt-3'>
                <h4 class="ms-5 mt-2" id="timestamp" style="float: right;"></h4>

            </div>
        </div>
    </div>

    <div class="container-satu">
        <div class="card">
            <div class="header">
                <p style="font-size: 40px;">PASIEN</p>
                <?php
                // ambil total data pasien
                $total_data_pasien = mysqli_fetch_array(mysqli_query($konek, "SELECT COUNT(id_pendaftaran) FROM pendaftaran WHERE tanggal_daftar LIKE '%$tanggal%' AND status = '0' "))[0];
                if ($total_data_pasien > 0) { ?>
                    <P style="font-size: 70px;"> <?= $total_data_pasien ?> </P>
                <?php } else { ?>
                    <P style="font-size: 70px;"> <?= 0 ?> </P>
                <?php } ?>
            </div>

            <div class="content">
                <p><a href="laporan_pasien.php" style="text-decoration: none; color: whitesmoke"> DETAIL </a> </p>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <p> OBAT</p>
                <?php
                // ambil data jumlah obat keluar

                $total_data_obat = mysqli_fetch_array(mysqli_query($konek, "SELECT SUM(jumlah) FROM penjualan WHERE tanggal_terjual LIKE '%$tanggal%' "))[0];
                if ($total_data_obat > 0) { ?>
                    <P style="font-size: 70px;"> <?= $total_data_obat ?> </P>
                <?php } else { ?>
                    <P style="font-size: 70px;"> <?= 0 ?> </P>
                <?php } ?>

                <p style="font-size: 70px;"> <?= $total_data_obat ?></p>

            </div>
            <div class="content">
                <p> <a href="laporan_obat.php" style=" text-decoration: none; color: whitesmoke"> DETAIL </a> </p>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <p>DIAGNOSA</p>
                <?php
                $query = query("SELECT COUNT(a), a FROM diagnosa GROUP BY (a) ORDER BY COUNT(a) DESC")[1];
                $nama = $query['a'];
                ?>
                <P style="font-size: 70px;"> <?= $nama ?> </P>
            </div>
            <div class="content">
                <p> <a href="chartDiagnosa.php" style="text-decoration: none; color: whitesmoke"> DETAIL </a> </p>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <p>PEMERIKSAAN</p>
            </div>
            <div class="content">
                <p> <a href="pemeriksaan.php" style="text-decoration: none; color: whitesmoke"> DETAIL </a> </p>
            </div>
        </div>

    </div>

</body>

</html>

<!-- JS TimeStamp -->
<script>
    $(function() {
        setInterval(timestamp, 1000);
    });

    function timestamp() {
        $.ajax({
            url: 'ajax_timestamp.php',
            success: function(data) {
                $('#timestamp').html(data);
            },
        });
    }
</script>