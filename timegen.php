<?php
// Timegen.php
// Genererer en tannlegetime utifra GET data.
session_start();
if(!file_exists('verdana.ttf') || !file_exists('trebucbd.ttf'))
	throw new Exception('Mangler verdana.ttf og/eller trebucbd.ttf');

// teksten
function getimage($name,$nr)
{
global $img,$width,$height;

$type=substr($name,strpos($name,'.')+1);
switch ($type)
{
case 'png': $img[$nr] = imagecreatefrompng($name); break;
case 'gif': $img[$nr] = imagecreatefromgif($name); break;
case 'jpg': $img[$nr] = imagecreatefromjpeg($name); break;
case 'png': $img[$nr] = imagecreatefrompng($name); break;
}
$width[$nr] = imagesx($img[$nr]);
$height[$nr] = imagesy($img[$nr]);
}

if($_GET['dato']){
	$dato = $_GET['dato'];
	$navn = $_GET['navn'];
	$adresse =  $_GET['adresse'];
	$poststed = $_GET['poststed'];
	$utskriftsdato = $_GET['utskriftsdato'];
	$tsted = $_GET['tsted'];
	$tpostboks = $_GET['tpostboks'];
	$tpoststed = $_GET['tpoststed'];
	$tlf = $_GET['tlf'];
	$orgnr = $_GET['orgnr'];
	$firmanavn = $_GET['firmanavn'];
} else {
	$dato = "torsdag 11. september 2007    Kl: 11:42";
	$navn = "Osama bin Laden";
	$adresse =  "Afghanistanveien 6";
	$poststed = "1337     AFGHANISTAN";
	$utskriftsdato = "9.11.2001";
	$tsted = "Arken Senter";
	$tpostboks = "Postboks 217 Ulset";
	$tpoststed = "5873 BERGEN";
	$tlf = "Tlf: 55 19 40 50";
	$orgnr = "Org Nr.: 987 604 352";
	$firmanavn = "Kjeveortopedene i Arken AS";
}
$multiplier=4.16;
$multiplier=4.1666666666666666666666666666667;
$utskriftsdatosize = 10*$multiplier;
//$utskriftsdatosize=41.6;
//die ($utskriftsdatosize);
$poststedsize = 11*$multiplier;
$adressesize = 10*$multiplier;
$navnsize = 10*$multiplier;
$datosize = 10.5*$multiplier;
$stedsize = 9*$multiplier;


// lag et bilde utfra notextatall.png og sjekk høyde og bredde
 //$im = imagecreatefrompng('notextatall.png');

// $img[1]=imagecreatetruecolor (583*$multiplier,303*$multiplier);
 $img[1]=imagecreatetruecolor (2429,1263);
 getimage ('mntf.gif',2);
 getimage('mntf_scan.png',3);
 
	$black = imagecolorallocate($img[1], 0, 0, 0);
	$white = imagecolorallocate($img[1], 255, 255, 255); 
	imagefill ($img[1],0,0, $white);
 // legg til teksten på bildet
 
 // personen
 imagettftext($img[1], $datosize, 0, 2*$multiplier, 170*$multiplier, $black, "./trebucbd.ttf", $dato); // timedato
 imagettftext($img[1], $navnsize, 0, 391*$multiplier, 139*$multiplier, $black, "./trebucbd.ttf", $navn); // navn
 imagettftext($img[1], $adressesize, 0, 391*$multiplier, 157*$multiplier, $black, "./trebucbd.ttf", $adresse); // adresse
 imagettftext($img[1], $poststedsize, 0, 391*$multiplier, 191*$multiplier, $black, "./trebucbd.ttf", $poststed); // poststed
 imagettftext($img[1], $utskriftsdatosize, 0, 401*$multiplier, 288*$multiplier, $black, "./verdana.ttf", "Utskriftsdato      $utskriftsdato"); //
 
 // tannlegen
 imagettftext($img[1], $stedsize, 0, 87*$multiplier, 13*$multiplier, $black, "./verdana.ttf", $firmanavn); //  //
 imagettftext($img[1], $stedsize, 0, 87*$multiplier, 30*$multiplier, $black, "./verdana.ttf", $tsted); //  
 imagettftext($img[1], $stedsize, 0, 88*$multiplier, 47*$multiplier, $black, "./verdana.ttf", $tpostboks); //  
 imagettftext($img[1], $stedsize, 0, 88*$multiplier, 65*$multiplier, $black, "./verdana.ttf", $tpoststed); //  
 imagettftext($img[1], $stedsize, 0, 87*$multiplier, 83*$multiplier, $black, "./verdana.ttf", $tlf); //  /
 imagettftext($img[1], $stedsize, 0, 87*$multiplier, 100*$multiplier, $black, "./verdana.ttf", $orgnr); //  /
//if ($logo=='notextblå')
imagecopyresized ($img[1], $img[2], 0, 15*$multiplier, 0*$multiplier, 0*$multiplier,$width[2], $height[2], $width[2], $height[2]);
//imagecopy ($img[1],$img[3], 0, 0, 0, 0, $width[3]*$multiplier, $height[3]*$multiplier);
//Den hyggelige meldingen om at nå er det tid for kontroll igjen

imagettftext($img[1], 7.5*$multiplier, 0, 2*$multiplier, 229*$multiplier, $black, "./verdana.ttf", $_SESSION['line1']);
imagettftext($img[1], 7.5*$multiplier, 0, 2*$multiplier, 241*$multiplier, $black, "./verdana.ttf", $_SESSION['line2']);
imagettftext($img[1], 7.5*$multiplier, 0, 2*$multiplier, 253*$multiplier, $black, "./verdana.ttf", $_SESSION['line3']);
imagettftext($img[1], 7.5*$multiplier, 0, 2*$multiplier, 277*$multiplier, $black, "./verdana.ttf", $_SESSION['line4']);

//int imageCopyResized  ( resource dst_im, resource src_im, int dstX, int dstY, int srcX, int srcY, int dstW, int dstH, int srcW, int srcH)
 //arken senter 90, 22
 // postboks 217 ulset 90,41 
 // 5873 bergen 90, 61
 // Tlf: 55 19 40 50 - 90, 79
 // Org Nr.: 987 604 352 - 90,98
 
 // send bildet
header ("Content-type: image/png");
imagepng($img[1]);
 
 // free resources
imagedestroy ($img[1]);
imagedestroy ($img[2]);
imagedestroy ($img[3]);
?>