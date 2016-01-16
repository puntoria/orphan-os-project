<?php namespace App\Library\PDF;

require_once 'tcpdf.php';

/**
* PDF
*/
class PDF extends \TCPDF
{
    public static $document = [
    'width' => 210,
    'height' => 345,
    ];

    public static function report($orphan)
    {
        $pdf = self::create();

        $pdf->AddPage();
        $html = view('layouts.pdf.orphan', compact('orphan'))->render();
        $pdf->WriteHTML($html, true, false, true, true, 'C');

        return $pdf;
    }

    public static function finances($orphan, $year)
    {
        self::$document['height'] = 270;

        $pdf = self::create();

        $pdf->AddPage();
        $html = view('layouts.pdf.finances', compact('orphan'))->render();
        $pdf->WriteHTML($html, true, false, true, true, 'C');

        return $pdf;
    }

    public static function create() 
    {
        $pdf = new self(PDF_PAGE_ORIENTATION, PDF_UNIT, 
            [self::$document['width'], self::$document['height']], true, 'UTF-8', false);

        $pdf->SetAuthor('Patient Help Fund');
        $pdf->SetTitle('Orphan Report');
        $pdf->SetSubject('Orphan PDF Document');
        $pdf->SetKeywords('Patient Help Fund');

        $pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->setLanguageArray([
            'w_page'          => 'page',
            'a_meta_dir'      => 'rtl',
            'a_meta_charset'  => 'UTF-8',
            'a_meta_language' => 'fa'
            ]);

        $pdf->SetFont('aefurat', '', 12);

        return $pdf;
    }

    public function header() {

        $this->setRTL(true);
        $this->Rect(0, 0, self::$document['width'], self::$document['height'], 'F', '', [249,238,208]);

        $this->Image(asset('img/pdf/top-left.jpg'), 
            24, 0, 24, 32, 'JPEG', '', 'T', false, 100, '', false, false, 0, false, false, false);

        $this->Image(asset('img/pdf/top-right.jpg'), 
            self::$document['width'], 0, 24, 32, 'JPEG', '', 'T', false, 100, '', false, false, 0, false, false, false);
        
        $this->Image(asset('img/pdf/header.jpg'), 
            195, 15, 180, 36, 'JPEG', '', 'T', false, 100, '', false, false, 0, false, false, false);
    }

    public function footer() {
        $this->Image(asset('/img/pdf/bottom-left.jpg'), 
            24, self::$document['height'] - 32, 24, 32, 'JPEG', '', 'T', false, 100, '', false, false, 0, false, false, false);

        $this->Image(asset('/img/pdf/bottom-right.jpg'), 
            self::$document['width'], self::$document['height'] - 32, 24, 32, 'JPEG', '', 'T', false, 100, '', false, false, 0, false, false, false);

        //$this->Image(asset('/img/logo.png'), 
          //  58, self::$document['height'] - 23, 32, 8, 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);
    }
}