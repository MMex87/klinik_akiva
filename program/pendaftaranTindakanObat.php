<?php
require 'fungsi.php';

// Deklarasi no Pendaftaran dan NIK
$id_pendaftaran = $_POST['id_pendaftaran'];

// Select diagnosa
$diagnosa = query("SELECT * FROM diagnosa WHERE id_pendaftaran = '$id_pendaftaran' AND status = '2'");

$result = query("SELECT nama from pasien INNER JOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE id_pendaftaran = $id_pendaftaran")[0];
$nik = $result['nama'];

// default tanggal
date_default_timezone_set('Asia/Jakarta');

// looping get data
$a = 1;
$jumlahData = count($diagnosa);
if (isset($_POST['btSave'])) {
    if ($_POST['selesai'] == '1') {
        updateStatusDiagnosa($id_pendaftaran);
        updatePendaftaranStatusObat($id_pendaftaran);
        header("Location: pendaftaranObat.php");
    } else {
        while ($a <= $jumlahData) {
            if (isset($_POST['obat' . $a])) {
                // set parameter
                $jumlah = $_POST['jumlah' . $a];
                $tanggal = date("Y-m-d");
                $id_pendaftaran = $_POST['id_pendaftaran'];
                $id_obat = $_POST['id_obat' . $a];


                $sql = ("INSERT INTO penjualan VALUES ('','$jumlah' , '$tanggal', '$id_pendaftaran', '$id_obat')");

                if ($konek->multi_query($sql) === TRUE) {
                    updateStatusDiagnosa($id_pendaftaran);
                    updatePendaftaranStatusObat($id_pendaftaran);
                } else {
                    echo "Error : " . $sql . "<br>" . $konek->error;
                }
            }
            $a += 1;
        }
        header("Location: pendaftaranObat.php");
    }
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
        button {
            width: 100px;
            height: 30px;
            border-radius: 10px;
        }

        th {
            height: 30px;
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
            <div class='col-7'>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb fw-bold fs-4">
                        <li class="breadcrumb-item active" style="color: #6B59AE ; font-family: 'Roboto Mono', monospace; font-weight:900;"> <a href="pendaftaran.php">DATA PASIEN</a></li>
                        <li class="breadcrumb-item" style="color: #8471C9; font-family: 'Roboto Mono', monospace; font: weight 700;"><a href="diagnosa.php">DIAGNOSA</a></li>
                        <li class="breadcrumb-item" style="color: #6B59AE; font-family: 'Roboto Mono', monospace; font-weight:700;">OBAT</li>
                    </ol>
                </nav>
            </div>
            <div class='col-5 align-top mt-3 '>
                <h4 class="ms-5 mt-2" id="timestamp" style="float: right;"></h4>
            </div>
        </div>
        <div class='mt-2 mb-2 ms-5'>
            <h4 class="me-3">NAMA : <?= $nik ?></h4>
        </div>
        <div class="container-fluid" style="background-color: #fff; padding: 10px; box-sizing: border-box; 
        border-radius: 3px;">
            <div class='mb-5'>
                <form action="" method="post">
                    <Table style="width: 100%;" id="countDiagnosaObat">
                </form>
                <tr>
                    <th style="width: 20%;">Nama Obat</th>
                    <th style="width: 15%;">Jumlah</th>
                    <th style="width: 15%;">Pemakaian</th>
                    <th style="width: 15%;">Satuan</th>
                    <th style="width: 15%;">Aturan</th>
                    <th style="width: 20%;">Selesai</th>
                </tr>

                <?php $i = 1 ?>
                <?php foreach ($diagnosa as $row) : ?>
                    <form action="" method="post">
                        <?php
                        if ($row['p'] == null) { ?>
                            <tr>
                                <td>Tidak Pakai Obat</td>
                                <td>-</td>
                                <td class="p-2">
                                    <div class='float-start ms-2'>
                                        <input type="checkbox" name="selesai" value="1">
                                    </div>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td class="p-2">
                                    <h6><?= $row['p'] ?></h6>
                                </td> <input type="hidden" name="nama<?= $i ?>" value="<?= $row['p'] ?>"></td>
                                <td class="p-2">
                                    <h6><?= $row['jumlah'] ?></h6> <input type="hidden" name="jumlah<?= $i ?>" value="<?= $row['jumlah'] ?>">
                                </td>
                                <td class="p-2">
                                    <h6><?= $row['pemakaian'] ?></h6>
                                </td
                                >
                                <td class="p-2">
                                    <h6><?= $row['satuan'] ?></h6>
                                </td>
                                <td class="p-2">
                                    <h6><?= $row['aturan'] ?></h6>
                                </td>
                                <?php
                                $nama_obat = $row['p'];
                                $obat = "SELECT id_obat FROM obat WHERE nama_obat = '$nama_obat'";
                                $result = query($obat)[0];
                                $idObat = $result['id_obat'];
                                ?>
                                <input type="hidden" name="id_obat<?= $i ?>" value="<?= $idObat ?>">
                                <td class="p-2">
                                    <div class='float-start ms-2'>
                                        <input type="checkbox" name="obat<?= $i ?>" value="<?= $i ?>">
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php $i++ ?>
                    <?php endforeach;  ?>
                    </Table>
                    <div class='float-end mt-3'>
                        <div class='float-end me-3'>
                            <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                            <button type="submit" name="btSave" class="ms-2 bg-primary fw-bold text-light" style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffffff;">Save <img src="../img/send.png" width="17px" height="17px" class="mb-1">
                        </div></button>
                    </form>
            </div>
            <div class='float-end me-3 mt-3'>
                <button type="button" onclick="top.location='pendaftaranObat.php'" class="bg-success fw-bold text-light" style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffffff;">Back <img src="../img/send.png" width="17px" height="17px" class="mb-1"></button>
            </div>
        </div>
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

    <!-- script JS obat -->
    <script>
        function checkButton() {
            if (document.getElementById('obat').checked) {
                document.getElementById('noBPJS').style.display = "none";

            }
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