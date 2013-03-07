<?php
error_reporting(E_ERROR | E_PARSE);

include("../includes/phpqrcode/qrlib.php");
QRcode::png("http://phpmaster.com","test.png","L",4,4);


$target = mktime(0, 0, 0, 2, 10, 2007) ;

$today = time () ;

$difference =($target-$today) ;

$days =(int) ($difference/86400) ;

print "Our event will occur in $days days";


/*QRcode::png('PHP QR Code :)', 'test.png', 'L', 4, 2);
QRcode::png('PHP QR Code :)');
QRtools::timeBenchmark();
QRtools::buildCache();
$tab = $qr->encode('PHP QR Code :)');
QRspec::debug($tab, true);
$style = array(
    'border' => true,
    'padding' => 4,
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
);
$pdf->write2DBarcode('PHP QR Code :)', 'QR,L', '', '', 30, 30, $style, 'N');
*/
?>
