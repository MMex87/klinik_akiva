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
    <title>Klinik Akiva</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Kilink Akiva</title>
    <link rel="icon" href="../img/Logo Klinik.jpeg">
    <!-- <link rel="stylesheet" type="text/css" href="../style/stylePendaftaran.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
        a:link{
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

    <nav class="navbar navbar-expand-lg ps-4 pe-4 fixed-top" style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
                <li class="nav-item me-5 btn" style="background-color: #61529A; border-radius: 3px; width: 150px; text-align: center;">
                    <a href="laporan.php" class="nav-link " aria-current="page" style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">BACK</a>
                </li>
            </ul>
        </div>
        <a href="#" class=""><img src="../img/Logo Klinik.png" width="100" height="100" style="margin-right: 20px" /></a>
    </nav>

    <div class="card ms-3 me-3 " style="margin-top: 100px;">
        <div class="card-header text-dark" style="background-color: #A595D6; margin: top 100px; ">
            <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; ">LAPORAN PASIEN</h1>
            <?php  
                if(isset($_GET['cari'])){
                    $pdfTanggal = $_GET['cari'];
                }else{
                    $pdfTanggal = $tanggal;
                }
            ?>
            <button type="button" style="height: 40px; width: 120px; color: #ffff; font-family:  'Roboto Mono', monospace; text-align: center; font-weight: 900; background-color: #61529A;">
            <a href="pdfPasien.php?tanggal=<?= $pdfTanggal ?>">DOWNLOAD</a> 
            </button>
            <button type="button" class="ms-3" style="height: 40px; width: 130px; color: #ffff; font-family:  'Roboto Mono', monospace; text-align: center; font-weight: 900; background-color: #61529A;">
            <a href="chartPengunjung.php">CHART PASIEN</a> 
            </button>

            <form class="form-inline" action="" method="get" style="float:right">
                <input type="date" id="cari" name="cari" autocomplete="off" value="<?= (isset($_GET['cari'])) ? $_GET['cari'] : $tanggal ?>">
                <button class="button" type="submit" id="cari" style="color: #ffffff; background-color: #2A87FF; border-radius: 3px; border: 1px solid #A595D6;">Cari <img src="../img/cari.png" width="20px" height="20px" class="ms-1 mb-1"></button>
                <h4 style="float: left; margin-right:6px;"><a style=" color:#ffff;text-decoration:none;" href="pasienPerBulan.php">BULAN</a></h4>
            </form>
        </div>

        <br>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:800;">
                        <th scope="col">#</th>
                        <th scope="col">RM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Usia</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Tindakan</th>
                        <th scope="col">Diganosa</th>

                    </tr>
                </thead>
                <tbody>
                    <div>
                        <?php

                        $tanggal = (isset($_GET['cari'])) ? $_GET['cari'] : $tanggal;


                            $pasien = query("SELECT pendaftaran.tindakan, pasien.no_rm, pasien.nama, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, diagnosa.a, pendaftaran.tanggal_daftar, pendaftaran.keterangan
                        FROM pendaftaran
                        JOIN pasien on pasien.id_pasien=pendaftaran.id_pasien 
                        JOIN diagnosa on diagnosa.id_pendaftaran= pendaftaran.id_pendaftaran WHERE tanggal_daftar LIKE '%$tanggal%' GROUP BY pasien.nama");
                        

                        ?>
                        <?php $i = 1; ?>
                        <?php foreach ($pasien as $row) : ?>

                            <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:400;">
                                <th><?= $i ?></th>
                                <td scope="row"><?= $row['no_rm'] ?></td>
                                <td scope="row"><?= $row['nama'] ?></td>
                                <td><?= $row['jenis_kelamin'] ?></td>
                                <td><?php
                                    $lahir = new DateTime($row['tanggal_lahir']);
                                    $umur = $waktu_sekarang->diff($lahir);
                                    echo $umur->y;
                                    echo " Tahun, ";
                                    echo $umur->m;
                                    echo " Bulan ";
                                    ?></td>
                                <td><?= $row['alamat'] ?></td>
                                <td><?= $row['keterangan'] ?></td>
                                <td><?= $row['tindakan'] ?></td>
                                <?php 
                                    $nama = $row['nama'];
                                    $isiDiagnosa = "";
                                    $diagnosa = query("SELECT diagnosa.a
                                    FROM pendaftaran
                                    JOIN pasien on pasien.id_pasien=pendaftaran.id_pasien 
                                    JOIN diagnosa on diagnosa.id_pendaftaran= pendaftaran.id_pendaftaran WHERE pasien.nama = '$nama' AND tanggal_daftar = '$tanggal'");
                                    foreach($diagnosa as $rows){
                                        $isiDiagnosa = $isiDiagnosa . $rows['a'] .', ';
                                    }
                                ?> 
                                <td><?= $isiDiagnosa ?></td>
                                <?php $i++; ?>
                            </tr>
                        <?php endforeach; ?>
                    </div>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>