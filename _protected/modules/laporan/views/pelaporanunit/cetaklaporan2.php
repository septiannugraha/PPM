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
$pdf->SetFont('Arial','B',15); 
$pdf->MultiCell(300,18,'DAFTAR KEGIATAN PPM', '', 'C', 0);

$pdf->SetXY(10,17);
$pdf->SetFont('Arial','B',15); 
$pdf->MultiCell(300,18, 'BAGIAN PERENCANAAN DAN PENGEMBANGAN PEGAWAI', '', 'C', 0);

$pdf->SetXY(10,24);
$pdf->SetFont('Arial','B',15); 
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

//$pdf->Cell(40,5,'Data anda disini','',0,'L');

// Tabel

$w = [15,80,48,100,25]; // Tentukan width masing-masing kolom
 
$pdf->SetFont('Arial','B',10);
$pdf->SetXY($left,$pdf->getY());
$pdf->Cell($w['0'],11,'No','LT',0,'C');
$pdf->Cell($w['1'],11,'Materi PPM','LTR',0,'C');
$pdf->Cell($w['2'],11,'Tanggal','LTR',0,'C');
$pdf->Cell($w['3'],11,'Hasil Output yang diharapkan','LTR',0,'C');
$pdf->Cell($w['4'],11,'Jam PPM','LTR',0,'C');

$pdf->ln();

$pdf->SetFont('Arial','B',10);
$pdf->SetXY($left,$pdf->getY());
$pdf->Cell($w['0'],11,' ','LTB',0,'C');
$pdf->Cell($w['1'],11,'  ','LTRB',0,'C');
$pdf->Cell($w['2'],11,'  ','LTRB',0,'C');
$pdf->Cell($w['3'],11,'  ','LTRB',0,'C');
$pdf->Cell($w['4'],11,'  ','LTRB',0,'C');

$pdf->ln();




// Prepare variabel for our loop
$y1 = $pdf->GetY(); // Untuk baris berikutnya
$y2 = $pdf->GetY(); //untuk baris berikutnya
$y3 = $pdf->GetY(); //untuk baris berikutnya
$yst = $pdf->GetY(); //untuk Y pertama sebagai awal rectangle
$x = 15;
$angker = NULL;
$i = 1;

// Here our loop

//foreach($data as $data){


  //  $y = MAX($y1, $y2, $y3);


    //new data

    
    //$angker = $angker+$data['peran']['bobot_kredit'];

    
//    $ysisa = $y;

  //  $i++; //Untuk urutan nomor
    //$pdf->ln();
//}

//Menampilkan jumlah halaman terakhir
$pdf->SetFont('Arial','B',10);
$pdf->setxy($left,$pdf->getY());
$pdf->Cell($w['0'],6,'','LB');
$pdf->Cell($w['1'],6,'','B',0,'C');
$pdf->Cell($w['2'],6,'','B',0,'C');
$pdf->Cell($w['3'],6,'JUMLAH','B',0,'C');
$pdf->Cell($w['4'],6,number_format($angker, 3, ',', '.'),'BR',0,'R');
// $pdf->Cell($w['5'],6,'','BR',0,'C');

$pdf->ln();


$pdf->ln();

// Penandatangan 

// End of your code --------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------------------------

//Untuk mengakhiri dokumen pdf, dan mengirim dokumen ke output
$pdf->Output();
exit;
?>