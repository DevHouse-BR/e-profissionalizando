<?php

/**
 * @author Klaas Vanaudenaerde
 * @copyright 2008
 */
 
 function between($beg, $end, $str) {
$a = explode($beg, $str, 2);
$b = explode($end, $a[1]);
return $beg . $b[0] . $end;
}

	function get_value_from_code( $before, $after, $code)
	{
		$match = '#'.$before.'(.+?)'.$after.'#';
		if( preg_match( $match, $code, $match))
		{
			return $match[1];
		}
		return false;
	}
include "../db.php";
$conn=mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
mysql_select_db(mysql_db) or die("SQL Died");
function get_bw($cook) {


$curl = curl_init();

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

curl_setopt($curl, CURLOPT_HEADER, 1);

//curl_setopt($curl, CURLOPT_POST, false);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_COOKIE, "user=$cook");

curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");

curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);

curl_setopt($curl, CURLOPT_URL, "https://ssl.rapidshare.com/cgi-bin/premiumzone.cgi");

$xxx = curl_exec($curl);


$check1 = explode('if (1)',$xxx);
if (isset($check1[1])) {
return "expired";
//die("expired");
//die($check1[1]);
}
$check2 = explode("Account has been found, but the password is incorrect",$xxx);
if(isset($check2[1])){
	return "incorrect";
	//exit;
}
$check3 = explode("Fraud Detected",$xxx);
if(isset($check3[1])){
	return "fraud";
	//exit;
}
$check3 = explode('Expiration date:</td><td style="padding-right:20px;"><b> ',$xxx);
if (isset($check3[1])) {
$validuntil = substr($check3[1],0,17);
//die("expired");
//die($check1[1]);
}
$check4 = explode("RapidPoints",$xxx);
if (isset($check4[1])) {
	
$points = get_value_from_code('RapidPoints:</td><td style="padding-right:20px;"><b>','</b></td>', $xxx);

}
//die("expired");
$myarr = explode('5 days Traffic:</td><td align=right style="padding-right:20px;"><b>',$xxx);

if (isset($myarr[1])) {

$mybw = explode ("</b>.</p>",$myarr[1]);

$tbw = round(($mybw[0] / 1000),1);
if ($tbw>=50) {
	return "bandwidth ($validuntil) - $points";
	//exit;
}

return "$tbw ($validuntil) - $points";
//exit;

} else {

//$this->disable($cook,'true');
return "unknown";
//exit;
}
}
$today = date('dmy');
$bandw = 0;
$source = mysql_query("SELECT * FROM band") 
or die(mysql_error()); 
$premnum = 0;
$totalbw = 0;

while($row = mysql_fetch_array( $source )) {
$premnum++;
$cook = $row['prem'];
$premid = $row['id'];
$type = $row['type'];
$result=get_bw($cook);
echo $cook;
echo "  ";
echo $result;
/*$result = $bandwidth;
if($result == "expired" || $result == "bandwidth" || $result == "unknown" || $result=="incorrect")
{
	$status = 
}
else
{
	$result= "";
	$status = 1;
}*/
/*mysql_query("update status set bandwidth='$result', type='$type' where AccountID='$premid'");
	 $query="Update band set disabled = '$result' WHERE prem='$cook'"; 
 mysql_query($query) or die (mysql_error());*/
echo "<br />";
}

?>