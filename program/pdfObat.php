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

$query = mysqli_query($konek, "SELECT SUM(penjualan.jumlah) , obat.nama_obat, obat.jenis_obat 
FROM penjualan 
JOIN obat on (obat.id_obat=penjualan.id_obat) 
WHERE month(tanggal_terjual)='$bulan' and year(tanggal_terjual) = '$tahun' 
GROUP BY penjualan.id_obat");

$html = '<div style="text-align: center;"><h3>Laporan Obat</h3></div><hr/><br/><br/>';
$html .= '<table border="1" width="100%">
<tr style="color: black; font-family: monospace; font-weight:800;">
<th>#</th>
<th>Nama Obat & Perlengkapan</th>
<th>Satuan</th>
<th>Pemakaian</th>
</tr>';
$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $html .= "<tr style='color: black; font-family: monospace; font-weight:400;'>
    <td>" . $no . "</td>
    <td>" . $row['nama_obat'] . "</td>
    <td>" . $row['jenis_obat'] . "</td>
    <td>" . $row['SUM(penjualan.jumlah)'] . "</td>
</tr>";
    $no++;
}
$html .= "</html>";

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Laporan_obat_'.$bulan.'-'.$tahun.'.pdf', 'I');
?>

