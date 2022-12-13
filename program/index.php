<?php
require 'fungsi.php';


if (isset($_POST['btTambah'])) {
    $koneksi = pendaftaranNik($_POST);
    if ($koneksi > 0) {
        echo "<script>
                        alert('Pendaftaran berhasil ditambahkan!');
                    </script>";
    } else {
        echo "<script>
                        alert('Pendaftaran gagal ditambahkan!');
                    </script>";
    }
}

// input tanggal

date_default_timezone_set('Asia/Jakarta');
$tanggal = date("Y-m-d");

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Klinik Akiva</title>
    <link rel="icon" href="../img/Logo Klinik.jpeg">

    <!-- JQuery TimeStamp -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>
</head>

<body style="background: #c4b8e7;">
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
    <div class="container-fluid ps-5 pe-5 link-BC" style="margin-bottom: 150px;">
        <div class="row pt-3 container-fluid ms-1">
            <div class='col-5'>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb fw-bold fs-4">
                        <li class="breadcrumb-item active" style="color: #6B59AE ; font-family: 'Roboto Mono', monospace; font-weight:900;">DATA PASIEN</li>
                        <li class="breadcrumb-item" style="color: #8471C9; font-family: 'Roboto Mono', monospace; font: weight 700;"><a href="diagnosa.php">DIAGNOSA</a></li>
                        <li class="breadcrumb-item" style="color: #8471C9; font-family: 'Roboto Mono', monospace; font-weight:700;"><a href="pendaftaranObat.php">OBAT</a></li>
                    </ol>
                </nav>
            </div>
            <div class='col-7 align-top mt-3'>
                <h4 class="ms-5 mt-2" id="timestamp" style="float: right;"></h4>
            </div>
        </div>
        <div class="container-fluid" style="background-color: #fff; border-radius: 2px;">
            <form action="" method="post">
                <div class="bodyForm">
                    <table style="width: 100%;">
                        <tr>
                            <th style="width: 20%;"></th>
                            <th style="width: 30%;"></th>
                            <th style="width: 20%;"></th>
                            <th style="width: 30%;"></th>
                        </tr>
                        <tr>
                            <td><label class="me-5" style="font-family: 'Roboto Mono', monospace; font-weight:750;">BPJS</label></td>
                            <td>
                                <input type="radio" name="bpjs" name="bpjs" value="BPJS" class="me-1" id="rd1" onclick="checkButton()">
                                <label for="rd1" class="me-2">Iya</label>
                                <input type="radio" name="bpjs" value="Umum" class="me-1" id="rd2" onclick="checkButton()">
                                <label for="rd2">Tidak</label>
                            </td>
                            <td><label for="dokter" style="font-family: 'Roboto Mono', monospace; font-weight:750;">Dokter</label></td>
                            <td><select name="dokter" id="dokter" style="width: 270px;" style="width: 270px; font-family: 'Roboto Mono', monospace; font-weight:550;" require>
                                    <option value="dr. Yohanes Ary Prayoga">dr. Yohanes Ary Prayoga</option>
                                    <option value="dr. Yudha Erik Prabowo">dr. Yudha Erik Prabowo</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="noBPJS" id="noBpjs" style="font-family: 'Roboto Mono', monospace; font-weight:750;">No. BPJS</label></td>
                            <td><input type="text" name="noBPJS" id="noBPJS" style="width: 270px; display: none;"></td>
                            <td><label for="tindakan" style="font-family: 'Roboto Mono', monospace; font-weight:750;">Tindakan</label></td>
                            <td><select name="tindakan" id="tindakan" style="width: 270px;" style="width: 270px; font-family: 'Roboto Mono', monospace; font-weight:550;" require>
                                    <option value="Poli Umum">Poli Umum</option>
                                    <option value="Poli Kecantikan">Poli Kecantikan</option>
                                    <option value="Fisioterapi">Fisioterapi</option>
                                    <option value="Rawat Luka">Rawat Luka</option>
                                    <option value="KIA">KIA (Bidan)</option>
                                    <option value="Antigen">Antigen</option>
                                    <option value="PCR">PCR</option>
                                </select>
                                <input type="hidden" value="<?= $tanggal ?>" name="tanggal">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="nik" style="font-family: 'Roboto Mono', monospace; font-weight:750;">NIK</label></td>
                            <td><input type="text" name="nik" id="nik" style="width: 270px; display: none;"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="ceknama" id="ceknama" value="Umum" onclick="cekNama()"> Tidak Membawa KTP & BPJS</td>
                            <td><input type="text" name="nama" id="nama" style="width: 270px; display: none;"></td>
                            <td><input type="hidden" name="status" value="1"></td>
                            <td class="fw-bold text-light">
                                <button type="reset" name="btReset" style="margin-left: 110px; font-family: 'Roboto Mono', monospace; font-weight:550;" class="bg-danger fw-bold text-light">RESET </button>
                                <button type="submit" name="btTambah" style="margin-left: 110px; font-family: 'Roboto Mono', monospace; font-weight:550;" class="ms-2 bg-primary fw-bold text-light">KIRIM
                </div></button>
                </td>
                </tr>
                </table>
        </div>
        </form>
    </div>
    </div>


    <!-- Script Ajax  -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- script Ajax no RM -->

    <script type="text/javascript">
        function cek_database() {
            var nik = $("#nik").val();
            $.ajax({
                url: 'ajaxNoRM.php',
                data: "nik=" + nik,
            }).success(function(data) {
                var json = data,
                    obj = JSON.parse(json);
                $('#noRM').val(obj.no_rm);
            });
        }
    </script>

    <!-- Memanggil jQuery.js -->
    <script src="jquery-3.2.1.min.js"></script>

    <!-- Memanggil Autocomplete.js -->
    <script src="jquery.autocomplete.min.js"></script>

    <!-- Script auto complate NIK-->

    <script>
        $(document).ready(function() {
            $("#nik").autocomplete({
                serviceUrl: 'autoComplateNikPendaftaran.php',
                dataType: 'JSON',
                onSelect: function(suggestion) {
                    $('#nik').val("" + suggestion.nik);
                }
            });
        });
    </script>

    <!-- Script auto complate No BPJS-->

    <script>
        $(document).ready(function() {
            $("#noBPJS").autocomplete({
                serviceUrl: 'autoComplateNoBpjs.php',
                dataType: 'JSON',
                onSelect: function(suggestion) {
                    $('#noBPJS').val("" + suggestion.no_bpjs);
                }
            });
        });
    </script>
    <!-- auto Complate Nama -->
    <script>
        $(document).ready(function() {
            $("#nama").autocomplete({
                serviceUrl: 'autoComplateNama.php',
                dataType: 'JSON',
                onSelect: function(suggestion) {
                    $('#nama').val("" + suggestion.nama);
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
    <!-- script JS Pendaftaran -->
    <script>
        function checkButton() {
            if (document.getElementById('rd2').checked) {
                document.getElementById('noBPJS').style.display = "none";
                document.getElementById('nik').style.display = "";
            } else if (document.getElementById('rd1').checked) {
                document.getElementById('noBPJS').style.display = "";
                document.getElementById('nik').style.display = "none";
            }
        }
    </script>

    <!-- script cek NAMA -->
    <script>
        function cekNama() {
            if (document.getElementById('ceknama').checked) {
                document.getElementById('nama').style.display = "";
                if (document.getElementById('rd2').checked) {
                    document.getElementById('rd2').checked = false;
                    document.getElementById('nik').style.display = "none";
                } else if (document.getElementById('rd1').checked) {
                    document.getElementById('rd1').checked = false;
                    document.getElementById('noBPJS').style.display = "none";
                }
            } else {
                document.getElementById('nama').style.display = "none";
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
