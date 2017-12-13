<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpWord\PhpWord;

class CreateDocReport extends Model
{
    //

    public function createDoc($idTemp, $idOwner)
    {
        $owner = UsersOwners::getUserById($idOwner);

        $contentsToTemp = new DataInRanking($idTemp);
        $contents = $contentsToTemp->getTypesAtTemp();
        $title = $contentsToTemp->getTitle();

        $word = new PHPWord();
        $meta = $word->getDocInfo();
        $meta->setCreator('Имя создателя документа');
        $meta->setCompany('Организация');
        $meta->setTitle('Название документа');
        $meta->setDescription('Описание документа');
        $meta->setCategory('Категория документа');
        $meta->setLastModifiedBy('Имя последнего редактора');
        $meta->setCreated( mktime(0, 0, 0, 5, 12, 2011) ); // Дата и время создания документа
        $meta->setModified( time() ); //Дата и время последнего изменения документа
        $meta->setSubject('Тема документа');
        $meta->setKeywords('ключевые, слова, документа');

        $sectionStyle = array(

            'orientation' => 'landscape',
            'marginTop' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(10),
            'marginLeft' => 600,
            'marginRight' => 600,
            'colsNum' => 1,
            'pageNumberingStart' => 1,
            'borderBottomSize'=>100,
            'borderBottomColor'=>'C0C0C0'

        );
        $section = $word->addSection($sectionStyle);
        $text = "";


        if($idTemp == 3)
            $text = "Викладача ".$owner;
        else
            $text = "Студента ".$owner;

        $fontStyle = array('name'=>'Arial', 'size'=>14, 'color'=>'000000', 'bold'=>FALSE);
        $parStyle = array('align'=>'both','spaceBefore'=>10);

        $section->addText(htmlspecialchars($title), $fontStyle,$parStyle);
        $section->addText(htmlspecialchars($text), $fontStyle,$parStyle);

        $styleTable = array('borderSize'=>14, 'borderColor'=>'006699', 'cellMargin'=>10);
        $styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');

        $tableStyle = $word->addTableStyle('cellMarginTop',  $styleTable, $styleFirstRow);
        $table = $section->addTable([$tableStyle]);
        $styleCell = array('valign'=>'center','borderBottomSize'=>6,  'borderTopSize' => 6,
            'borderRightSize' => 6, 'borderLeftSize' => 6);

        $sum = 0;

        $table->addRow(900);
        $table->addCell(7000, $styleCell)->addText("Навчальні та наукові досягнення", $fontStyle);
        $table->addCell(2000, $styleCell)->addText("Код", $fontStyle);
        $table->addCell(2000, $styleCell)->addText("Кількість балів", $fontStyle);

        foreach($contents as $row)
        {
            $mark = UsersOwners::getCountOfUserRes( $idOwner, $row->idType_certificates) * $row->mark;
            $sum += $mark;

            $table->addRow(900);
            $table->addCell(7000, $styleCell)->addText($row->type. $row->type_of_participation, $fontStyle);
            $table->addCell(2000, $styleCell)->addText($row->code, $fontStyle);
            $table->addCell(2000, $styleCell)->addText($mark, $fontStyle);

        }

        $sumText="Сума наукових балiв: $sum";
        $section->addText(htmlspecialchars($sumText), $fontStyle,$parStyle);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word,'Word2007');
        $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
        $objWriter->save($temp_file);
        // Your browser will name the file "myFile.docx"
        // regardless of what it's named on the server
        $fileName = str_replace(' ', '_', $title) . '_' . str_replace(' ', '_', $owner);
        header("Content-Disposition: attachment; filename='$fileName.docx'");
        readfile($temp_file); // or echo file_get_contents($temp_file);
        unlink($temp_file);  // remove temp file
        // return $word;
    }
}
