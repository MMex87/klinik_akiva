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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Kilink Akiva</title>
    <link rel="icon" href="../img/Logo Klinik.jpeg">

    <!-- Library JQuery -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>


</head>

<body style="background: #c4b8e7;">

    <nav class=" navbar navbar-expand-lg ps-4 pe-4  fixed-top"
        style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
                <li class="nav-item me-5 btn"
                    style="background-color: #61529A; border-radius: 3px; width: 150px; text-align: center;">
                    <a href="laporan.php" class="nav-link " aria-current="page"
                        style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">BACK</a>
                </li>
            </ul>
        </div>

        <a href="#" class=""><img src="../img/Logo Klinik.png" width="100" height="100"
                style="margin-right: 20px" /></a>
    </nav>

    <div class="card ms-3 me-3" style="margin-top: 100px;">
        <div class="card-header text-dark" style="background-color: #A595D6;">
            <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; "> DAFTAR PEMERIKSAAN
            </h1>
            <form action="" method="get" class="cari" style="float:right">
                <input type="text" placeholder="cari data.." id="cari" name="cari" autofocus autocomplete="off"
                    value="<?php if (isset($_GET['cari'])) echo $_GET['cari']; ?>">
                <button class="button" type="submit" id="cari"
                    style="color: #ffffff; background-color: #2A87FF; border-radius: 3px; border: 1px solid #A595D6;">Cari
                    <img src="../img/cari.png" width="20px" height="20px" class="ms-1 mb-1"></button>
            </form>
        </div>
        <?php
        $kolomKataKunci = (isset($_GET['cari'])) ? $_GET['cari'] : "";

        if ($kolomKataKunci == "") {
            // ambil data dari table pasien
            $pasien = query("SELECT * FROM pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE month(pendaftaran.tanggal_daftar) BETWEEN 02 AND 03 HAVING year(pendaftaran.tanggal_daftar) = 2022 AND pendaftaran.status=0");
        } else {
            // kondisi jika parameter pencarian diisi
            $pasien = query("SELECT * FROM pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE month(pendaftaran.tanggal_daftar) BETWEEN 02 AND 03 HAVING year(pendaftaran.tanggal_daftar) = 2022 AND pendaftaran.status=0 AND pasien.nama LIKE '%$kolomKataKunci%' OR pasien.no_rm LIKE '%$kolomKataKunci%'");
        }

        ?>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:800;">
                        <th scope="col">#</th>
                        <th scope="col">RM</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Tanggal Daftar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($pasien as $p) : ?>
                    <tr class="data view-pasien"
                        style="color: black; font-family:  'Roboto Mono', monospace; font-weight:400;">
                        <th scope="row"><?= $i++; ?></th>
                        <td scope="row"><?= $p['no_rm']; ?></td>
                        <td scope="row"><?= $p['nama']; ?></td>
                        <td scope="row"><?= $p['jenis_kelamin']; ?></td>
                        <td scope="row" style="color: red;"><?= $p['tanggal_daftar']; ?></td>
                        <input type="hidden" value="<?= $p['id_pendaftaran']; ?>" class="id_pendaftaran">
                        <td scope="row">
                            <a><button type="button" class="tombol btn-warning mb-1 btn-view" data-bs-toggle="modal"
                                    data-bs-target="#viewModal"
                                    data-id="<?= $p['id_pendaftaran']; ?>">Detail</button></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #E5E5E5;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Ajax  -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

    <script src="scriptPemeriksaan.js"></script>

</body>

</html>