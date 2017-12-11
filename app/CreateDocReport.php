<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpWord\PhpWord;

class CreateDocReport extends Model
{
    //

    public function createDoc($idTemp, $idOwner)
    {
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
        $text = "Научный рейтинг";
        $fontStyle = array('name'=>'Arial', 'size'=>14, 'color'=>'000000', 'bold'=>FALSE);
        $parStyle = array('align'=>'both','spaceBefore'=>10);

        $section->addText(htmlspecialchars($text), $fontStyle,$parStyle);

        $styleTable = array('borderSize'=>14, 'borderColor'=>'006699', 'cellMargin'=>10);
        $styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');

        $tableStyle = $word->addTableStyle('cellMarginTop',  $styleTable, $styleFirstRow);
        $table = $section->addTable([$tableStyle]);
        $styleCell = array('valign'=>'center','borderBottomSize'=>6,  'borderTopSize' => 6,
            'borderRightSize' => 6, 'borderLeftSize' => 6);

        $contentsToTemp = new DataInRanking($idTemp);
        $contents = $contentsToTemp->getTypesAtTemp();
        foreach($contents as $row)
        {
            $table->addRow(900);
            $table->addCell(7000, $styleCell)->addText($row->type. $row->type_of_participation, $fontStyle);

        }


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word,'Word2007');
        $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
        $objWriter->save($temp_file);
        // Your browser will name the file "myFile.docx"
        // regardless of what it's named on the server
        header("Content-Disposition: attachment; filename='myFile.docx'");
        readfile($temp_file); // or echo file_get_contents($temp_file);
        unlink($temp_file);  // remove temp file
        // return $word;
    }
}
