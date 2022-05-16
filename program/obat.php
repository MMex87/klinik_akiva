<?php
require 'fungsi.php';

// waktu
date_default_timezone_set('Asia/Jakarta');
$waktu_sekarang = new DateTime();

$id         = "";
$nama       = "";
$jumlah     = "";
$jenis      = "";
$tanggalBel = $waktu_sekarang->format('Y-m-d');
$sukses     = "";
$error      = "";


if (isset($_GET['tindakan'])) {
    $tindakan = $_GET['tindakan'];
} else {
    $tindakan = "";
}

if ($tindakan == "edit") {
    $id = $_GET['id'];
    // ambil Data
    $obat = query("SELECT * FROM obat WHERE id_obat = '$id'")[0];

    // input Data
    $nama       = $obat['nama_obat'];
    $jumlah     = $obat['jumlah_obat'];
    $jenis      = $obat['jenis_obat'];
    $exp        = $obat['expired_date'];
} else if ($tindakan == "delete") {
    $id = $_GET['id'];
    if (hapus_obat($id) > 0) {
        echo "
            <script>
                alert('data berhasil dihapus!');
                document.location.href = 'data_obat.php'
            </script>";
    } else {
        echo "
            <script>
                alert('data gagal dihapus!');
                document.location.href = 'data_obat.php'
            </script>";
    }
}

if (isset($_POST['btAdd'])) {
    if ($tindakan == "edit") {

        if (update_obat($_POST) > 0) {
            $sukses = 'Obat berhasil diEdit!';
        } else {
            $error = 'Obat gagal diEdit!';
        }
    } else {
        $aksi = tambah_obat($_POST);
        if ($aksi == "tambah") {
            $sukses = 'Obat berhasil diTambahkan!';
        } else if ($aksi == "stock") {
            $sukses = 'Stock Obat berhasil diTambahkan!';
        } else {
            $error = 'Obat gagal diTambahkan!';
        }
    }
}



?>






<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Kilink Akiva</title>
    <link rel="icon" href="../img/Logo Klinik.jpeg">

    <!-- JQuery TimeStamp -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>

    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body style="background: #c4b8e7;">
    <nav class="navbar navbar-expand-lg ps-4 pe-4" style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
                <li class="nav-item me-5 btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px; text-align: center;">
                    <a href="pendaftaran.php" class="nav-link" aria-current="page" style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">PENDAFTARAN</a>
                </li>
                <li class=" nav-item me-5 btn" style="background-color: #61529A; border-radius: 3px; width: 150px">
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
    <div class="container-fluid1 ps-5 pe-5">
        <div class="row pt-3 container-fluid ms-1">
            <div class='col-5'>
                <h1 style="color: #6B59AE ; font-family: 'Roboto Mono', monospace; font-weight:500;">OBAT</h1>
            </div>
            <div class='col-7 align-top mt-3'>
                <h4 class="ms-5 mt-2" id="timestamp" style="float: right;"></h4>
            </div>
        </div>
        <div class="container-fluid" style="background: #ffffff; border-radius: 3px;">
            <form action="" method="post">
                <div class="bodyForm">
                    <?php
                    if ($error) {
                    ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?= $error ?>
                        </div>
                    <?php

                        header("refresh:2;url=obat.php"); //5 : detik

                    }
                    ?>

                    <?php
                    if ($sukses) {
                    ?>
                        <div class="alert alert-info mt-3" role="alert">
                            <?= $sukses ?>
                        </div>
                    <?php
                        header("refresh:2;url=obat.php"); //5 : detik
                    }

                    ?>
                    <table style="width: 100%;">
                        <tr>
                            <th style="width: 20%;"></th>
                            <th style="width: 30%;"></th>
                            <th style="width: 20%;"></th>
                            <th style="width: 30%;"></th>
                        </tr>
                        <tr>
                            <!-- input id hidden -->
                            <input type="hidden" value="<?= $id ?>" name="id_obat">
                            <input type="hidden" value="<?= $tanggalBel ?>" name="tanggalBel">
                            <td><label for="nama_obat"> Obat</label></td>
                            <td><input type="text" name="nama_obat" id="nama_obat" style="width: 270px;" value="<?= $nama ?>" placeholder="nama obat"> </td>

                            <td><label for=" jenis">Jenis</label></td>
                            <td><select name="jenis" id="jenis" style="width: 270px;" value="<?= $jenis ?>">
                                    <option value="Kapsul" <?php if ($jenis == "Kapsul") { ?> selected <?php } ?>>Kapsul</option>
                                    <option value="Tablet" <?php if ($jenis == "Tablet") { ?> selected <?php } ?>>Tablet</option>
                                    <option value="Sendok" <?php if ($jenis == "Sendok") { ?> selected <?php } ?>>Sendok</option>
                                    <option value="Bungkus" <?php if ($jenis == "Bungkus") { ?> selected <?php } ?>>Bungkus</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="jumlah_obat">Jumlah Obat</label></td>
                            <td><input type="text" name="jumlah_obat" id="jumlah_obat" style="width: 270px;" value="<?= $jumlah ?>" placeholder="Jumlah obat"></td>

                            <td><label for="expired_date">Expired Date</label></td>
                            <td><input type="date" name="expired_date" id="expired_date" style="width: 270px;" value="<?= $exp ?>"></td>

                        </tr>
                        <tr class="jenisUmur">
                            <td class="fw-bold text-light">
                                <button type="reset" name="btReset" style="margin-left: 4px;" class="bg-danger fw-bold text-light"><img src="../img/refresh.png" width="20px" height="20px" class="mb-1"> RESET</button>
                                <button type="submit" name="btAdd" style="margin-left: 4px; margin-top: 10px;" class="bg-primary fw-bold text-light"><img src="../img/save.png" width="20px" height="20px" class="mb-1"> SAVE</button>
                                <button type="button" name="btData" style="margin-left: 4px; margin-top: 10px;" class="bg-info fw-bold text-light"><img src="../img/data.png" width="20px" height="20px" class="mb-1"><a href="data_obat.php" class="to_data" style="text-decoration: none; color:#ffffff;"> DATA </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>


    <!-- Memanggil jQuery.js -->
    <script src="jquery-3.2.1.min.js"></script>

    <!-- Memanggil Autocomplete.js -->
    <script src="jquery.autocomplete.min.js"></script>


    <!-- Script auto complate Nama_obat-->

    <script>
        $(document).ready(function() {
            $("#nama_obat").autocomplete({
                serviceUrl: 'autoComplateNamaObat.php',
                dataType: 'JSON',
                onSelect: function(suggestion) {
                    $('#nama_obat').val("" + suggestion.nama_obat);
                }
            });
        });
    </script>

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