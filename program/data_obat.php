<?php
require 'fungsi.php';

// waktu
date_default_timezone_set('Asia/Jakarta');
$waktu_sekarang = new DateTime();
$nama[] = "";
$jumlah[] = "";

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

  <title> Kilink Akiva</title>
  <link rel="icon" href="../img/Logo Klinik.jpeg">


</head>

<body style="background: #c4b8e7;">
  <nav class=" navbar navbar-expand-lg ps-4 pe-4" style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
    <div class="container-fluid">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
        <li class="nav-item me-5 btn" style="background-color: #61529A; border-radius: 3px; width: 150px; text-align: center;">
          <a href="obat.php" class="nav-link " aria-current="page" style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">BACK</a>
        </li>
      </ul>
    </div>
    <a href="#" class=""><img src="../img/Logo Klinik.png" width="100" height="100" style="margin-right: 20px" /></a>
  </nav>
  <div class="card mt-3 ms-3 me-3">
    <div class="card-header text-dark" style="background-color: #A595D6;">
      <h1 style="color: #ffffff; font-family:  'Roboto Mono', monospace; text-align: center; ">DATA OBAT</h1>

      <form action="" method="get" class="cari" style="float:right">
        <input type="text" placeholder="cari data.." id="cari" name="cari" autofocus autocomplete="off" value="<?php if (isset($_GET['cari'])) echo $_GET['cari']; ?>">
        <button class="button" type="submit" id="cari" style="color: #ffffff; background-color: #2A87FF; border-radius: 3px; border: 1px solid #A595D6;">Cari <img src="../img/cari.png" width="20px" height="20px" class="ms-1 mb-1"></button>
      </form>
    </div>

    <br />
    <?php
    $tanggal = query("SELECT * FROM obat");
    $i = 0;
    foreach ($tanggal as $rows) {
      $lahir = new DateTime($rows['expired_date']);
      $exp = $waktu_sekarang->diff($lahir);
      $bulan[$i] = $exp->m;
      $hari[$i] = $exp->d;
      $nama_obat[$i] = $rows['nama_obat'];
      $i++;
    }
    $data = query("SELECT * FROM obat WHERE jumlah_obat < '50'");
    $loop = 0;
    foreach ($data as $row) {
      $nama[$loop] = $row['nama_obat'];
      $jumlah[$loop] = $row['jumlah_obat'];
      $loop++;
    }
    if ($nama || $jumlah) {
      $nomor = 0;
      while ($nomor < count($data)) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
          <strong>Perhatian!</strong> Stok <?= $nama[$nomor]; ?> Tersisa <?= $jumlah[$nomor]; ?>
        </div>
        <?php
        $nomor++;
      }
    }

    if ($bulan || $hari) {
      $b = 0;
      while ($b < count($tanggal)) {
        if ($bulan[$b] < 5) {
        ?>
          <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
            <strong>Perhatian!</strong> Tanggal Kadaluarsa <?= $nama_obat[$b]; ?> Tersisa <?= $bulan[$b]; ?> bulan dan <?= $hari[$b] ?> hari
          </div>
    <?php
        }
        $b++;
      }
    }
    ?>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr style="color: black; font-family:  'Roboto Mono', monospace; font-weight:800;">
            <th scope="col">#</th>
            <th scope="col">Nama Obat</th>
            <th scope="col">Jenis</th>
            <th scope="col">Jumlah Obat</th>
            <th scope="col">Expired Date</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php

          // jumlah data per halamn

          $jumlahDataPerHalaman = 10;
          // Pagination 

          $halamanAktif = (isset($_GET['halaman'])) ? (int) $_GET['halaman'] : 1;
          // awal data
          $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

          $kolomKataKunci = (isset($_GET['cari'])) ? $_GET['cari'] : "";


          // kondisi jika parameter pencarian kosong
          if ($kolomKataKunci == "") {
            // ambil data dari table pasien
            $obat = query("SELECT * FROM obat ORDER BY id_obat DESC LIMIT " . $awalData . "," . $jumlahDataPerHalaman . "");
          } else {
            // kondisi jika parameter pencarian diisi
            $obat = cariObat($kolomKataKunci, $awalData, $jumlahDataPerHalaman);
          }


          // kode lama

          if ($obat) {
            $urut = 1;
            foreach ($obat as $data) {
              $id          = $data['id_obat'];
              $nama        = $data['nama_obat'];
              $jumlah      = $data['jumlah_obat'];
              $jenis       = $data['jenis_obat'];
              $exp         = $data['expired_date'];

          ?>
              <tr class="data" style="color: black; font-family:  'Roboto Mono', monospace; font-weight:400;">
                <th scope="row"><?php echo $urut++ ?></th>
                <td scope="row"><?php echo $nama ?></td>
                <td scope="row"><?php echo $jenis ?></td>
                <td scope="row"><?php echo $jumlah ?></td>
                <td scope="row" style="color: red;"><?php echo $exp ?></td>
                <td scope="row">
                  <a href="obat.php?tindakan=edit&id=<?php echo $id ?>"><button type="button" class="tombol btn-warning mb-1 ">Edit</button></a>
                  <a href="obat.php?tindakan=delete&id=<?php echo $id ?>" onclick="return confirm('Hapus Data?')"><button type="button" class="tombol btn-danger mb-1">Delete</button></a>
                </td>
              </tr>
          <?php }
          } else {
            echo  ' <tr> <td > Data Tidak Ditemukan </td> </tr>';
          } ?>
        </tbody>
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
            <li class="page-item"><a class="page-link" href="data_obat.php?halaman=<?= $linkPrev ?>" class="page-link">Previous</a></li>
          <?php } else { ?>
            <li class="page-item"><a class="page-link" href="data_obat.php?cari=<?= $kolomKataKunci ?>&halaman=<?= $linkPrev ?>">Previous</a></li>
        <?php }
        }
        ?>
        <!-- Halaman -->
        <?php
        // kondisi jika parameter pencarian kosong
        if ($kolomKataKunci == "") {
          // ambil data dari table pasien
          $obat = query("SELECT * FROM obat ORDER BY id_obat DESC");
        } else {
          // kondisi jika parameter pencarian diisi
          $obat = cariObatTanpaLimit($kolomKataKunci);
        }
        $jumlahData = count($obat);
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
            <li <?= $linkActive ?>><a class="page-link" href="data_obat.php?halaman=<?= $i ?>"><?= $i ?></a></li>
          <?php } else { ?>
            <li <?= $linkActive ?>><a class="page-link" href="data_obat.php?cari=<?= $kolomKataKunci ?>&halaman=<?= $i ?>"><?= $i ?></a></li>
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
            <li class="page-item"><a class="page-link" href="data_obat.php?halaman=<?= $linkNext ?>">Next</a></li>
          <?php } else { ?>
            <li class="page-item"><a class="page-link" href="data_obat.php?cari=<?= $kolomKataKunci ?>&halaman=<?= $linkNext ?>">Next</a></li>
        <?php }
        }
        ?>
      </ul>
    </nav>

  </div>

  <!-- script JS Pendaftaran -->
  <script></script>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>