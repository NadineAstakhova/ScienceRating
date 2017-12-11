<?php

namespace App;

use Anouar\Fpdf\Fpdf;
use Illuminate\Database\Eloquent\Model;
use Elibyy\TCPDF\Facades\TCPDF;
use PDF;

class CreatePdfReport extends Model
{
    //

   /* public function createPdf($f_name, $l_name, $email, $gender){

        $fpdf = new FPDF();

        $fpdf->AddPage();
        $fpdf->SetFont('dejavusans','B',16);
        $str = utf8_decode('Научный');

        $fpdf->Cell(40,10,$str);


        $fpdf->Cell(0,10,"Create Dynamic PDF using PHP and FPDF Library",1,1,"C");
        $fpdf->Cell(95,10,"First Name:",1,0,"C");
        $fpdf->Cell(95,10,$f_name,1,1,"C");
        $fpdf->Cell(95,10,"Last Name:",1,0,"C");
        $fpdf->Cell(95,10,$l_name,1,1,"C");
        $fpdf->Cell(95,10,"Email:",1,0,"C");
        $fpdf->Cell(95,10,$email,1,1,"C");
        $fpdf->Cell(95,10,"Gender:",1,0,"C");
        $fpdf->Cell(95,10,$gender,1,1,"C");
        $fpdf->Output();
    }*/

    /**
     *
     */
    public function createPdf($idTemp, $idOwner)
    {
        $header = array("Навчальні та наукові досягнення", "Код", "Кількість балів");
        $owner = UsersOwners::getUserById($idOwner);
        //get types at template ranking
        $contentsToTemp = new DataInRanking($idTemp);
        $title = $contentsToTemp->getTitle();

        CustomPDF::SetTitle($title);
        CustomPDF::SetSubject('Report of System');
        CustomPDF::SetMargins(7, 18, 7);
        CustomPDF::SetFont('dejavusans','B',16);
        CustomPDF::SetFontSubsetting(false);
        CustomPDF::SetFontSize('10px');
        CustomPDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        CustomPDF::AddPage('L', 'A4');
        CustomPDF::createStartAsp($title, $owner, $idTemp);
        CustomPDF::createTable($header, $contentsToTemp->getTypesAtTemp(), $idOwner);
        CustomPDF::lastPage();
        CustomPDF::Output();
    }
}

