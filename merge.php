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
temporize('GuiaPagamento_14326485515_300620171511472361.PDF');  # EDIT
temporize('eSocial_Demonstrativo_Recibo_Junho-2017.pdf');  # EDIT
#temporize('Auxílio Transporte.odt');  # TODO
temporize('Fatura Net.pdf');

#ESocial_Relatorio_Consolidado_Remuneracoes_Junho-2017.pdf

chdir($tmp);

$pdf = new PDFMerger;

$pdf->addPDF('toRotate.pdf', '1')
    ->addPDF('toRotate.pdf', '2')
	->addPDF('relatorio.pdf')
	->addPDF('CAERN.pdf')
	->addPDF('2a Via de Fatura.pdf', '1')
	->addPDF('COSERN.pdf')
	->addPDF('eSocial_Demonstrativo_Recibo_Junho-2017.pdf', '1')  # EDIT
	->addPDF('../blank.pdf')
	->addPDF('eSocial_Demonstrativo_Recibo_Junho-2017.pdf', '2')  # EDIT
	->addPDF('../blank.pdf')
	->addPDF('GuiaPagamento_14326485515_300620171511472361.PDF')  # EDIT
	->addPDF('comprovante.pdf')
	#->addPDF('Auxílio Transporte.odt')
	#->addPDF('../blank.pdf')
	->addPDF('Fatura Net.pdf', '1')
	->addPDF('NET.pdf')
	->merge('file', __DIR__ . '/' . $out . '/' . 'final.pdf');

# TODO watemark

chdir('..');

?>
