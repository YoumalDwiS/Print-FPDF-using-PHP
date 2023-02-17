<?php
class PDF{
    function export($sql){
    require('fpdf184/fpdf.php');
    require('koneksi.php');
    //tampilan
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetFont('Arial','','14');
    $pdf->Text(70,30,'PRG5_20211_P6_0320210079');
    $pdf->Text(87,36,'Data Vendor Buku');
    $yi = 50;
    $ya = 44;
    $pdf->SetFont('Arial','',9);
    $pdf->SetFillColor(222,222,222);
    $pdf->SetXY(10,$ya);
    $pdf->CELL(6,6,'NO',1,0,'C',1);
    $pdf->CELL(6,6,'ID',1,0,'C',1);
    $pdf->CELL(25,6,'NAMA',1,0,'C',1);
    $pdf->CELL(100,6,'ALAMAT',1,0,'C',1);
    $pdf->CELL(25,6,'NO TELEPON',1,0,'C',1);
    $pdf->CELL(30,6,'EMAIL',1,0,'C',1);
    $ya=$yi+0;
    //ambil data dari database
    $i=1;
    $no=1;
    $max=31;
    $row=6;
    while($data=mysqli_fetch_array($sql))
    {
        $pdf->SetXY(10,$ya);
        $pdf->SetFont('arial','',9);
        $pdf->SetFillColor(255,255,255);
        $pdf->CELL(6,6,$no,1,0,'C',1);
        $pdf->CELL(6,6,$data['id_vendor'],1,0,'L',1);
        $pdf->CELL(25,6,$data['nama_vendor'],1,0,'L',1);
        $pdf->CELL(100,6,$data['alamat_vendor'],1,0,'L',1);
        $pdf->CELL(25,6,$data['telp_vendor'],1,0,'R',1);
        $pdf->CELL(30,6,$data['email_vendor'],1,0,'L',1);
        $ya=$ya+$row;
        $no++;
        $i++;
        //$dm[kode] = $data[kdprog];
    }
    $tgl=date("d M Y");
    $pdf->text(150,$ya+10,"Bogor, ".$tgl);
    $pdf->text(160,$ya+22,"Youmal Dwi Santoso");
    ob_end_clean();
    $pdf->output();
    }
}
?>