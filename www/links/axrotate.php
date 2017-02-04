<? 
$xhandle = opendir ( "ax" );
while ( $buin = readdir ( $xhandle ) ){
if ($buin == "." || $buin == ".."||$buin == "index.html") {continue;}
if(file_exists("ax/index.html")){ } else {
$clog=fopen("ax/index.html","a");
fwrite($clog,"<a href=..>pfui</a>");
fclose($clog);
}
if(file_exists("files/index.html")) { } else {
$clog=fopen("files/index.html","a");
fwrite($clog,"<a href=..>pfui</a>");
fclose($clog);
}              
if(eregi("---",$buin)){
$tron=explode("---",$buin);
$user=$tron[0];
$pass=$tron[1];
$usr[$user]="$user---$pass";
$nousr=1;
}
if($nousr=="") 
{  } else 
{
shuffle($usr);
foreach($usr as $tpo) {
$tron=explode("---",$tpo);
$user=$tron[0];
$pass=$tron[1];
include("axtest.php");
if($axstatus=="dead")
{ 
if (is_dir ( "ax/$tpo" )){
rmdir ( "ax/$tpo" );
} else {
unlink ( "ax/$tpo" );
}
}      
}   
}
} 
closedir ( $xhandle );	

?>
