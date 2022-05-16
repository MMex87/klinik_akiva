<?php
require 'fungsi.php';
require_once("tcpdf/tcpdf.php");

// waktu
date_default_timezone_set('Asia/Jakarta');
$waktu_sekarang = new DateTime();

$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Klinik Akiva');
$pdf->setTitle('Klinik Akiva');
$pdf->setSubject('Data Obat');
$pdf->setKeywords('Data Obat');

$pdf->setFont('times', '', 12, '', true);

$pdf->AddPage('L','A4');

$query = mysqli_query($konek, "SELECT pendaftaran.tindakan, pasien.no_rm, pasien.nama, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, diagnosa.a, pendaftaran.tanggal_daftar, pendaftaran.keterangan
FROM pendaftaran
JOIN pasien on pasien.id_pasien=pendaftaran.id_pasien 
JOIN diagnosa on diagnosa.id_pendaftaran= pendaftaran.id_pendaftaran WHERE month(tanggal_daftar)='$bulan' and year(tanggal_daftar) = '$tahun' GROUP BY pasien.nama");

$html = '<div style="text-align: center;"><h3>Daftar Pasien Per Bulan</h3></div><hr/><br/><br/>';
$html .= '<table border="1" width="100%">
<tr style="color: black; font-family: monospace; font-weight:800;">
<th>#</th>
<th>RM</th>
<th>Nama</th>
<th>Jenis Kelamin</th>
<th>Usia</th>
<th>Alamat</th>
<th>Keterangan</th>
<th>Tindakan</th>
<th>Diagnosa</th>
</tr>';
$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $nama = $row['nama'];
        $isiDiagnosa = '';
        $diagnosa = query("SELECT diagnosa.a
        FROM pendaftaran
        JOIN pasien on pasien.id_pasien=pendaftaran.id_pasien 
        JOIN diagnosa on diagnosa.id_pendaftaran= pendaftaran.id_pendaftaran WHERE pasien.nama = '$nama' AND month(tanggal_daftar)='$bulan' and year(tanggal_daftar) = '$tahun'");
        foreach($diagnosa as $rows){
            $isiDiagnosa = $isiDiagnosa . $rows['a'] .', ';
        }
    $lahir = new DateTime($row['tanggal_lahir']);
    $umur = $waktu_sekarang->diff($lahir);
    $html .= "<tr style='color: black; font-family: monospace; font-weight:400;'>
    <td>" . $no . "</td>
    <td>" . $row['no_rm'] . "</td>
    <td>" . $row['nama'] . "</td>
    <td>" . $row['jenis_kelamin'] . "</td>
    <td>" .
        $umur->y
        . ' Tahun, '
        . $umur->m . ' Bulan ' . "</td>
    <td>" . $row['alamat'] . "</td>
    <td>" . $row['keterangan'] . "</td>
    <td>" . $row['tindakan'] . "</td>
    <td>" . $isiDiagnosa. "</td>
</tr>";
    $no++;
}
$html .= "</html>";

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Laporan_Pasien_'.$bulan.'-'.$tahun.'.pdf', 'I');