<?php

namespace pwc\Installer;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class PostPackage
{
    public static function when_tcpdi_parser(PackageEvent $event)
    {
        $installedPackage = $event->getOperation()->getPackage()->getName();
        if($installedPackage == 'pauln/tcpdi_parser')
            PostPackage::try_copy(
                'vendor/pauln/tcpdi_parser/tcpdi_parser.php',
                'vendor/tecnickcom/tcpdf/tcpdi_parser.php'
            );
    }
    public static function when_fpdf_tpl(PackageEvent $event)
    {
        $installedPackage = $event->getOperation()->getPackage()->getName();
        if($installedPackage == 'fpdf/tpl')
            PostPackage::try_copy(
                'vendor/fpdf/tpl/fpdf_tpl.php',
                'vendor/tecnickcom/tcpdf/fpdf_tpl.php'
            );
    }
    public static function when_tcpdi(PackageEvent $event)
    {
        $installedPackage = $event->getOperation()->getPackage()->getName();
        if($installedPackage == 'pauln/tcpdi')
            PostPackage::try_copy(
                'vendor/pauln/tcpdi/tcpdi.php',
                'vendor/tecnickcom/tcpdf/tcpdi.php'
            );
    }
    public static function try_copy($src, $dst)
    {
        $filename = substr($src, strrpos($src, '/') + 1);
        if(!copy($src,$dst))
            echo "falhou para instalar $filename\n";
        else
            echo "$filename instalado!\n";
    }
}
