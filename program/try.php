<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Kilink Akiva</title>
    <link rel="icon" href="../img/Logo Klinik.jpeg">
    <link rel="stylesheet" href="p.css">

    <!-- JQuery TimeStamp -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>

    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body>
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
                        <li class="breadcrumb-item" style="color: #8471C9 ; font-family: 'Roboto Mono', monospace; font-weight:700;"> <a href="pendaftaran.php">DATA PASIEN</a></li>
                        <li class="breadcrumb-item active" style="color: #6B59AE ; font-family: 'Roboto Mono', monospace; font-weight:900;">DIAGNOSA</li>
                        <li class="breadcrumb-item" style="color: #8471C9 ; font-family: 'Roboto Mono', monospace; font-weight:700;"><a href="pendaftaranObat.php">OBAT</a></li>
                    </ol>
                </nav>
            </div>
            <div class='col-5 align-top mt-3 '>
                <h4 class="ms-5 mt-2" id="timestamp" style="float: right;"></h4>
            </div>
        </div>
    </div>
    <div class='mt-2 mb-2 ms-5'>
        <h4 class="me-3" style="font-family: 'Roboto Mono', monospace; font-weight:500;">NAMA : <?= $nama ?></h4>
    </div>
    <div class="container-fluid" style="background-color: #eee; padding-top:4px; margin-right:20px;box-sizing: border-box; border-radius: 2px;">
        <!-- Tabel 1 -->

        <table cellspacing='0' cellpadding='5'>
            <!--HEAD -->
            <tr>
                <th style="width: 20%;">S</th>
                <th colspan="2" style="width: 30%;">O</th>
                <th style=" width: 5%;">A</th>
                <th colspan="3" style="width: 5%;">P</th>
            </tr>
            <!-- Data No 1 -->
            <tr>
                <td rowspan="10" class="tds">Hallo1</td>
                <td class="tdo"> GCS </td>
                <td class="tdo1"> GCS </td>
                <td rowspan="10" class="tda">
                    <label for="input"> Diganosa</label>
                    <input name="input">

                </td>
                <td rowspan="10" colspan="2" class="tdp">
                    <label for="obat"> Obat </label>
                    <input type="text" name="obat" id="">
                </td>
                <td rowspan="10" class="tdp">
                    <label for="qty"> Jumlah </label>
                    <input type="text" name="qty" id="">
                </td>

            </tr>
            <!-- Data No 2 -->
            <tr>
                <td class="tdo">Tensi</td>
                <td class="tdo1">Tensi </td>

            </tr>
            <!-- Data No 3 -->
            <tr>
                <td class="tdo">NACL</td>
                <td class="tdo1">NACL </td>

            </tr>
            <tr>
                <td class="tdo">RR</td>
                <td class="tdo1">RR </td>

            </tr>
            <tr>
                <td class="tdo">Suhu</td>
                <td class="tdo1">Suhu</td>

            </tr>
            <tr>
                <td class="tdo">PP</td>
                <td class="tdo1">PP</td>

            </tr>
            <tr>
                <td class="tdo">GNS</td>
                <td class="tdo1">GNS</td>

            </tr>
            <tr>
                <td class="tdo">AU</td>
                <td class="tdo1">AU</td>

            </tr>
            <tr>
                <td class="tdo">Kolesterol</td>
                <td class="tdo1">Kolesterol</td>

            </tr>
            <!-- Data No Last -->
            <tr>
                <td class="tdo">Lain-Lain</td>
                <td class="tdo1">Lain- Lain</td>

            </tr>
        </table>

        <!-- Button -->
        <td colspan="4" class="p-2"><button type="submit" name="btTambah" class="ms-2 bg-primary fw-bold text-light float-end me-3" style="width: 110px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;"> ADD <img src="../img/plus.png" width="20px" height="20px" class="mb-1">
            </button></td>

        <!-- Tabel 2 -->
        <table cellspacing='0' cellpadding='5' style="margin-top:90px">
            <tr>
                <th style="width: 10%;">S</th>
                <th colspan="2" style="width: 25%;">O</th>
                <th style=" width: 20%;">A</th>
                <th colspan="3" style="width: 20%;">P</th>
            </tr>
            <tr>
                <td rowspan="10" class="tds">Hallo1</td>
                <td class="tdo"> GCS </td>
                <td class="tdo1"> GCS </td>
                <td class="tda">
                    data a
                </td>
                <td colspan="2" class="tdp">
                    Nama Obat
                </td>
                <td class="tdp">
                    Jumlah
                </td>
            </tr>
            <tr>
                <td class="tdo">Tensi</td>
                <td class="tdo1">Tensi </td>

            </tr>
            <tr>
                <td class="tdo">NACL</td>
                <td class="tdo1">NACL </td>

            </tr>
            <tr>
                <td class="tdo">RR</td>
                <td class="tdo1">RR </td>

            </tr>
            <tr>
                <td class="tdo">Suhu</td>
                <td class="tdo1">Suhu</td>

            </tr>
            <tr>
                <td class="tdo">PP</td>
                <td class="tdo1">PP</td>

            </tr>
            <tr>
                <td class="tdo">GNS</td>
                <td class="tdo1">GNS</td>

            </tr>
            <tr>
                <td class="tdo">AU</td>
                <td class="tdo1">AU</td>

            </tr>
            <tr>
                <td class="tdo">Kolesterol</td>
                <td class="tdo1">Kolesterol</td>

            </tr>
            <tr>
                <td class="tdo">Lain-Lain</td>
                <td class="tdo1">Lain- Lain</td>

            </tr>
        </table>
    </div>
    <div class='float-end' style="border: 1px solid red;">
        <div class='float-end me-3'>
            <form action="" method="post">
                <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                <button type="submit" name="btSave" class="ms-2 bg-primary fw-bold text-light" style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;"> SAVE</button>
            </form>
        </div>
        <div class='float-end me-3 mt-2'>
            <form action="diagnosaTindakan.php" method="post">
                <input type="hidden" name="id_pendaftaran" value="<?= $id_pendaftaran ?>">
                <button type="submit" class="bg-success fw-bold text-light" style="width: 120px; height: 30px; border-radius: 2px; font-family: 'Roboto Mono', monospace; font-weight:450;  border: 2px solid #ffff;">BACK</button>
            </form>
        </div>
    </div>
</body>

</html>