<?php
require 'fungsi.php';

// waktu
date_default_timezone_set('Asia/Jakarta');
$waktu_sekarang = new DateTime();

$bulan = date('m');
$tahun = date('Y');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Akiva</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Kilink Akiva</title>
    <link rel="icon" href="../img/Logo Klinik.jpeg">
    <!-- <link rel="stylesheet" type="text/css" href="../style/stylePendaftaran.css"> -->
    <style>
        a:link {
            text-decoration: none;
            color: #fff;
        }

        a:visited {
            text-decoration: none;
            color: #fff;

        }
    </style>
</head>

<body style="background: #c4b8e7;">

    <nav class=" navbar navbar-expand-lg ps-4 pe-4  fixed-top" style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
                <li class="nav-item me-5 btn" style="background-color: #61529A; border-radius: 3px; width: 150px; text-align: center;">
                    <a href="laporan.php" class="nav-link " aria-current="page" style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">BACK</a>
                </li>
            </ul>
        </div>
        <a href="#" class=""><img src="../img/Logo Klinik.png" width="100" height="100" style="margin-right: 20px" /></a>
    </nav>

    <div class="card ms-3 me-3" style="margin-top: 100px;">
        <div class="card-header text-dark" style="background-color: #A595D6; margin: top 100px; ">
            <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; ">LAPORAN OBAT</h1>
            <?php
            if (isset($_GET['bulan']) || isset($_GET['tahun'])) {
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
            } else {
                $bulan = date("m");
                $tahun = date("Y");
            }
            ?>
            <button type="button" style="height: 40px; width: 120px; color: #ffff; font-family:  'Roboto Mono', monospace; text-align: center; font-weight: 900; background-color: #61529A;">
                <a href="pdfObat.php?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>" target="_balank">DOWNLOAD</a>
            </button>

            <form class="form-inline" action="" method="get" style="float:right">
                <select name="bulan">
                    <?php
                    if (date('m') == "1") { ?>
                        <option value="01" selected>Januari</option>
                    <?php } else { ?>
                        <option value="01">Januari</option>
                    <?php } ?>

                    <?php
                    if (date('m') == "2") { ?>
                        <option value="02" selected>Februari</option>
                    <?php } else { ?>
                        <option value="02">Februari</option>
                    <?php } ?>

                    <?php
                    if (date('m') == "3") { ?>
                        <option value="03" selected>Maret</option>
                    <?php } else { ?>
                        <option value="03">Maret</option>
                    <?php } ?>

                    <?php
                    if (date('m') == "4") { ?>
                        <option value="04" selected>April</option>
                    <?php } else { ?>
                        <option value="04">April</option>
                    <?php } ?>

                    <?php
                    if (date('m') == "5") { ?>
                        <option value="05" selected>Mei</option>
                    <?php } else { ?>
                        <option value="05">Mei</option>
                    <?php } ?>

                    <?php
                    if (date('m') == "6") { ?>
                        <option value="06" selected>Juni</option>
                    <?php } else { ?>
                        <option value="06">Juni</option>
                    <?php } ?>

                    <?php
                    if (date('m') == "7") { ?>
                        <option value="07" selected>Juli</option>
                    <?php } else { ?>
                        <option value="07">Juli</option>
                    <?php } ?>

                    <?php
                    if (date('m') == "8") { ?>
                        <option value="08" selected>Agustus</option>
                    <?php } else { ?>
                        <option value="08">Agustus</option>
                    <?php } ?>

                    <?php
                    if (date('m') == "9") { ?>
                        <option value="09" selected>September</option>
                    <?php } else { ?>
                        <option value="09">September</option>
                    <?php } ?>

                    <?php
                    if (date('m') == "10") { ?>
                        <option value="10" selected>Oktober</option>
                    <?php } else { ?>
                        <option value="10">Oktober</option>
                    <?php } ?>

                    <?php
                    if (date('m') == "11") { ?>
                        <option value="11" selected>November</option>
                    <?php } else { ?>
                        <option value="11">November</option>
                    <?php } ?>

                    <?php
                    if (date('m') == "12") { ?>
                        <option value="12" selected>Desember</option>
                    <?php } else { ?>
                        <option value="12">Desember</option>
                    <?php } ?>

                </select>

                <select name="tahun">
                    <?php
                    $mulai = date('Y') - 4;
                    for ($i = $mulai; $i < $mulai + 11; $i++) {
                        $sel = $i == date('Y') ? ' selected="selected"' : '';
                        echo '<option value="' . $i . '"' . $sel . '>' . $i . '</option>';
                    }
                    ?>
                </select>
                <button class="button" type="submit" id="cari" style="color: #ffffff; background-color: #2A87FF; border-radius: 3px; border: 1px solid #A595D6;">Cari <img src="../img/cari.png" width="20px" height="20px" class="ms-1 mb-1"></button>
            </form>
        </div>

        <br>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:800;">
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat & Perlengkapan</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Pemakaian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $bulan = (isset($_GET['bulan'])) ? $_GET['bulan'] : date("m");
                    $tahun = (isset($_GET['tahun'])) ? $_GET['tahun'] : date('Y');

                    if ($bulan == date("m") || $tahun == date('Y')) {
                        // ambil data dari table pasien

                        $total = query("SELECT SUM(penjualan.jumlah) , obat.nama_obat, obat.jenis_obat 
                    FROM penjualan 
                    JOIN obat on (obat.id_obat=penjualan.id_obat) 
                    WHERE month(tanggal_terjual)='$bulan' and year(tanggal_terjual) = '$tahun' 
                    GROUP BY penjualan.id_obat;");
                    } else {
                        // kondisi jika parameter pencarian diisi

                        $query = query("SELECT SUM(penjualan.jumlah) , obat.nama_obat, obat.jenis_obat 
                        FROM penjualan 
                        JOIN obat on (obat.id_obat=penjualan.id_obat) 
                        WHERE month(tanggal_terjual)='$bulan' and year(tanggal_terjual) = '$tahun' 
                        GROUP BY penjualan.id_obat;");
                    }

                    // ambil data dari table pasien

                    ?>
                    <?php $i = 1; ?>
                    <?php foreach ($total as $tol) { ?>
                        <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:400;">
                            <th><?= $i ?></th>
                            <td scope="row"><?= $tol['nama_obat'] ?></td>
                            <td scope="row"><?= $tol['jenis_obat'] ?></td>
                            <td scope="row"><?= $tol['SUM(penjualan.jumlah)'] ?></td>
                            <?php $i++; ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>