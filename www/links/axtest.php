<?
$x=file("http://$user:$pass@rs19.rapidshare.com/files/43108885/dl/y0.txt");
if(eregi("y0",$x[0])) { $axstatus="ok"; }else{ $axstatus="dead"; }
?>
