<?php
Use app\itbz\fpdf\src\fpdf\fpdf;
use yii\db\Expression;


class PDF extends \fpdf\FPDF
{
	function Footer()
	{
		//ambil link
		$link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];		
		// $this->Image("http://api.qrserver.com/v1/create-qr-code/?size=150x150&data=$link", 280, 203 ,5,0,'PNG');		
	    // Go to 1.5 cm from bottom
	    $this->SetY(-15);
	    // Select Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Print centered page number
	    $this->Cell(0,10,'Printed By Simoku | '.$this->PageNo().'/{nb}',0,0,'R');
	}

}

//menugaskan variabel $pdf pada function fpdf().
$pdf = new PDF('L','mm',array(216,330));
$link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

function bulan($bulan){
	Switch ($bulan){
	    case 1 : $bulan="Januari";
	        Break;
	    case 2 : $bulan="Februari";
	        Break;
	    case 3 : $bulan="Maret";
	        Break;
	    case 4 : $bulan="April";
	        Break;
	    case 5 : $bulan="Mei";
	        Break;
	    case 6 : $bulan="Juni";
	        Break;
	    case 7 : $bulan="Juli";
	        Break;
	    case 8 : $bulan="Agustus";
	        Break;
	    case 9 : $bulan="September";
	        Break;
	    case 10 : $bulan="Oktober";
	        Break;
	    case 11 : $bulan="November";
	        Break;
	    case 12 : $bulan="Desember";
	        Break;
	    }
	return $bulan;
}


function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }     
        return $temp;
}
 
 
function terbilang($x, $style) {
    // function ini berfungsi untuk membuat angka terbilang.
    // untuk menggunakan gunakan cara berikut
    // terbilang('your_number', 'style_number')
    // style_number [1=> Untuk huruf terbilang besar seluruhnya, 2 => untuk huruf kecil seluruhnya, 3 => untuk huruf awal besar, 4 => untuk huruf pertama besar]
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}

//cara menambahkan image dalam dokumen. 
//Urutan data-> alamat file-posisi X- posisi Y-ukuran width - ukuran high -  
//menambahkan link bila perlu

//Menambahkan halaman, untuk menambahkan halaman tambahkan command ini. 
//P artinya potrait dan L artinya Landscape
$pdf->AddPage();
$pdf->SetAutoPageBreak(true,10);
$pdf->AliasNbPages();
$left = 25;

// Your Code GOES HERE -----------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------------------------------
$pdf->SetXY(10,10);
$pdf->SetFont('Arial','B',13); 
$pdf->MultiCell(300,18,'DAFTAR KEGIATAN PPM', '', 'C', 0);

$pdf->SetXY(10,17);
$pdf->SetFont('Arial','B',13); 
$pdf->MultiCell(300,18, 'BAGIAN PERENCANAAN DAN PENGEMBANGAN PEGAWAI', '', 'C', 0);

$pdf->SetXY(10,24);
$pdf->SetFont('Arial','B',13); 
$pdf->MultiCell(300,18, 'TRIWULAN I TAHUN 2017', '', 'C', 0);

IF($pdf->GetY() <= 35){
    $y = 35;
}ELSE{
    $y = $pdf->GetY();
}

$pdf->SetFont('Arial','',11);
$pdf->setXY($left, $pdf->getY()+6);
$pdf->Cell(185,6,'Kegiatan yang diikuti:','',0,'L');
$pdf->ln();

// $pdf->Cell(40,5,'Data anda disini','',0,'L');

// Tabel


$w = [10, 68, 33, 70, 19, 66, 19]; // Tentukan width masing-masing kolom
$w1 = [10, 68, 33, 70, 19, 23, 23, 20, 19];
$x = $left;
$y = $pdf->getY();
$x1 =  $x + $w['0'] + $w['1'] + $w['2'] + $w['3'] + $w['4'];

