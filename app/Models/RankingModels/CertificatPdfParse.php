<?php

namespace App\Models\RankingModels;

use App\Models\UsersOwners;
use Illuminate\Database\Eloquent\Model;
use \Smalot\PdfParser\Parser;

class CertificatPdfParse extends Parser
{
    //

    private $parser;

    private $pdf;
    private $content;

    public function __construct($file, $attributes = [])
    {
        $this->parser = new \Smalot\PdfParser\Parser();
        $this->pdf = $this->parser->parseFile($file);
        try {
            $this->content = $this->pdf->getText();
        }
        catch (\Exception $e) {
            $this->content = '0';
        }
        parent::__construct();
    }

    public function getTypeText(){

        return gettype($this->content);

    }

    public function getContent(){

        return $this->content;
    }

    public function getDetails(){
        $details  = $this->pdf->getDetails();

// Loop over each property to extract values (string or array).
        foreach ($details as $property => $value) {
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            echo $property . ' => ' . $value . "\n";
        }
    }

    public function searchUserAtPdf(){
        $users = UsersOwners::getAllUsersForTable();
        $arrUser = array();
        $i = 0;
        $str =  str_replace(' ', '', $this->content);
        foreach ($users as $user) {
            if ( (strlen($user->surname_ukr) > 0 && strpos($str, $user->surname_ukr))
                    ||
                        (strlen($user->surname_en) > 0 && strpos($str, $user->surname_en))
                    ||
                        strpos($str, $user->surname)
                )
            {
                $arrUser[$i]['surname'] = $user->surname;
                $arrUser[$i]['id'] = $user->idUsers;
                $i++;
            }
        }
        if (count($arrUser) > 0 )
            return $arrUser;
        else
            return 0;
    }

    public function searchDate(){
       if(preg_match_all( '([0-9]{4})',$this->content,  $matches, PREG_PATTERN_ORDER))
            return $matches[0];
       else
           return 0;
    }

    public function searchTitle(){
        $arr = explode("\n", $this->content, -1);
        return $arr[0];
    }

    public function getCountOfPage(){
        try {
            $count = count($this->pdf->getPages());
        } catch (\Exception $e) {
            return 0;
        }
        return $count;
    }
}
