<?
$type = $_POST['type'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$user = str_replace("/","",$user);
$pass = str_replace("/","",$pass);
if($user=="")
{ 	
include("donate.html");exit; 
}
if ($type == 'rapid')
{
include("axtest.php");
if($axstatus=="dead"){
include("errdonate.html");exit;}
if ($axstatus=="ok"){
if(is_dir("ax/$user---$pass")) { } else {
mkdir("ax/$user---$pass",0777);
}
include("okdonate.html");exit;
}
}
?>
