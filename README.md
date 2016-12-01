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

**Fontes de exemplos**

Deve-se verificar cada licença!

- `rot.php` ‒ [How do I rotate all or specific pages in a PDF using PHP?](http://stackoverflow.com/questions/38111815/how-do-i-rotate-all-or-specific-pages-in-a-pdf-using-php)
- `wmark.php` ‒ [FPDI/FPDF: Watermark and Print Multiple Pages](http://stackoverflow.com/questions/10468478/fpdi-fpdf-watermark-and-print-multiple-pages)

**Notas sobre instalação**

Ajustes possivelmente necessários para tudo funcionar: 

```
php -i |grep php\.ini

$ yaourt -Ss php-gd

exif.so
gd.so

sudo pacman -Ss composer
```

NÃO ESQUECER das dependências avulsas:

```console
$ mkdir zip
$ php dep.php
```

## Uso

Passos para obtenção manual de resultados:

```console
$ mkdir data; cp FILES data/
$ # assumindo nomes configurados
$ # assumindo odt exportado em pdf
$ mkdir tmp

$ php prop.php
$ php wmark.php
$ php rot.php
$ php merge.php
$ php rot.php 14  # assumindo verso da "folha de ponto" na página 14
```

**Fontes de informação**

- [Feriados Municipais de Natal (RN)][feriados]
- [Calendário do Ano 2016][calendário]

[feriados]: http://www.feriadosmunicipais.com.br/rio-grande-do-norte/natal/
[calendário]: http://www.calendario-365.com.br/calend%C3%A1rio-2016.html

