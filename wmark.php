<?php

require_once("vendor/myokyawhtun/pdfmerger/fpdf/fpdf.php");
require_once("vendor/myokyawhtun/pdfmerger/fpdi/fpdi.php");

class WaterMark
{
    public $pdf, $file, $newFile,
        $wmText = "CÓPIA";

    /** $file and $newFile have to include the full path. */
    public function __construct($file, $newFile)
    {
        $this->pdf = new FPDI();
        $this->file = $file;
        $this->newFile = $newFile;
    }

    /** $file and $newFile have to include the full path. */
    public static function applyAndSpit($file, $newFile, $debug = FALSE)
    {
        $wm = new WaterMark($file, $newFile);

        if($wm->isWaterMarked()) {
            if(!$debug) return;
            return $wm->spitWaterMarked();
        }
        else{
            $wm->doWaterMark();
            if(!$debug) return;
            return $wm->spitWaterMarked();
        }
    }

    /** @todo Make the text nicer and add to all pages */
    public function doWaterMark()
    {
        $currentFile = $this->file;
        $newFile = $this->newFile;

        $pagecount = $this->pdf->setSourceFile($currentFile);

        for($i = 1; $i <= $pagecount; $i++){
                            $this->pdf->addPage();
            $tplidx = $this->pdf->importPage($i);
            $this->pdf->useTemplate($tplidx);
            // now write some text above the imported page
            $this->pdf->SetFont('Arial', 'I', 80);
            $this->pdf->SetTextColor(204,204,204);
            $this->pdf->SetXY(140, 70); # 140,140 ou 140,60
            $this->_rotate(55);
            $this->pdf->Write(0, utf8_decode($this->wmText));
                            $this->_rotate(0);
        }

        $this->pdf->Output($newFile, 'F');
    }

    public function isWaterMarked()
    {
        return (file_exists($this->newFile));
    }

    public function spitWaterMarked()
    {
        return readfile($this->newFile);
    }

    protected function _rotate($angle,$x=-1,$y=-1) {

        if($x==-1)
            $x=$this->pdf->x;
            #$x=595;
        if($y==-1)
            $y=$this->pdf->y;
            #$y=842;
        if (isset($this->pdf->angle) || property_exists($this->pdf, 'angle'))
            if($this->pdf->angle!=0)
                $this->pdf->_out('Q');
        $this->pdf->angle=$angle;

        if($angle!=0){
            $angle*=M_PI/180;
            $c=cos($angle);
            $s=sin($angle);
            $cx=$x*$this->pdf->k;
            $cy=($this->pdf->h-$y)*$this->pdf->k;

            $this->pdf->_out(sprintf(
                'q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm',
                $c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
        }
    } 

}

$src = 'data';
$tmp = 'tmp';

$file_a = 'eSocial_Demonstrativo_Recibo_Novembro_2016.pdf';
$file_b = 'eSocial_Demonstrativo_Recibo_Novembro_2016-copia2.pdf';

WaterMark::applyAndSpit($src.'/'.$file_a, $tmp.'/'.$file_b);

if (!copy($src.'/'.$file_a, $tmp.'/'.$file_a)) {
    echo "falha ao copiar $file_a...\n";
}

?>
