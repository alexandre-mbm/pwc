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
temporize('GuiaPagamento_14326485515_281120160220407802.pdf');
temporize('rec.vt.dez.pdf');
temporize('Fatura Net.pdf');

chdir($tmp);

$pdf = new PDFMerger;

$pdf->addPDF('relatorio.pdf')
	->addPDF('caern.pdf')
	->addPDF('2a Via de Fatura.pdf', '1')
	->addPDF('cosern.pdf')
	->addPDF('eSocial_Demonstrativo_Recibo_Novembro_2016.pdf', '1')
	->addPDF('../blank.pdf')
	->addPDF('eSocial_Demonstrativo_Recibo_Novembro_2016.pdf', '2')
	->addPDF('../blank.pdf')
	#->addPDF('eSocial_Demonstrativo_Recibo_Novembro_2016-copia.pdf', '1')
	#->addPDF('blank.pdf')
	->addPDF('eSocial_Demonstrativo_Recibo_Novembro_2016-copia2.pdf', '2')
	->addPDF('../blank.pdf')
	->addPDF('GuiaPagamento_14326485515_281120160220407802.pdf')
	->addPDF('Comprovante.pdf')
	->addPDF('toRotate.pdf', '1')
	->addPDF('toRotate.pdf', '2')
	->addPDF('rec.vt.dez.pdf')
	->addPDF('../blank.pdf')
	->addPDF('Fatura Net.pdf', '1')
	->addPDF('NET.pdf')
	->merge('file', '../'.$out.'/'.'final.pdf');

# TODO watemark

chdir('..');

?>
