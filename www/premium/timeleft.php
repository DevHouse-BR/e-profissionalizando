<?php 
$Timeleft=date( '00:00:00', time( ) ); 
$mTimeleft = mktime(1, 0, 0, date("m"), date("d"), date("Y"));



$timestampFromSql = strtotime($Timeleft); 
$now = time(); 
$mnow = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));

$verschil = $mnow - $mTimeleft;
$aantal = $verschil / 600;
$aantal = floor($aantal);
$aantalfinal = $aantal * 600;

  $timeleft = date('H:i:s', ((($aantalfinal - $mnow)+600)-43200-3600)); 

?> 