$pdf->SetFont('Arial','B',10);
$pdf->SetXY($x,$y);
$pdf->MultiCell($w['0'],19.5,'No','LT','C');
$xcurrent= $x+$w['0'];
$pdf->SetXY($xcurrent, $y);
$pdf->MultiCell($w['1'],19.5,'Materi PPM','LT','C');
$xcurrent = $xcurrent+$w['1'];
$pdf->SetXY($xcurrent, $y);
$pdf->MultiCell($w['2'],19.5,'Tanggal','LT','C');
$xcurrent = $xcurrent+$w['2'];
$pdf->SetXY($xcurrent, $y);
$pdf->MultiCell($w['3'],19.5,'Hasil Output yang diharapkan','LT','C');
$xcurrent = $xcurrent+$w['3'];
$pdf->SetXY($xcurrent, $y);
$pdf->MultiCell($w['4'],19.5,'Jam PPM','LTR','C');    
$xcurrent = $xcurrent+$w['4'];
$pdf->SetXY($xcurrent, $y);
$pdf->MultiCell($w['5'],6,'Peserta','T','C');
$y1 = $pdf->getY();
$pdf->SetXY($x1, $y1);
$pdf->MultiCell($w1['5'],4.5,'Struktural/ Fungsional Tertentu','LT','C');
$xcurrent1 = $x1+$w1['5'];
$pdf->SetXY($xcurrent1, $y1);
$pdf->MultiCell($w1['6'],6.75,'Fungsional Umum','LT','C');
$xcurrent1 = $xcurrent1+$w1['6'];
$pdf->SetXY($xcurrent1, $y1);
$pdf->MultiCell($w1['7'],13.5,'Jumlah','LT','C');
$xcurrent = $xcurrent+$w['5'];
$pdf->SetXY($xcurrent, $y);
$pdf->MultiCell($w['6'],9.5,'Total Jam PPM','LTR','C');

// Prepare variabel for our loop
$y1 = $pdf->GetY(); // Untuk baris berikutnya
$y2 = $pdf->GetY(); //untuk baris berikutnya
$y3 = $pdf->GetY(); //untuk baris berikutnya
$yst = $pdf->GetY(); //untuk Y pertama sebagai awal rectangle
$x = 15;
$jam = NULL;
$i = 1;

foreach($data as $data){

    $y = MAX($y1, $y2, $y3);

    //new data
    $pdf->SetFont('Arial','',10);    
    $pdf->SetXY($x, $y);
    $xcurrent= $x;
    $pdf->MultiCell($w1['0'],11,$i,'LT','C');
    $xcurrent = $xcurrent+$w1['0'];
    $pdf->SetXY($xcurrent, $y);
    $pdf->MultiCell($w1['1'],11,$data['tentang'],'LTR','L');
    $xcurrent = $xcurrent+$w1['1'];
    $pdf->SetXY($xcurrent, $y);
    $pdf->MultiCell($w1['2'],11,$data['no'],'LTR','L');
    $y1 = $pdf->GetY(); //berikan nilai untuk $y1 titik terbawah Uraian Kegiatan    
    $xcurrent = $xcurrent+$w1['2'];
    $pdf->SetXY($xcurrent, $y);
    $pdf->MultiCell($w1['3'],11,$data['tetap_tanggal'] ,'LTR','C');
    $xcurrent = $xcurrent+$w1['3'];
    $pdf->SetXY($xcurrent, $y);
    $pdf->MultiCell($w1['4'],11,$data['peran']['name'] ,'LTR','C');
    $y2 = $pdf->GetY(); //berikan nilai untuk $y1 titik terbawah Uraian Kegiatan
    $xcurrent = $xcurrent+$w1['4'];
    $pdf->SetXY($xcurrent, $y);

    
    $ysisa = $y;

    $i++; //Untuk urutan nomor
    $pdf->ln();
}


//Menampilkan jumlah halaman terakhir
$jam = (new \yii\db\Query())
->from('ppud')
->count('puud');

$pdf->SetFont('Arial','B',10);
$pdf->setxy($left,$pdf->getY());
$pdf->Cell($w1['0'],6,'','LTB');
$pdf->Cell($w1['1'],6,'','TB',0,'C');
$pdf->Cell($w1['2'],6,'','TB',0,'C');
$pdf->Cell($w1['3'],6,'SUB JUMLAH','TB',0,'C');
$pdf->Cell($w1['4'],6,number_format($jam, 3, ',', '.'),'LTBR',0,'R');
$pdf->Cell($w1['5'],6,number_format($jam/3, 3, ',', '.'),'TBR',0,'C');
$pdf->Cell($w1['6'],6,number_format($jam/3, 3, ',', '.'),'TBR',0,'C');
$pdf->Cell($w1['7'],6,number_format($jam/3, 3, ',', '.'),'TBR',0,'C');  
$pdf->Cell($w1['8'],6,number_format($jam, 3, ',', '.'),'TBR',0,'C');

$pdf->ln();


// Penandatangan 

// End of your code --------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------------------------

//Untuk mengakhiri dokumen pdf, dan mengirim dokumen ke output
$pdf->Output();
exit;
?>