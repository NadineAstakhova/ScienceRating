<?php

namespace App;

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
        $this->pdf    = $this->parser->parseFile($file);
        $this->content =  $this->pdf->getText();

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
}
