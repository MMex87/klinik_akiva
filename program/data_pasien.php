<?php
require 'fungsi.php';

// waktu
date_default_timezone_set('Asia/Jakarta');
$waktu_sekarang = new DateTime();


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
    <!-- <link rel="stylesheet" type="text/css" href="../style/stylePendaftaran.css"> -->

</head>

<body style="background: #c4b8e7;">
    <nav class=" navbar navbar-expand-lg ps-4 pe-4" style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
                <li class="nav-item me-5 btn" style="background-color: #61529A; border-radius: 3px; width: 150px; text-align: center;">
                    <a href="pasien.php" class="nav-link " aria-current="page" style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">BACK</a>
                </li>
            </ul>
        </div>
        <a href="#" class=""><img src="../img/Logo Klinik.png" width="100" height="100" style="margin-right: 20px" /></a>
    </nav>

    <div class="card mt-3 ms-3 me-3">
        <div class="card-header text-dark" style="background-color: #A595D6;">
            <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; ">DATA PASIEN</h1>

            <form class="form-inline" action="" method="get" style="float:right">

                <input type="text" placeholder="cari data.." id="cari" name="cari" autofocus autocomplete="off" value="<?php if (isset($_GET['cari'])) echo $_GET['cari']; ?>">
                <button class="button" type="submit" id="cari" style="color: #ffffff; background-color: #2A87FF; border-radius: 3px; border: 1px solid #A595D6;">Cari <img src="../img/cari.png" width="20px" height="20px" class="ms-1 mb-1"></button>

            </form>
        </div>

        <br>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:800;">
                        <th scope="col">#</th>
                        <th scope="col">No.BPJS</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No RM</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Umur</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <?php

                // jumlah data per halamn

                $jumlahDataPerHalaman = 7;
                // Pagination 

                $halamanAktif = (isset($_GET['halaman'])) ? (int) $_GET['halaman'] : 1;
                // awal data
                $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

                $kolomKataKunci = (isset($_GET['cari'])) ? $_GET['cari'] : "";


                // kondisi jika parameter pencarian kosong
                if ($kolomKataKunci == "") {
                    // ambil data dari table pasien
                    $pasien = query("SELECT * FROM pasien ORDER BY id_pasien DESC LIMIT " . $awalData . "," . $jumlahDataPerHalaman . "");
                } else {
                    // kondisi jika parameter pencarian diisi
                    $pasien = cari($kolomKataKunci, $awalData, $jumlahDataPerHalaman);
                }



                ?>
                <?php $i = 1; ?>
                <?php foreach ($pasien as $row) : ?>
                    <tbody>
                        <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:400;">
                            <th><?= $i ?></th>
                            <td scope="row"><?= $row['no_bpjs'] ?></td>
                            <td scope="row"><?= $row['nik'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['no_rm'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td><?php
                                $lahir = new DateTime($row['tanggal_lahir']);
                                $umur = $waktu_sekarang->diff($lahir);
                                echo $umur->y;
                                echo " Tahun, ";
                                echo $umur->m;
                                echo " Bulan, ";
                                echo $umur->d;
                                echo " Hari";
                                ?></td>
                            <td><?= $row['jenis_kelamin'] ?></td>
                            <td>
                                <a href="pasien.php?tindakan=edit&id=<?= $row['id_pasien'] ?>"><button type="button" class="tombol btn-warning mb-1 ">Edit</button></a>
                                <a href="pasien.php?tindakan=hapus&id=<?= $row['id_pasien'] ?>" onclick="return confirm('Hapus Data?')"><button type="button" class="tombol btn-danger mb-1">Delete</button></a>
                            </td>
                            <?php $i++; ?>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>

        <nav aria-label="Page navigation example ">
            <ul class="pagination justify-content-end me-4">
                <!-- Previus -->
                <?php
                // jika page = 1, maka LinkPrev disable
                if ($halamanAktif == 1) { ?>
                    <li class="disabled page-item">
                        <a class="page-link">Previous</a>
                    </li>
                    <?php } else {
                    $linkPrev = ($halamanAktif > 1) ? $halamanAktif - 1 : 1;

                    if ($kolomKataKunci == "") { ?>
                        <li class="page-item"><a class="page-link" href="data_pasien.php?halaman=<?= $linkPrev ?>" class="page-link">Previous</a></li>
                    <?php } else { ?>
                        <li class="page-item"><a class="page-link" href="data_pasien.php?cari=<?= $kolomKataKunci ?>&halaman=<?= $linkPrev ?>">Previous</a></li>
                <?php }
                }
                ?>
                <!-- Halaman -->
                <?php
                // kondisi jika parameter pencarian kosong
                if ($kolomKataKunci == "") {
                    // ambil data dari table pasien
                    $pasien = query("SELECT * FROM pasien ORDER BY id_pasien DESC");
                } else {
                    // kondisi jika parameter pencarian diisi
                    $pasien = cariTanpaLimit($kolomKataKunci);
                }
                $jumlahData = count($pasien);
                $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

                //jumlah link number
                $jumlahNumber = 1;
                // awal link number
                $startNumber = ($halamanAktif > $jumlahNumber) ? $halamanAktif - $jumlahNumber : 1;

                // akhir link number
                $endNumber = ($halamanAktif < ($jumlahHalaman - $jumlahNumber)) ? $halamanAktif + $jumlahNumber : $jumlahHalaman;

                for ($i = $startNumber; $i <= $endNumber; $i++) {
                    $linkActive = ($halamanAktif == $i) ? 'class="active page-item"' : "";
                    if ($kolomKataKunci == "") { ?>
                        <li <?= $linkActive ?>><a class="page-link" href="data_pasien.php?halaman=<?= $i ?>"><?= $i ?></a></li>
                    <?php } else { ?>
                        <li <?= $linkActive ?>><a class="page-link" href="data_pasien.php?cari=<?= $kolomKataKunci ?>&halaman=<?= $i ?>"><?= $i ?></a></li>
                <?php }
                }
                ?>

                <!-- next -->
                <?php
                // jika page = 1, maka LinkNext disable
                if ($halamanAktif == $jumlahHalaman) { ?>
                    <li class="disabled page-item">
                        <a class="# page-link">Next</a>
                    </li>
                    <?php } else {
                    $linkNext = ($halamanAktif < $jumlahHalaman) ? $halamanAktif + 1 : $jumlahHalaman;

                    if ($kolomKataKunci == "") { ?>
                        <li class="page-item"><a class="page-link" href="data_pasien.php?halaman=<?= $linkNext ?>">Next</a></li>
                    <?php } else { ?>
                        <li class="page-item"><a class="page-link" href="data_pasien.php?cari=<?= $kolomKataKunci ?>&halaman=<?= $linkNext ?>">Next</a></li>
                <?php }
                }
                ?>
            </ul>
        </nav>

    </div>

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