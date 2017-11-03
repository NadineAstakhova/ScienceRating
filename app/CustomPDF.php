<?php

namespace App;

use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Database\Eloquent\Model;

class CustomPDF extends TCPdf {

    //Page header
    public function Header() {

        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'Something new right here!!!', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    public static function createTable($header){
        $num_headers = count($header);
        // Header
        /*$w = array(95,20, 40, 45);
        for($i = 0; $i < $num_headers; ++$i) {
            self::Cell($w[$i], 10, $header[$i], 1, 0, 'C');
        }
        self::Ln();*/
        $arrTypes = TypeOfRes::getAll();
        self::SetFont('dejavusans','N',10);
      /*  foreach($arrTypes as $row)
        {
            self::Cell($w[0],6,$row,'LR',0,'L');

            self::Ln();
        }*/

        $tbl = <<<EOD
            <table border="1">
            <thead>
EOD;
        $headers = "<tr>";
        for($i = 0; $i < $num_headers; ++$i) {
            $headers .= "<th align=\"center\">".$header[$i]."</th>";
        }
        $t="</tr></thead><tbody>";
        $rows = "";

       foreach($arrTypes as $row)
       {
            $rows .= "<tr><td>". $row ."</td><td>h</td><td>hhh</td></tr>";
       }

        $endTable = <<<EOD
            </tbody>
            </table>
EOD;

        self::writeHTML($tbl.$headers.$t.$rows.$endTable, true, false, false, false, '');



    }
}