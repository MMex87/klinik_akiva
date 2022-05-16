<?php
require 'fungsi.php';

if (isset($_POST['btHapus'])) {
    hapus_diagnosa($_POST['id_pendaftaran']);
}

$pasien = query("SELECT * FROM pasien INNER jOIN pendaftaran on pasien.id_pasien = pendaftaran.id_pasien WHERE pendaftaran.status = 1");
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

<body class="text-dark" style="background-color: #c4b8e7;">
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
            <div class='col-7 align-top mt-3'>
                <h4 class="ms-5 mt-2" id="timestamp" style="float: right;"></h4>
            </div>
        </div>
        <div class="container-fluid">
            <div>
                <h2 style=" font-family: 'Roboto Mono', monospace; font-weight:500;">List Pendaftaran</h2>
            </div>
            <div class='p-2 mb-5' style="background-color: #fff; border-radius: 2px;">
                <table class="table">
                    <tr class="p-2 align-baseline" style=" font-family: 'Roboto Mono', monospace; font-weight:900; border-bottom: black solid 2px;">
                        <th scope="col">#</th>
                        <th scope="col">No RM</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">NIK</th>
                        <th scope="col">TINDAKAN</th>
                        <th scope="col">DOKTER</th>
                        <th scope="col">KETERANGAN</th>
                        <th colspan="2" scope="col">AKSI</th>

                    </tr>
                    <?php $a = 1; ?>
                    <?php foreach ($pasien as $row) : ?>
                        <form action="diagnosaTindakan.php" method="post">
                            <tr class="p-2 align-baseline" style=" font-family: 'Roboto Mono', monospace; font-weight:390;">
                                <td style="font-family: 'Roboto Mono', monospace; font-weight:900;"><?= $a ?></td>
                                <td><?= $row['no_rm'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['nik'] ?></td>
                                <td><?= $row['tindakan'] ?></td>
                                <td><?= $row['nama_dokter'] ?> <input type="hidden" name="id_pendaftaran" value="<?= $row['id_pendaftaran'] ?>"></td>
                                <td><?= $row['keterangan'] ?></td>
                                <td colspan="2"><button type="submit" name="btTindakan" class="button bg-primary text-light" style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffffff;"> TINDAKAN </button></td>
                        </form>
                        <form action="" method="post">
                            <input type="hidden" value="<?= $row['id_pendaftaran'] ?>" name="id_pendaftaran">
                            <td colspan="2">
                                <button type="submit" name="btHapus" style="width: 30px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border-radius:5px;  border:1px solid #ffffff;" class="bg-danger fw-bold text-light"> X
                                </button>
                            </td>
                            <?php $a++; ?>
                            </tr>
                        </form>
                    <?php endforeach; ?>
                </table>
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

    <!-- script JS Pendaftaran -->
    <script>
        function checkButton() {
            if (document.getElementById('rd2').checked) {
                document.getElementById('noBPJS').style.display = "none";
                document.getElementById('labBpjs').style.display = "none";
            } else if (document.getElementById('rd1').checked) {
                document.getElementById('noBPJS').style.display = "";
                document.getElementById('labBpjs').style.display = "";
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