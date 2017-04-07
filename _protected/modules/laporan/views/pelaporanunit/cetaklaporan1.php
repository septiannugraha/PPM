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
$pdf = new PDF('P','mm',array(216,330));
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
$left = 15;

// Your Code GOES HERE -----------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------------------------------

//cara menambahkan image dalam dokumen. Urutan data-> alamat file-posisi X- posisi Y-ukuran width - ukurang high -  menambahkan link bila perlu
$pdf->Image('logo.png',15,15,40,20,'');

$pdf->SetXY(45,10);
$pdf->SetFont('Arial','B',14); 
$pdf->MultiCell(155,18,'BADAN PENGAWASAN KEUANGAN DAN PEMBANGUNAN', '', 'C', 0);

$pdf->SetXY(45,25);
$pdf->SetFont('Arial','B',15); 
$pdf->MultiCell(155,7,isset(Yii::$app->user->identity->kode_unit) ? ': '.strtoupper($data2->nama_unit) : 'BUKAN USER UNIT', '', 'C', 0);

IF($pdf->GetY() <= 35){
    $y = 35;
}ELSE{
    $y = $pdf->GetY();
}
// $pdf->SetXY(45,$y);
// $pdf->SetFont('Arial','B',10); 
// $pdf->MultiCell(155,4, 'Jl. Pramuka no 33 Jakarta Timur', '', 'C', 0);

IF($pdf->GetY() <= 35){
    $y = 35;
}ELSE{
    $y = $pdf->GetY();
}
$pdf->SetXY(15,$y);
$pdf->SetFont('Arial','B',28); 
$pdf->MultiCell(185,4,'', 'B', 'C', 0);

$pdf->setXY(15, $pdf->getY()+10);
$pdf->SetFont('Arial','BU',11);
$pdf->Cell(185,5,'Penyelenggaraan PPM Periode '.date('d-m-Y', strtotime($getparam['Laporan']['Tgl_1'])).' s.d. '.date('d-m-Y',strtotime($getparam['Laporan']['Tgl_2'])) ,'',0,'C');
$pdf->ln();

//bagian nomor surat
$pdf->SetFont('Arial','',11);
$ykepada = $pdf->getY()+6;
$pdf->SetXY(60,$ykepada);
$pdf->MultiCell(25,6,'Nama', '', 'L', 0);
$pdf->SetXY(80,$ykepada);
$pdf->MultiCell(70,6,': '.$data1['s_nama_lengkap'], '', 'L', 0);
$y = $pdf->GetY();
$pdf->SetXY(60,$y);
$pdf->MultiCell(25,6,'NIP', '', 'L', 0);
$pdf->SetXY(80,$y);
$pdf->MultiCell(70,6,': '.$data1['nipbaru'], '', 'L', 0);
$y = $pdf->GetY();
$pdf->SetXY(60,$y);
$pdf->MultiCell(25,6,'Unit', '', 'L', 0);
$pdf->SetXY(80,$y);
$pdf->MultiCell(80,6,isset(Yii::$app->user->identity->kode_unit) ? ': '.$data2->nama_unit : ': Bukan User Unit', '', 'L', 0);
$y1 = $pdf->GetY();

$pdf->SetFont('Arial','',11);
$pdf->setXY($left, $pdf->getY()+6);
$pdf->Cell(185,6,'Kegiatan yang diikuti:','',0,'L');
$pdf->ln();

// Tabel

$w = [10,67,35,25,25,25]; // Tentukan width masing-masing kolom
 
