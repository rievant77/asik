<?php
@require_once 'include/fpdf/fpdf.php';
@require_once 'include/config.php';
@require_once 'include/classes/database.class.php';

$dbclass    		= new database($dbtype, $dbhost, $dbname, $dbuser, $dbpass);
$mysqli     		= new mysqli($dbhost, $dbuser, $dbpass, $dbname);

class PDF extends FPDF
{
//Page header
function Header()
{
	//Logo
	$this->Image('images/logo-MTs.gif',27,8,29);
	//Times bold 18
	$this->SetFont('Times','',18);
	//Move to the right
	$this->Cell(92);
	//Title
	$this->Cell(30,6,'PEMERINTAH KAB. DEMAK',0,1,'C');
	//Times bold 12
	$this->SetFont('Times','',12);
	//Move to the right
	$this->Cell(92);
	$this->Cell(30,4,'Kementrian Agama Kab. Demak',0,1,'C');
	$this->Cell(92);
	$this->Cell(30,4,'MTs Addarain Gemulak Sayung Demak',0,1,'C');
	//Times bold 14
	$this->SetFont('Times','',12);
	//Move to the right
	$this->Cell(92);
	$this->Cell(30,6,'Jl. Onggorawe-Surodadi KM 1,5 Kode Pos 59563',0,1,'C');
	//Times bold 12
	$this->SetFont('Times','',12);
	//Move to the right
	$this->Cell(92);
	$this->Cell(30,4,'www.addarain.sch.id   e-mail : mtsaddarain@gmail.com',0,1,'C');
	//Set Line
    $this->SetLineWidth(0.5);
    //Line
	$this->Line(15,38,195,38);
	//Line break
	$this->Ln(10);
    
}

}
//$NoUjian = "$_POST[kd1]-$_POST[kd2]-$_POST[kd3]-$_POST[kd4]";
$noujian = $_REQUEST[noUjian];
$sql    = "SELECT * FROM tbl_siswa WHERE noujian = '$noujian'";
$query  = $dbclass->query($sql);
$data   = $dbclass->get_row();
$ket    = $data[ket];;
$nama        = $data[name];
$tgllhr        = $data[tgllhr];
$kelas       = $data[kelas];
$noujian     = $data[noujian];
$sekolah = $data[sekolah];
$text = "Kepala MTs Addarain Gemulak Sayung selaku Ketua Penyelenggaran Ujian Nasional/Ujian Sekolah Tahun Pelajaran 2013/2014, berdasarkan Peraturan Menteri Pendidikan dan Kebudayaan No. 97 tahun 2013 tanggal 10 November 2013, Peraturan Badan Standar Nasional Pendidikan (BSNP) Nomor: 0022/P/BSNP/XI/2013 tanggal 30 November 2013 dan Surat Edaran Dinas Pendidikan Kab Demak  tahun 2014 serta hasil Rapat Dinas Kepala Sekolah  dengan Dewan Guru MTs Addarain tanggal 13 Juni 2014 tentang Kelulusan Kelas  IX, maka dengan ini menyatakan bahwa :";
//Instanciation of inherited class
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins(25.4, 25.4, 25.4);
$pdf->SetFont('Times','U',12);
//Move to the right
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"SURAT PEMBERITAHUAN KELULUSAN",0,'C');
$pdf->SetFont('Times','',11);
$pdf->MultiCell(0,5,"Nomor : 421/       /MTS.18/VI/2014",0,'C');
//Line break
$pdf->Ln(5);
$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,5,$text,0,'J');
//Line break
$pdf->Ln(5);
//Move to the right
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"Nama                    : ".$nama,0,'J');
//Move to the right
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"Tanggal lahir        : ".$tgllhr,0,'J');
//Move to the right
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"Kelas                     : XII (Dua Belas)",0,'J');
//Move to the right
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"Nomor Ujian         : ".$noujian,0,'J');
//Move to the right
$pdf->Cell(15.4);
$pdf->MultiCell(0,5,"Asal Sekolah         : ".$sekolah,0,'J');
//Line break
$pdf->Ln(20);
$pdf->Image("images/".$ket.".jpg",80,125,60);
$pdf->MultiCell(0,5,"Dalam menempuh Ujian Nasional/Ujian Sekolah Tahun Pelajaran 2013/2014.",0,'C');
//Line break
$pdf->Ln(5);
$pdf->MultiCell(0,5,"Demikian pemberitahuan ini kami sampaikan agar diketahui dan dimaklumi.",0,'J');
//Line break
$pdf->Ln(5);
//Move to the right
$pdf->Cell(105.4);
$pdf->MultiCell(0,5,"Demak, 14 Juni 2014",0,'J');
$pdf->Cell(105.4);
$pdf->MultiCell(0,5,"Kepala Sekolah,",0,'J');
//Line break
$pdf->Ln(25);
//Move to the right
$pdf->Cell(105.4);
$pdf->MultiCell(0,5,"H. SAKDULLAH.S.Ag.",0,'J');
$pdf->Cell(105.4);
$pdf->MultiCell(0,5,"NIY. 49.001.0710",0,'J');
//Line break
$pdf->Ln(5);
$pdf->MultiCell(0,5,"Catatan :",0,'J');
$pdf->MultiCell(0,5,"- Bagi siswa yang belum mengembalikan buku perpustakaan harap segera dikembalikan.",0,'J');
$pdf->MultiCell(0,5,"- Untuk siswa yang mendapatkan keterangan “PANGGILAN”. Silakan datang kesekolah hubungi panitia.",0,'J');

$pdf->Output();
?>
