<?php
include 'vendor/myokyawhtun/pdfmerger/PDFMerger.php';

$tmp = 'tmp';
$out = 'out';
$src = 'data';

function temporize($file) {
    global $src, $tmp;
    if (!copy($src.'/'.$file, $tmp.'/'.$file)) {
        #echo "falha ao copiar $file...\n";
        #die;
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

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'Folha de ponto.pdf'))
	    throw new Exception('Folha de ponto.pdf não existe');
    if (!file_exists('toRotate.pdf'))
	    throw new Exception('toRotate.pdf não foi gerado');
    $pdf->addPDF('toRotate.pdf', '1')
        ->addPDF('toRotate.pdf', '2');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'CAERN.png'))
	    throw new Exception('CAERN.png não existe');
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'relatorio.pdf'))
	    throw new Exception('relatorio.pdf não existe');
    if (!file_exists('CAERN.pdf'))
	    throw new Exception('CAERN.pdf não foi gerado');
    $pdf->addPDF('relatorio.pdf')
        ->addPDF('CAERN.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'COSERN.png'))
	    throw new Exception('COSERN.png não existe');
    if (!file_exists(__DIR__ . '/' . $src . '/' . '2a Via de Fatura.pdf'))
	    throw new Exception('2a Via de Fatura.pdf não existe');
    if (!file_exists('COSERN.pdf'))
	    throw new Exception('COSERN.pdf não foi gerado');
    $pdf->addPDF('2a Via de Fatura.pdf', '1')
        ->addPDF('COSERN.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'eSocial_Demonstrativo_Recibo.pdf'))
	    throw new Exception('eSocial_Demonstrativo_Recibo.pdf não existe');
    $pdf->addPDF('eSocial_Demonstrativo_Recibo.pdf', '1')
        ->addPDF('../blank.pdf')
        ->addPDF('eSocial_Demonstrativo_Recibo.pdf', '2')
        ->addPDF('../blank.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'Comprovante.png'))
	    throw new Exception('Comprovante.png não existe');
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'GuiaPagamento.PDF'))
	    throw new Exception('GuiaPagamento.PDF não existe');
    if (!file_exists('Comprovante.pdf'))
	    throw new Exception('Comprovante.pdf não foi gerado');
    $pdf->addPDF('GuiaPagamento.PDF')
        ->addPDF('Comprovante.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'Auxílio Transporte.pdf'))
	    throw new Exception('Auxílio Transporte.pdf não existe');
    $pdf->addPDF('Auxílio Transporte.pdf')
        ->addPDF('../blank.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'NET.png'))
	    throw new Exception('NET.png não existe');
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'Fatura Net.pdf'))
	    throw new Exception('Fatura Net.pdf não existe');
    if (!file_exists('NET.pdf'))
	    throw new Exception('NET.pdf não foi gerado');
    $pdf->addPDF('Fatura Net.pdf', '1')
        ->addPDF('NET.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    $pdf->merge('file', __DIR__ . '/' . $out . '/' . 'final.pdf');
    echo "\nDone!\n";
} catch (Exception $e) {
    echo "\n" . $e->getMessage() . "\n";
}

# TODO watemark

chdir('..');

?>
