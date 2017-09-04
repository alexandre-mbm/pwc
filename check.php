<?php
date_default_timezone_set('America/Fortaleza');
$filename = __DIR__ . '/out/final.pdf';
if (file_exists($filename)) {
    echo "Última geração: " . date ("d/m/Y H:i:s", filemtime($filename));
} else {
    echo "Nenhum arquivo encontrado.";
}
?>
