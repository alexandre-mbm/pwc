<?php

function addPNG($name) {

    $pdf = new Imagick();
    $pdf->setFormat('pdf');

    $img = new imagick();
    $img->readImage($name.'.png');

    $w = 595;
    $h = 842;
    $x = ($w-$img->getImageWidth())/2;
    $y = ($h-$img->getImageHeight())/2;
    $img->setImagePage($w, $h, $x, $y);

    $img->setImageFormat('png');
    $img->setImageCompressionQuality(100);

    $pdf->addImage($img);

    if (!$pdf->writeImages($name.'.pdf', true)) {
        die('Could not write!');
    }

}

addPNG('caern');
addPNG('cosern');
addPNG('Comprovante');
addPNG('NET');

?>
