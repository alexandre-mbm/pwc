<?php
$filename = __DIR__ . '/out/final.pdf';
if (file_exists($filename)) {
    unlink($filename);
    echo 'Arquivo apagado!';
} else {
    echo 'O arquivo já não existe.';
}
?>
