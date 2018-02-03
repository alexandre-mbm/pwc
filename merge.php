<?php
include 'vendor/myokyawhtun/pdfmerger/PDFMerger.php';

$tmp = 'tmp';
$out = 'out';
$src = 'data';

$indexes = array("", "-1", "-2");

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

foreach ($indexes as $i) {
    temporize("eSocial_Demonstrativo_Recibo$i.pdf");
    temporize("Extra$i.pdf");
}

temporize('ESocial_Relatorio_Consolidado.pdf');
temporize('Auxílio Transporte.pdf');
temporize('Fatura Net.pdf');
temporize('Aviso prévio.pdf');
temporize('Contrato.pdf');
temporize('Aviso de férias.pdf');
temporize('Recibo_Ferias.pdf');
temporize('recibo.pdf');

temporize('CAERN.pdf');
temporize('COSERN.pdf');
temporize('Comprovante.pdf');
temporize('NET.pdf');

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
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'CAERN.png') && !file_exists('CAERN.pdf'))
	    throw new Exception('CAERN.png e CAERN.pdf não existem');
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'relatorio.pdf'))
	    throw new Exception('relatorio.pdf não existe');
    $pdf->addPDF('relatorio.pdf')
        ->addPDF('CAERN.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'COSERN.png') && !file_exists('COSERN.pdf'))
	    throw new Exception('COSERN.png e COSERN.pdf não existem');
    if (!file_exists(__DIR__ . '/' . $src . '/' . '2a Via de Fatura.pdf'))
	    throw new Exception('2a Via de Fatura.pdf não existe');
    $pdf->addPDF('2a Via de Fatura.pdf', '1')
        ->addPDF('COSERN.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

foreach ($indexes as $i) {

    try {
        if (!file_exists(__DIR__ . '/' . $src . '/' . "eSocial_Demonstrativo_Recibo$i.pdf"))
	        throw new Exception("eSocial_Demonstrativo_Recibo$i.pdf não existe");
        $pdf->addPDF("eSocial_Demonstrativo_Recibo$i.pdf", '1')
	    ->addPDF('../blank.pdf')
	    ->addPDF("eSocial_Demonstrativo_Recibo$i.pdf", '2')
	    ->addPDF('../blank.pdf');
    } catch (Exception $e) {
        echo $e->getMessage() . "\n";
    }

    try {
        if (!file_exists(__DIR__ . '/' . $src . '/' . "Extra$i.pdf"))
	        throw new Exception("Extra$i.pdf não existe");
        $pdf->addPDF("Extra$i.pdf")
            ->addPDF('../blank.pdf');
    } catch (Exception $e) {
        echo $e->getMessage() . "\n";
    }

}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'ESocial_Relatorio_Consolidado.pdf'))
	    throw new Exception('ESocial_Relatorio_Consolidado.pdf não existe');
    $pdf->addPDF('ESocial_Relatorio_Consolidado.pdf')
        ->addPDF('../blank.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'Comprovante.png') && !file_exists('Comprovante.pdf'))
	    throw new Exception('Comprovante.png e Comprovante.pdf não existem');
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'GuiaPagamento.PDF'))
	    throw new Exception('GuiaPagamento.PDF não existe');
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
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'NET.png') && !file_exists('NET.pdf'))
	    throw new Exception('NET.png e NET.pdf não existem');
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'Fatura Net.pdf'))
	    throw new Exception('Fatura Net.pdf não existe');
    $pdf->addPDF('Fatura Net.pdf', '1')
        ->addPDF('NET.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'Aviso prévio.pdf'))
	    throw new Exception('Aviso prévio.pdf não existe');
    $pdf->addPDF('Aviso prévio.pdf')
        ->addPDF('../blank.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'Contrato.pdf'))
	    throw new Exception('Contrato.pdf não existe');
    $pdf->addPDF('Contrato.pdf', '1')
        ->addPDF('Contrato.pdf', '2');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'Aviso de férias.pdf'))
	    throw new Exception('Aviso de férias.pdf não existe');
    $pdf->addPDF('Aviso de férias.pdf')
        ->addPDF('../blank.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'Recibo_Ferias.pdf'))
	    throw new Exception('Recibo_Ferias.pdf não existe');
    $pdf->addPDF('Recibo_Ferias.pdf')
        ->addPDF('../blank.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    if (!file_exists(__DIR__ . '/' . $src . '/' . 'recibo.pdf'))
	    throw new Exception('recibo.pdf não existe');
    $pdf->addPDF('recibo.pdf')
        ->addPDF('../blank.pdf');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try {
    $pdf->merge('file', __DIR__ . '/' . $out . '/' . 'final.pdf');
    echo "O documento está pronto!\n";
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

# TODO watemark

chdir('..');

?>
