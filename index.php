<?php
session_start();

function formdata($field,$default)
{
if(!$_POST[$field])
echo $default;
else
echo $_POST[$field];
}
function formfield($field,$default)
{
if(!$_POST[$field])
$value=$default;
else
{
$value=$_POST[$field];
$_SESSION[$field]=$_POST[$field];
}
echo '<input name="'.$field.'" type="text" id="'.$field.'" value="'.$value.'" />';
}
setlocale(LC_CTYPE,'no_NO');
$con = mysql_connect("pokemontrade5.mysql.domeneshop.no","pokemontrade5","QWqd4HVm") or die('Could not connect: ' . mysql_error());
$db=mysql_select_db('pokemontrade5', $con) or die('Could not select db: ' . mysql_error());



function orgnrformat($nr)
{
return $nr;
}

	 include "cfunctions.php";
	 $today = no_day().date(" j. ").no_month().' '.date("Y").' kl '.date("G:i");
	ob_start();
	$dato = $_POST['dato'];
	$navn = $_POST['navn'];
	$adresse =  $_POST['adresse'];
	$postnr = $_POST['postnr'];
	$utskriftsdato = $_POST['utskriftsdato'];
	$tsted = $_POST['tsted'];
	$tpostboks = $_POST['tpostboks'];
	$tpoststed = $_POST['tpoststed'];
	$tlf = $_POST['tlf'];
	$orgnr = $_POST['orgnr'];
	$firmanavn = $_POST['firmanavn'];
	
	$menu ='<a href="#topp">Innledning</a> | <a href="#generator">Generator</a> | <a href="#utskrift">Utskrift</a>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tannlegetimegenerator</title>

