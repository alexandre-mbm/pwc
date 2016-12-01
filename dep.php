<?php

/*
    https://github.com/pauln/tcpdi
    https://github.com/pauln/tcpdi_parser
    http://www.setasign.com/products/fpdi/downloads/#package-10102
*/

$u_pdi = 'https://github.com/pauln/tcpdi/archive/master.zip';
$u_par = 'https://github.com/pauln/tcpdi_parser/archive/master.zip';
$u_tpl = 'https://www.setasign.com/downloads/63411/FPDF_TPL-1.2.3.zip';

$z_pdi = '/tmp/tcpdi-master.zip';
$z_par = '/tmp/tcpdi_parser-master.zip';
$z_tpl = '/tmp/FPDF_TPL-1.2.3.zip';

$f_pdi = 'tcpdi.php';  # Apache License v2.0
$f_par = 'tcpdi_parser.php';  # LGPLv3
$f_tpl = 'fpdf_tpl.php';  # MIT

file_put_contents($z_pdi, fopen($u_pdi, 'r'));
file_put_contents($z_par, fopen($u_par, 'r'));
file_put_contents($z_tpl, fopen($u_tpl, 'r'));

function endsWith($haystack, $needle)
# http://stackoverflow.com/a/834355/3391915
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function collapseZip($path) {
    $zip = new ZipArchive;
    if ($zip->open($path) === true) {
        for($i = 0; $i < $zip->numFiles; $i++) {
            $filename = $zip->getNameIndex($i);
            $fileinfo = pathinfo($filename);
            if(endsWith($filename, '.php')) {
                $source = "zip://".$path."#".$filename;
                copy($source, "zip/".$fileinfo['basename']);
            }
        }                  
        $zip->close();                  
    }
}

collapseZip($z_pdi);
collapseZip($z_par);
collapseZip($z_tpl);

function bind($file, $dir, $php) {  # exemplo da documentação PHP
    $zip = new ZipArchive;
    $res = $zip->open($file);
    if ($res === TRUE) {
        $zip->extractTo($dir, array($php));
        $zip->close();
        echo "$php OK\n";
    } else {
        echo "$php failed!\n";
    }
}

$dir = 'vendor/tecnickcom/tcpdf';

#bind($z_pdi, $dir, $f_pdi);  # falta subdiretórios do ZIP!
#bind($z_par, $dir, $f_par);
#bind($z_tpl, $dir, $f_tpl);

if (!copy("zip/$f_pdi", "$dir/$f_pdi") ||
    !copy("zip/$f_par", "$dir/$f_par") ||
    !copy("zip/$f_tpl", "$dir/$f_tpl") ) {
    echo "falha ao copiar alguma dependência...\n";
    die;
}

?>
