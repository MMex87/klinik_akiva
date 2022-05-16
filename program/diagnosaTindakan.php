<?php
require 'fungsi.php';

$id_pendaftaran = $_POST['id_pendaftaran'];
$result = query("SELECT nama from pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE id_pendaftaran = $id_pendaftaran")[0];
$nama = $result['nama'];


$diagnosa = query("SELECT * FROM diagnosa WHERE id_pendaftaran = '$id_pendaftaran' AND status = '1'");

if ($diagnosa) {
    $jumlah = count($diagnosa) - 1;
    $tampil = $diagnosa[$jumlah];
    $pisah = explode(';', $tampil['o']);
} else {
    $data['s'] = "";
    $file[0] = "";
    $file[1] = "";
    $file[2] = "";
    $file[3] = "";
    $file[4] = "";
    $file[5] = "";
    $file[6] = "";
    $file[7] = "";
    $file[8] = "";
    $file[9] = "";
    $tampil = $data;
    $pisah = $file;
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Kilink Akiva</title>
    <link rel="icon" href="../img/Logo Klinik.jpeg">

    <!-- JQuery TimeStamp -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>

    <style>
        input,
        select,
        textarea {
            background-color: #fff;
            border: 1.5px solid #c4b8e7;
            color: black;
            border-radius: 2px;
            padding: 10px;
        }

        input {
            padding-left: 10px;
            height: 35px;
            font-family: "Roboto Mono", monospace;
        }

        button {
            width: 100px;
            height: 30px;
            border-radius: 10px;
        }

        th {
            height: 30px;
            font-family: "Roboto Mono", monospace;
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            border-bottom: 3px solid #c4b8e7;

            color: #1f2122;
        }

        .link-BC a:link {
            text-decoration: none;
            color: #6B59AE;
            opacity: 60%;
        }

        .link-BC a:visited {
            text-decoration: none;
            color: #6B59AE;
        }

        label {
            color: #1f2122;
            font-family: "Roboto Mono", monospace;
            font-weight: 500;
        }
    </style>
</head>

<body style="background-color: #c4b8e7;">
    <nav class="navbar navbar-expand-lg ps-4 pe-4" style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
                <li class="nav-item me-5 btn" style="background-color: #61529A; border-radius: 3px; width: 150px; text-align: center;">
                    <a href="pendaftaran.php" class="nav-link active" aria-current="page" style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">PENDAFTARAN</a>
                </li>
                <li class=" nav-item me-5 btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px">
                    <a href="obat.php" class="nav-link" style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">OBAT</a>
                </li>
                <li class="nav-item me-5 btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px">
                    <a href="pasien.php" class="nav-link" style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">PASIEN</a>
                </li>
                <li class=" nav-item btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px">
                    <a href="laporan.php" class="nav-link" style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">LAPORAN</a>
                </li>
            </ul>
        </div>
        <a href="#" class=""><img src="../img/Logo Klinik.png" width="100" height="100" style="margin-right: 20px" /></a>
    </nav>
    <div class="container-fluid ps-5 pe-5 link-BC">
        <div class="row pt-3 container-fluid ms-1">
            <div class='col-5'>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb fw-bold fs-4">
                        <li class="breadcrumb-item" style="color: #8471C9 ; font-family: 'Roboto Mono', monospace; font-weight:700;"> <a href="pendaftaran.php">DATA PASIEN</a></li>
                        <li class="breadcrumb-item active" style="color: #6B59AE ; font-family: 'Roboto Mono', monospace; font-weight:900;">DIAGNOSA</li>
                        <li class="breadcrumb-item" style="color: #8471C9 ; font-family: 'Roboto Mono', monospace; font-weight:700;"><a href="pendaftaranObat.php">OBAT</a></li>
                    </ol>
                </nav>
            </div>
            <div class='col-7 align-top mt-3 '>
                <h4 class="ms-5 mt-2" id="timestamp" style="float: right;"></h4>
            </div>
        </div>
        <div class='mb-2 ms-5'>
            <h4 class="me-2 float-start" style="font-family: 'Roboto Mono', monospace; font-weight:450;">NAMA : </h4>
            <h4 class="float-start" style="font-family: 'Roboto Mono', monospace; font-weight:450;"><?= $nama ?></h4>
        </div>
        <div class="container-fluid" style="margin-bottom: 150px;">
            <div class='mb-2'>
                <form action="diagnosaObat.php" method="post">
                    <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                    <input type="hidden" name="nama" value="<?= $nama ?>">

                    <Table style="width: 100%; background-color: #ffff;">
                        <tr style="align-items: center;">
                            <th style="width: 50% ;font-family: 'Roboto Mono', monospace; font-weight:900;">S</th>
                            <th style="width: 50%; font-family: 'Roboto Mono', monospace; font-weight:900;">O</th>
                        </tr>
                        <tr>
                            <td class="p-2"><textarea name="S" id="" cols="30" rows="10" style="widfont-family: 'Roboto Mono', monospace; font-weight:500; width: 100%; height: 100%;"><?= $tampil['s'] ?></textarea></td>
                            <td class="p-2">
                                <div class='float-start ps-2 mb-3'>
                                    <label for="gcs">GCS</label><br>
                                    <input type="text" name="gcs" id="gcs" style="width: 270px;" value="<?= $pisah[0] ?>" require><br>
                                    <label for="tensi">Tensi</label><br>
                                    <input type="text" name="tensi" id="tensi" style="width: 270px;" value="<?= $pisah[1] ?>" require><br>
                                    <label for="nacl">NACL</label><br>
                                    <input type="text" name="nacl" id="nacl" style="width: 270px;" value="<?= $pisah[2] ?>" require><br>
                                    <label for="respirasi">Respirasi Rate</label><br>
                                    <input type="text" name="respirasi" id="respirasi" style="width: 270px;" value="<?= $pisah[3] ?>" require><br>
                                    <label for="suhu">Suhu</label><br>
                                    <input type="text" name="suhu" id="suhu" style="width: 270px;" value="<?= $pisah[4] ?>" require><br>
                                </div>
                                <div class='float-end pe-2 mb-3'>
                                    <label for="penunjang">Pemeriksaan Penunjang</label><br>
                                    <input type="text" name="penunjang" id="penunjang" style="width: 270px;" value="<?= $pisah[5] ?>" require><br>
                                    <label for="gns">GNS</label><br>
                                    <input type="text" name="gns" id="gns" style="width: 270px;" value="<?= $pisah[6] ?>" require><br>
                                    <label for="au">AU</label><br>
                                    <input type="text" name="au" id="au" style="width: 270px;" value="<?= $pisah[7] ?>" require><br>
                                    <label for="choresterol">Choresterol</label><br>
                                    <input type="text" name="choresterol" id="choresterol" style="width: 270px;" value="<?= $pisah[8] ?>" require><br>
                                    <label for="lain">Lain - Lain</label><br>
                                    <input type="text" name="lain" id="lain" style="width: 270px;" value="<?= $pisah[9] ?>" require><br>
                                </div>
                            </td>
                        </tr>
                    </Table>
                    <div class='float-end mt-3'>
                        <button type="button" onclick="top.location='diagnosa.php'" class="bg-success fw-bold text-light" style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #c4b8e7;"> BACK </button>
                        <button type="submit" name="btNext" class="ms-2 bg-primary fw-bold text-light" style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #c4b8e7;"> NEXT
                    </div></button>
            </div>
            </form>
        </div>
    </div>
    </div>
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>