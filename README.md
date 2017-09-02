**pwc** é uma biblioteca que seu autor vem utilizando mensalmente como "consolidador de papelada". Boletos e comprovantes são transformados e unidos em documento único para impressão frente-e-verso.

THIS SOFTWARE IS NOT DIRECTLY FUNCTIONAL AND NEED BE ADAPTED OR EVOLVED.

## Requisitos

Plataforma:

- PHP >=5.3.0
- Imagick via `aur/php-imagick`

Composer:

- PDFMerger
  - fpdf ‒ licença [aqui][fpdf-license]
  - fpdi ‒ Apache License v2.0
- TCPDF ‒ LGPLv3

[fpdf-license]: /myokyawhtun/PDFMerger/blob/master/fpdf/license.txt

Packages "zip":

- [tcpdi](https://github.com/pauln/tcpdi) ‒ Apache License v2.0
- [tcpdi_parser](https://github.com/pauln/tcpdi_parser) ‒ LGPLv3
- [FPDF_TPL](https://www.setasign.com/products/fpdi/downloads/#package-10102) ‒ Apache License v2.0

**Fontes de exemplos**

Deve-se verificar cada licença!

- `rot.php` ‒ [How do I rotate all or specific pages in a PDF using PHP?](http://stackoverflow.com/questions/38111815/how-do-i-rotate-all-or-specific-pages-in-a-pdf-using-php)
- `wmark.php` ‒ [FPDI/FPDF: Watermark and Print Multiple Pages](http://stackoverflow.com/questions/10468478/fpdi-fpdf-watermark-and-print-multiple-pages)

## Uso

Passos para obtenção manual de resultados:

```console
$ cp FILES data/
$ # assumindo nomes configurados
$ # assumindo odt exportado em pdf

$ export PHP_INI_SCAN_DIR="$(pwd)"

$ php pro.php
$ php rot.php
$ php merge.php
$ php rot.php 2  # assumindo verso da "folha de ponto" na página 2
```

**Fontes de informação**

- [Portaria Nº 369, de 29 de novembro de 2016][nacional]
- [Diário Oficial do Município, de 2 de janeiro de 2017][municipal]

[nacional]: http://pesquisa.in.gov.br/imprensa/servlet/INPDFViewer?jornal=1&pagina=78&data=30/11/2016&captchafield=firistAccess
[municipal]: http://portal.natal.rn.gov.br/_anexos/publicacao/dom/dom_20170102_57b612fa85cb4d70525ef7a656747a51.pdf

## Dicas de instalação

**Alwaysdata**

```console
$ # ls $(php-config --extension-dir)
$ ad_install_pecl imagick
$ export PHP_INI_SCAN_DIR="$(pwd)"
$ # php --ini
$ composer install
```
