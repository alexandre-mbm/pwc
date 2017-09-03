<?php

$src = 'data';
$tmp = 'tmp';

function addPNG($name) {

    try{

        global $src, $tmp;

        $pdf = new Imagick();
        $pdf->setFormat('pdf');

        $img = new imagick();
        $img->readImage($src.'/'.$name.'.png');

        $w = 595;
        $h = 842;
        $x = ($w-$img->getImageWidth())/2;
        $y = ($h-$img->getImageHeight())/2;
        $img->setImagePage($w, $h, $x, $y);

        $img->setImageFormat('png');
        $img->setImageCompressionQuality(100);

        $pdf->addImage($img);

        if (!$pdf->writeImages($tmp.'/'.$name.'.pdf', true)) {
            die('Could not write!');
        }

    } catch (ImagickException $e) {
        #echo $e->getMessage() . "\n";
    }

}

addPNG('CAERN');
addPNG('COSERN');
addPNG('Comprovante');
addPNG('NET');

?>
