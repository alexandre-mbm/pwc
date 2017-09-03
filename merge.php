<?php
include 'vendor/myokyawhtun/pdfmerger/PDFMerger.php';

$tmp = 'tmp';
$out = 'out';
$src = 'data';

function temporize($file) {
    global $src, $tmp;
    if (!copy($src.'/'.$file, $tmp.'/'.$file)) {
        echo "falha ao copiar $file...\n";
        die;
    }
}

temporize('relatorio.pdf');
temporize('2a Via de Fatura.pdf');
temporize('GuiaPagamento.PDF');
temporize('eSocial_Demonstrativo_Recibo.pdf');
temporize('Auxílio Transporte.pdf');
temporize('Fatura Net.pdf');

chdir($tmp);

$pdf = new PDFMerger;

$pdf->addPDF('toRotate.pdf', '1')
    ->addPDF('toRotate.pdf', '2')
	->addPDF('relatorio.pdf')
	->addPDF('CAERN.pdf')
	->addPDF('2a Via de Fatura.pdf', '1')
	->addPDF('COSERN.pdf')
	->addPDF('eSocial_Demonstrativo.pdf', '1')
	->addPDF('../blank.pdf')
	->addPDF('eSocial_Demonstrativo.pdf', '2')
	->addPDF('../blank.pdf')
	->addPDF('GuiaPagamento.PDF')
	->addPDF('Comprovante.pdf')
	->addPDF('Auxílio Transporte.pdf')
	->addPDF('../blank.pdf')
	->addPDF('Fatura Net.pdf', '1')
	->addPDF('NET.pdf')
	->merge('file', __DIR__ . '/' . $out . '/' . 'final.pdf');

# TODO watemark

chdir('..');

?>