$pdf->SetFont('Arial','B',10);
$pdf->SetXY($left,$pdf->getY());
$pdf->Cell($w['0'],11,'NO','LT',0,'C');
$pdf->SetFont('Arial','B',9);
$pdf->Cell($w['1'],11,'Uraian Kegiatan','LTR',0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell($w['2'],11,'No Kegiatan','LTR',0,'C');
$pdf->SetFont('Arial','B',9);
$pdf->Cell($w['3'],11,'Tanggal','LTR',0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell($w['4'],11,'Partisipasi','LTR',0,'C');
$pdf->Cell($w['5'],11,'Angka Kredit','LTR',0,'C');
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

foreach($data as $data){


    $y = MAX($y1, $y2, $y3);


    //new data
    $pdf->SetFont('Arial','',10);    
    $pdf->SetXY($x, $y);
    $xcurrent= $x;
    $pdf->MultiCell($w['0'],6,$i,'','C');
    $xcurrent = $xcurrent+$w['0'];
    $pdf->SetXY($xcurrent, $y);
    $pdf->MultiCell($w['1'],6,$data['ppm']['tentang'],'','L');
    $xcurrent = $xcurrent+$w['1'];
    $pdf->SetXY($xcurrent, $y);
    $pdf->MultiCell($w['2'],6,$data['ppm']['no'],'','L');
    $y1 = $pdf->GetY(); //berikan nilai untuk $y1 titik terbawah Uraian Kegiatan    
    $xcurrent = $xcurrent+$w['2'];
    $pdf->SetXY($xcurrent, $y);
    $pdf->MultiCell($w['3'],6,$data['ppm']['tetap_tanggal'] ,'','C');
    $xcurrent = $xcurrent+$w['3'];
    $pdf->SetXY($xcurrent, $y);
    $pdf->MultiCell($w['4'],6,$data['peran']['name'] ,'','C');
    $y2 = $pdf->GetY(); //berikan nilai untuk $y1 titik terbawah Uraian Kegiatan
    $xcurrent = $xcurrent+$w['4'];
    $pdf->SetXY($xcurrent, $y);
    $pdf->MultiCell($w['5'],6,$data['peran']['bobot_kredit'],'','C');
    $y3 = $pdf->GetY(); //berikan nilai untuk $y1 titik terbawah Uraian Kegiatan
    $xcurrent = $xcurrent+$w['5'];
    $pdf->SetXY($xcurrent, $y);

    
    $angker = $angker+$data['peran']['bobot_kredit'];

    
    $ysisa = $y;

    $i++; //Untuk urutan nomor
    $pdf->ln();
}

//membuat kotak di halaman terakhir
$y = MAX($y1, $y2, $y3);
$ylst = $y - $yst;  //$y batas marjin bawah dikurangi dengan y pertama
    $pdf->Rect($x, $yst, $w['0'] ,$ylst);
    $pdf->Rect($x+$w['0'], $yst, $w['1'] ,$ylst);
    $pdf->Rect($x+$w['0']+$w['1'], $yst, $w['2'] ,$ylst);
    $pdf->Rect($x+$w['0']+$w['1']+$w['2'], $yst, $w['3'] ,$ylst);
    $pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3'], $yst, $w['4'] ,$ylst);
    $pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4'], $yst, $w['5'] ,$ylst);
    // $pdf->Rect($x+$w['0']+$w['1']+$w['2']+$w['3']+$w['4']+$w['5'],$yst, $w['6'],$ylst);


//Menampilkan jumlah halaman terakhir
$pdf->SetFont('Arial','B',8);
$pdf->setxy($x,$y);
$pdf->Cell($w['0'],6,'','LB');
$pdf->Cell($w['1'],6,'','B',0,'C');
$pdf->Cell($w['2'],6,'TOTAL','B',0,'C');
$pdf->Cell($w['3'],6,'','B',0,'C');
$pdf->Cell($w['4'],6,'','BLR',0,'R');
$pdf->Cell($w['5'],6,number_format($angker, 3, ',', '.'),'BR',0,'R');
// $pdf->Cell($w['5'],6,'','BR',0,'C');

$pdf->ln();

// Penandatangan 
$y = $pdf->GetY()+8;
$pdf->SetXY(130,$y);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(70,6, $getparam['Laporan']['kota_ttd'].', '.DATE('j', strtotime($getparam['Laporan']['Tgl_Laporan'])).' '.bulan(DATE('m', strtotime($getparam['Laporan']['Tgl_Laporan']))).' '.DATE('Y', strtotime($getparam['Laporan']['Tgl_Laporan'])), '', 'C', 0);

$pdf->SetXY(130,$pdf->GetY());
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(70,6,$getparam['Laporan']['jabatan_ttd'], '', 'C', 0);

$pdf->SetXY(130,$pdf->GetY()+25);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(70,6,$getparam['Laporan']['nama_ttd'], '', 'C', 0);

$pdf->SetXY(130,$pdf->GetY());
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(70,6,'NIP '.$getparam['Laporan']['nip_ttd'], '', 'C', 0);

// End of your code --------------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------------------------------------------

//Untuk mengakhiri dokumen pdf, dan mengirim dokumen ke output
$pdf->Output();
exit;
?>