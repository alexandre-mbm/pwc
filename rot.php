<?php
  
require_once('vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('vendor/tecnickcom/tcpdf/tcpdi.php');

function rotatePDF($file, $degrees, $page = 'all'){

    $pdf = new TCPDI(); 
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pagecount = $pdf->setSourceFile($file);

    // rotate each page
    if($page=="all"){
        for ($i = 1; $i <= $pagecount; $i++) { 
            $pageformat = array('Rotate'=>$degrees);
            $tpage = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($tpage);
            //$info = $pdf->getPageDimensions();
            $orientation = $size['w'] > $size['h'] ? 'L' : 'P';

            $pdf->AddPage($orientation,$pageformat);
            $pdf->useTemplate($tpage);      
        }
    }else{
        $rotateFlag = 0;
        for ($i = 1; $i <= $pagecount; $i++) { 
            if($page == $i){
                $pageformat = array('Rotate'=>$degrees);
                $tpage = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpage);
                //$info = $pdf->getPageDimensions();
                $orientation = $size['w'] > $size['h'] ? 'L' : 'P';

                $pdf->AddPage($orientation,$pageformat);
                $pdf->useTemplate($tpage);
                $rotateFlag = 1;
            }else{
                if($rotateFlag==1){
                    // page after rotation; restore rotation
                    $rotateFlag = 0;
                    $pageformat = array('Rotate'=>0);

                    $tpage = $pdf->importPage($i);
                    $pdf->AddPage($orientation,$pageformat);
                    $pdf->useTemplate($tpage);
                }else{
                    // pages before rotation and after restoring rotation
                    $tpage = $pdf->importPage($i);
                    $pdf->AddPage();
                    $pdf->useTemplate($tpage);
                }
            }
        }
    }
    $out = realpath($file);

    if(rename($file,"file.bak")){
        $result = $pdf->Output($out, "F"); 
        if($result == "" ){
            echo "ok";
        }
    }else{
        echo "Failed to rename old PDF";
        die;
    }
}

$file = 'fl.pt.dez.pdf';

$src = 'data';
$tmp = 'tmp';
$out = 'out';

if(isset($argv[1])) {

    if(isset($argv[2])) {  # segundo parâmetro sugere inconsistência
        echo "há algo errado com o parâmetro\n";
        die;
    }

    if(ctype_digit($argv[1])) {
        $param = intval($argv[1]);
        rotatePDF($out.'/'.'final.pdf', 180, $param);
    } else {
        echo "parâmetro não é número de página\n";
        die;
    }

} else {

    $newfile = 'toRotate.pdf';

    if (!copy($src.'/'.$file, $tmp.'/'.$newfile)) {
        echo "falha ao copiar $file...\n";
        die;
    }

    #rotatePDF($newfile,90,1);
    #rotatePDF($newfile,-90,2);

    rotatePDF($tmp.'/'.$newfile, 90);
}

?>