<link rel="stylesheet" type="text/css" href="timegen.css" />
</head>
<body>



  <div id="container" class="center">
    <hr  />
    <a name="topp"></a>
    <div class="area">
      <?php echo $menu; ?>
      <h1><a href="?">Tannlegetimegenerator</a></h1>
      <p><br />
        Denne siden genererer inkallinger til tannlegetimer.</p>
      <p>For at denne skal se riktig ut p&aring; et ark, m&aring; den gj&oslash;res om til 583x303 piksler ved 300 DPI.</p>

    </div>
    <hr />
    <a name="generator"></a>
    <div class="area">
      <?php echo $menu;?>
      <p>Bytt ut teksten her. Husk å beholde mellomrommene etter postnummer og dato.</p>
	  <p>Du kan tilbakestille skjemaet til slik det var <a href="?#generator">her</a></p>
      <form method="post" action="#generator">
        <table width="100%">
		<tr><td class="formheader" colspan="2">Info om deg</td></tr>
          <tr>
            <td>Navn:</td>
            <td><?php formfield('navn','Osama bin Laden'); ?></td>
		</tr>
          <tr>
            <td>Postnr:</td>
            <td><?php formfield('postnr','1337'); ?></td>
          </tr>
          <tr>
            <td>Adresse:</td>
            <td><?php formfield('adresse',"Afghanistanveien 6") ?></td>
          </tr>
          <tr>
            <td>Dato:</td>
            <td><?php formfield('dato',$today); ?></td>
          </tr>
          <tr>
            <td>Utskriftsdato:</td>
            <td><?php formfield('utskriftsdato',"9.11.2001"); ?>            </td>
          </tr>
		  <tr><td class="formheader" colspan="2">Info om tannlegen</td></tr>
		  <tr>
            <td>Sted:</td>
            <td><?php formfield('tsted',"Arken Senter"); ?></td>
          </tr>
		  <tr>
            <td>Postboks:</td>
            <td><?php formfield('tpostboks',"Postboks 217 Ulset"); ?></td>
          </tr>
		  <tr>
            <td>Postadresse:</td>
            <td><?php formfield('tpoststed',"5873 BERGEN"); ?></td>
          </tr>
		  <tr>
            <td>Tlf. nummer:</td>
            <td><?php formfield('tlf',"Tlf: 55 19 40 50"); ?></td>
          </tr>
		  <tr>
            <td>Organisasjonsnummer:</td>
            <td><?php formfield('orgnr',"Org Nr.: 987 604 352"); ?></td>
          </tr>
		  <tr>
            <td>Firmanavn:</td>
            <td><?php formfield('firmanavn',"Kjeveortopedene i Arken AS"); ?></td>
          </tr>
		  <tr>
		    <td colspan="2" class="formheader">Tekst under dato  </td>
	      </tr>
		  <tr>
		    <td>Linje 1:</td>
		    <td><?php formfield('line1','Nå er det tid for kontroll igjen.'); ?></td>
	      </tr>
		  <tr>
		    <td>Linje 2: </td>
		    <td><?php formfield('line2','Vennligst ikke glem timen. Avbestilling av time må skje senest 24 timer før'); ?></td>
	      </tr>
		  <tr>
		    <td>Linje 3:</td>
		    <td><?php formfield('line3','avtale. Ikke avbestilt time må betales.'); ?></td>
	      </tr>
		  <tr>
		    <td>Linje 4: </td>
		    <td><?php formfield('line4','Velkommen'); ?></td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
	      </tr>
          <tr>
            <td colspan="2"><input type="submit" name="submit" value="Lag en time" />            </td>
          </tr>
        </table>
      </form>
      <hr />
      <h3>Eksempel:</h3>
      <?php if($_POST['dato']) {
	  $result=mysql_query('SELECT * FROM postnr WHERE postnr=\''.$postnr.'\'') or die (mysql_error());
	  if (!$result)
	 	die('Postnummeret eksisterer ikke');
	  $row=mysql_fetch_array($result);
	  $sted=$row['sted'];
	  $sted=substr($sted,0,1).strtolower(substr($sted,1));
	  $poststed=$postnr.'     '.$sted;
	  $orgnr='Org Nr.: '.orgnrformat($orgnr);
	  //die($poststed);
	  $genlink="timegen.png?dato=$dato&amp;navn=$navn&amp;adresse=$adresse&amp;poststed=$poststed&amp;utskriftsdato=$utskriftsdato&amp;tsted=$tsted&amp;tpostboks=$tpostboks&amp;tpoststed=$tpoststed&amp;tlf=$tlf&amp;orgnr=$orgnr&amp;firmanavn=$firmanavn";
	echo '<a href="'.$genlink.'"><img id="gen" width="582,96" height="303,60" src="'.$genlink.'" alt="Generert bilde" /></a>';

	
 } else
      echo '<img id="gen" src="timegen.php" width="582,96" height="303,60" alt="Eksempelbilde" />';
	   ?>
    </div>
    <hr />
    <a name="utskrift"></a>
    
	<div class="area">
	<?php echo $menu; /*print_r($_POST);*/?>
	<h3>Utskrift <img src="images/printer.png"  alt="printer"/></h3>
      <p>De som er merket med <img src="images/k.png" alt="ok" />, er testet og fungerer.</p>
      <b>Firefox</b>
      <table>
        <tr>
          <td><ol>
              <li>Høyreklikk på bildet og velg "View Image / Vis Bilde".</li>
              <li>Velg "File / Fil" fra menyen opp til venstre.</li>
              <li>Velg "Print / Skriv ut".</li>
              <li>Gå på "Preferences / Egenskaper" på printeren din og velg "Landscape / Liggende"</li>
              <li>Skriv ut</li>
            </ol></td>
          <td><img src="images/gnome-help.png" alt="help" /> </td>
        </tr>
      </table>
      <b>Internet Explorer <img src="images/k.png" alt="ok"  /></b>
      <ol>
        <li>Høyreklikk på bildet og velg "Print Picture / Skriv Ut Bilde". </li>
        <li>Gå på "Preferences / Egenskaper" på printeren din og velg "Landscape / Liggende"</li>
        <li>Skriv ut</li>
      </ol>
      <b>Word <img src="images/k.png" alt="ok" /></b>
      <ol>
        <li>Høyreklikk på bildet og velg "Copy / Kopier".</li>
        <li>Lim bildet inn i Word</li>
        <li>Endre størrelsen på bildet og/eller margene slik at det blir passe stort. For lite er bedre enn for stort.</li>
        <li>Skriv ut</li>
      </ol>
    </div>
    <hr />
    <a name="standardisering"></a>
    <div class="area">
	  <p><?php echo $menu; ?></p>
	  <p>Opprinnelig laget av <a href="http://freak.no/forum/member.php?u=2847">Ozma</a> (The Freak). Videreutviklet av <a href="http://freak.no/forum/member.php?u=10133">datagutten</a></p>
    </div>
	<!--
	<hr />
	<a name="stats"></a>
    <div class="area">
      <?php
	  echo $menu;
	  ?>
      <h3>Statistikk</h3>
	  <?php
	  //include("stats.php");
	  mysql_close(); ?>
    </div>-->
  </div>
</body>
</html>
