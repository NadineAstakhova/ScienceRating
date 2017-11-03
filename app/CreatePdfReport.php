<?php

namespace App;

use Anouar\Fpdf\Fpdf;
use Illuminate\Database\Eloquent\Model;
use Elibyy\TCPDF\Facades\TCPDF;
use PDF;

class CreatePdfReport extends Model
{
    //

    public function createPdf($f_name, $l_name, $email, $gender){

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
    }

    /**
     *
     */
    public function t($idOwner){

        $html = 'Науковий рейтинг до аспірантури';
        $header = array("Навчальні та наукові досягнення", "Код", "Кількість балів");
        $owner = UsersOwners::getUserById($idOwner);


        CustomPDF::SetTitle('Науковий рейтинг до аспірантури');
        CustomPDF::SetSubject('Report of System');
        CustomPDF::SetMargins(7, 18, 7);
        CustomPDF::SetFont('dejavusans','B',16);
        CustomPDF::SetFontSubsetting(false);
        CustomPDF::SetFontSize('10px');
        CustomPDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        CustomPDF::AddPage('L', 'A4');
        CustomPDF::writeHTML($owner, true, false, true, false, '');
        CustomPDF::createTable($header);
        CustomPDF::lastPage();
        CustomPDF::Output();


    }
}

