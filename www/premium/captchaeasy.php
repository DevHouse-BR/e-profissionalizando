<?php
// Dit captcha-script bevat 2 scripts. De eerste is "simpel.php" die het plaatje genereert,
// de ander is "posten.php"; het formulier waarin het plaatje wordt opgeroepen.
// Sla ze beiden apart op :-)

// simpel.php
session_start();
// Uitleg en instellen gebruikte variabelen
//
// Welke fonts ga je gebruiken? Let op: je moet de bestandsnaam opgeven, dus niet de fontnaam!
// Op Unix-systemen (BSD, Linux) is dit hoofdlettergevoelig!
$fonts     = array ("arial.ttf");

// Waar staan de fonts? Is dat een centrale font-map? Geef dan het exacte pad op.
// Weet je die niet? Vraag dan je hostingprovider om raad, of zet gewoon de fonts in de map waar ook dit script staat.
// Haal het hekje weg bij de juiste optie
# $fontpad = "";  // De fonts staan in dezelfde map als dit script (simpel.php).
$fontpad = "/fonts/";  // De fonts staan in een centrale font-map.

// Achtergrondplaatje. Ik heb er zes gemaakt, met de namen
// cBackground1.png, cBackground2.png, cBackground3.png, enz.
// Je kunt ze (voorlopig) downloaden vanaf http://freakz.testmaar.nl/backgrounds.zip
//
// De plaatjes moet je plaatsen in de map waar ook dit script (simpel.php) staat.
// De getallen uit de plaatjesnamen (1 tot en met 6) stop ik via de variabele $welke in een rand();
$welke                 = rand (1,6);
$image                 = imagecreatefrompng("cBackground".$welke.".png");

// Hieronder niets meer wijzigen, tenzij je weet wat je doet.
// Helemaal onderaan staat nog wel "post.php", die je dus apart op moet slaan.
function generate_password($length) {
       $ret_val     = '';  
       $charset     = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
       $charset_len = strlen($charset) - 1;
       srand(microtime() * 1000000);
       for ($i=0;$i<$length;$i++)
        $ret_val .= $charset{rand(0, $charset_len)};
        return $ret_val;
}
$white                 = imagecolorallocate($image, 255, 255, 255);
$black                 = imagecolorallocate($image, 0, 0, 0);

for ($q=1; $q < 7; $q++){
   
    $uString[$q]     = generate_password(1);
   
    $text1             = rand(1, 255);       // RGB
    $text2             = rand(0, 255);       // RGB
    $text3             = rand(0, 255);       // RGB
    $text[$q]         = imagecolorallocate($image, $text1, $text2, $text3);
   
    $grootte[$q]     = rand (16,22);          // Welke font-grootte?
    $hoek[$q]         = rand (-25,25);      // Hoe schuin?
   
    $boven1[$q]     = rand (25,35);       // Hoeveel pixels van boven?
    $boven2[$q]     = $boven1[$q] -1;     // Schaduw
    $boven3[$q]     = $boven1[$q] +1;     // Schaduw
   
    $links            = $links + 28;        // Letters zijn nu eenmaal breed...
    $links1[$q]        = $links;              // Hoeveel pixels van links?
    $links2[$q]        = $links1[$q] - 1;    // Schaduw
    $links3[$q]        = $links1[$q] + 1;    // Schaduw
   
    $random_font    = array_rand ($fonts);
   
    imagettftext($image, $grootte[$q], $hoek[$q], $links3[$q], $boven2[$q], $white, $fontpad.$fonts[$random_font], $uString[$q]);
    imagettftext($image, $grootte[$q], $hoek[$q], $links2[$q], $boven3[$q], $black, $fontpad.$fonts[$random_font], $uString[$q]);
    imagettftext($image, $grootte[$q], $hoek[$q], $links1[$q], $boven1[$q], $text[$q], $fontpad.$fonts[$random_font], $uString[$q]);
}

// Zet de automatisch gegenereerd code in een sessie.
$_SESSION['teBewaren'] = $uString[1] . $uString[2] . $uString[3] . $uString[4] . $uString[5] . $uString[6];

// Laat het plaatje zien.
header('Content-type: image/png');
imagepng($image);
?>  