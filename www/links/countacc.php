<?php
$xhandle = opendir ( "ax" );
while ($buin = readdir($xhandle )){
if ($buin == "." || $buin == ".." || $buin == "index.html") {continue;}
if(eregi("---",$buin)){
$account=explode("---",$buin);
if (count ( $account ) == 3) {
$index = 'rapid';} else {
$index = 'rapid';
}		
$accounts [$index] [] = array ($user, $pass );
}
}
closedir ( $xhandle );
?>	