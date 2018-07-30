<?php

namespace App\Models\ReportModels;

use App\Models\UsersOwners;
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

    public static function createStartAsp($temp, $owner, $idTemp){
        if($idTemp == 3)
            $html = '<h1>'.$temp.'</h1>Викладача '.$owner.'<br>';
        else
            $html = '<h1>'.$temp.'</h1>Студента '.$owner.'<br>';

        CustomPDF::writeHTML($html, true, false, true, false, '');
    }

    public static function createTable($header, $content, $idOwner){
        $num_headers = count($header);
        // Header
        /*$w = array(95,20, 40, 45);
        for($i = 0; $i < $num_headers; ++$i) {
            self::Cell($w[$i], 10, $header[$i], 1, 0, 'C');
        }
        self::Ln();*/
    //    $arrTypes = TypeOfRes::getAll();
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
        $sum = 0;



       foreach($content as $row)
       {
           //TODO считается не больше одной статьи на год и т.п.
           $mark = 0;
           if(isset($row->idTypeEvents))
               $mark = UsersOwners::getCountOfUserEvent( $idOwner, $row->idTypeEvents) * $row->mark;
           if(isset($row->idTypePub))
               $mark = UsersOwners::getCountOfUserPublication( $idOwner, $row->idTypePub) * $row->mark;
           $sum += $mark;
           $rows .= "<tr>";
           if(isset($row->type_of_res) && strcmp($row->type_of_res, "не обязательно") )
               $rows .= "<td>".$row->type.' - '. $row->type_of_res."</td>";
           else
               $rows .=  "<td>".$row->type."</td>";
           $rows .= "<td> $row->code</td><td> $mark</td></tr>";
       }

        $endTable = <<<EOD
            </tbody>
            </table>
EOD;
       $sumText="<p>Сума наукових балiв: $sum</p>";

        self::writeHTML($tbl.$headers.$t.$rows.$endTable.$sumText, true, false, false, false, '');

    }
}