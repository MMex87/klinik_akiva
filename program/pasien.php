<?php
require 'fungsi.php';

$id_pasien = "";
$nama = "";
$nik = "";
$jenisKel = "";
$tanggalLah = "";
$no_bpjs = "";
$alamat = "";
$rm = "";
$no_hp = "";
$error = "";
$sukses = "";

if (isset($_GET['tindakan'])) {
    $tindakan = $_GET['tindakan'];
} else {
    $tindakan = "";
}

if ($tindakan == "hapus") {
    $id = $_GET['id'];
    if (hapus_pasien($id) > 0) {
        echo "
				<script>
					alert('data berhasil dihapus!');
					document.location.href = 'data_pasien.php'
				</script>";
    } else {
        echo "
                <script>
                    alert('data gagal dihapus!');
                    document.location.href = 'data_pasien.php'
                </script>";
    }
} else if ($tindakan == "edit") {
    $id_pasien = $_GET['id'];
    // ambil data
    $pasien = query("SELECT * FROM pasien WHERE id_pasien = $id_pasien")[0];
    // input data
    $nama = $pasien['nama'];
    $nik = $pasien['nik'];
    $rm = $pasien['no_rm'];
    $jenisKel = $pasien['jenis_kelamin'];
    $tanggalLah = $pasien['tanggal_lahir'];
    $no_bpjs = $pasien['no_bpjs'];
    $alamat = $pasien['alamat'];
    $no_hp = $pasien['no_telfone'];
}

if (isset($_POST['btAdd'])) {
    if ($tindakan == "edit") {
        if (edit_pasien($_POST) > 0) {
            $sukses = 'Pasien berhasil diEdit!';
        } else {
            $error = 'Pasien gagal diEdit!';
        }
    } else {
        $aksi = tambah_pasien($_POST);
        if ($aksi == "berhasil") {
            $sukses = 'Pasien Baru Berhasil Ditambahkan!';
        } else if ($aksi == "gagal") {
            $error = 'Pasien Sudah Ada, Data Gagal Ditambahkan';
        } else {
            $error = 'Pasien Baru Gagal Ditambahkan!';
        }
    }
}



?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JQuery TimeStamp -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Kilink Akiva</title>
    <link rel="icon" href="../img/Logo Klinik.jpeg">
</head>

<body style="background: #c4b8e7;">
    <nav class=" navbar navbar-expand-lg ps-4 pe-4" style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
                <li class="nav-item me-5 btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px; text-align: center;">
                    <a href="pendaftaran.php" class="nav-link " aria-current="page" style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">PENDAFTARAN</a>
                </li>
                <li class=" nav-item me-5 btn" style="background-color: #7d64c5; border-radius: 3px; width: 150px">
                    <a href="obat.php" class="nav-link" style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">OBAT</a>
                </li>
                <li class="nav-item me-5 btn" style="background-color: #61529A; border-radius: 3px; width: 150px">
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
        <div class="row pt-3 container-fluid">
            <div class='col-7'>
                <h1 style="color: #6B59AE ; font-family: 'Roboto Mono', monospace; font-weight:500;">PASIEN</h1>
            </div>
            <div class='col-5 align-top mt-3'>
                <h4 class="ms-5 mt-1" id="timestamp" style="float: right;"></h4>
            </div>
        </div>
        <div class="container-fluid" style="background: #ffffff; border-radius: 3px;">
            <form action="" method="post">
                <div class="bodyForm">
                    <!-- Alert -->
                    <?php
                    if ($error) {
                    ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?= $error ?>
                        </div>
                    <?php

                        header("refresh:2;url=pasien.php"); //5 : detik

                    }
                    ?>

                    <?php
                    if ($sukses) {
                    ?>
                        <div class="alert alert-info mt-3" role="alert">
                            <?= $sukses ?>
                        </div>
                    <?php
                        header("refresh:2;url=pasien.php"); //5 : detik
                    }

                    ?>
                    <!-- Inputan Data -->
                    <table style="width: 100%;">
                        <tr>
                            <th style="width: 20%;"></th>
                            <th style="width: 30%;"></th>
                            <th style="width: 20%;"></th>
                            <th style="width: 30%;"></th>
                        </tr>
                        <!-- input id hidden -->
                        <input type="hidden" value="<?= $id_pasien ?>" name="id_pasien">
                        <tr>
                            <td><label for="noBPJS">No.BPJS</label></td>
                            <td><input type="text" name="noBPJS" id="noBPJS" style="width: 270px;" maxlength="13" autocomplete="off" value="<?= $no_bpjs ?>" placeholder="no.BPJS"></td>

                            <td><label for="nik">NIK</label></td>
                            <td><input type="text" name="nik" id="nik" style="width: 270px;" maxlength="16" autocomplete="off" value="<?= $nik ?>" require placeholder="NIK "></td>

                        </tr>

                        <tr>
                            <td><label for="namaPasien">Nama</label></td>
                            <td><input type="text" name="namaPasien" id="namaPasien" style="width: 270px;" value="<?= $nama ?>" require placeholder="Nama Pasien"></td>

                            <td><label for="noHP">No HP</label></td>
                            <td><input type="text" name="noHP" id="noHP" style="width: 270px;" value="<?= $no_hp ?>" require placeholder="No HP"></td>

                        </tr>


                        <tr>
                            <td><label for="tanggalLahir">Tanggal Lahir</label></td>
                            <td><input type="date" name="tanggalLahir" id="tanggalLahir" style="width: 270px;" value="<?= $tanggalLah ?>" require></td>

                            <td><label for="alamat">Alamat</label></td>
                            <td><input type="text" name="alamat" id="alamat" style="width: 270px;" value="<?= $alamat ?>" require placeholder="Alamat Pasien"></td>

                        </tr>

                        <tr>
                            <td><label for="jenisKelamin">Jenis Kelamin</label></td>
                            <td><select name="jenisKelamin" id="jenisKelamin" style="width: 270px;" value="<?= $jenisKel ?>" require>
                                    <option value="Laki Laki" <?php if ($jenisKel == "Laki Laki") { ?> selected <?php } ?>>Laki - Laki</option>
                                    <option value="Perempuan" <?php if ($jenisKel == "Perempuan") { ?> selected <?php } ?>>Perempuan</option>
                                </select></td>
                            <td><label for="noRM">RM</label></td>
                            <td><input type="text" name="noRM" id="noRM" style="width: 270px;" require value="<?= $rm ?>"></td>
                        </tr>


                        <tr>
                            <td class="fw-bold text-light">
                                <button type="reset" name="btReset" style="margin-left: 4px;" class="bg-danger fw-bold text-light"><img src="../img/refresh.png" width="20px" height="20px" class="mb-1"> RESET</button>
                                <button type="submit" name="btAdd" style="margin-left: 4px; margin-top: 10px;" class="bg-primary fw-bold text-light"><img src="../img/save.png" width="20px" height="20px" class="mb-1"> SAVE</button>
                                <button type="button" name="btData" style="margin-left: 4px; margin-top: 10px;" class="bg-info fw-bold text-light"> <img src="../img/data.png" width="20px" height="20px" class="mb-1"> <a href="data_pasien.php" class="to_data" style="text-decoration: none; color:#ffffff;"> DATA</a></button>
                            </td>
                        </tr>

                    </table>
                </div>
            </form>
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

    <!-- script JS Pendaftaran -->
    <script>
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