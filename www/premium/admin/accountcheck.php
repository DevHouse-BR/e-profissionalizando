<?php
 	function get_value_from_code( $before, $after, $code)
	{
		$match = '#'.$before.'(.+?)'.$after.'#';
		if( preg_match( $match, $code, $match))
		{
			return $match[1];
		}
		return false;
	}
/**
 * @author Klaas Vanaudenaerde
 * @copyright 2008
 */
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


$check1 = explode('if (1) {',$xxx);
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
	return "incorrect";
	//exit;
}
//die("expired");
$myarr = explode('5 days Traffic:</td><td align=right style="padding-right:20px;"><b>',$xxx);
//$mirrors = get_value_from_code('5 days Traffic:</td><td align=right style="padding-right:20px;"><b>',"$domain",$mirrorlink);

if (isset($myarr[1])) {

$mybw = explode ("</b></td>",$myarr[1]);

$tbw = round(($mybw[0] / 1000),1);
if ($tbw>=50) {
	return "bandwidth";
	//exit;
}

return $tbw;
//exit;

} else {

//$this->disable($cook,'true');
return "unknown";
//exit;
}
}
$today = date('dmy');
$bandw = 0;
$source = mysql_query("SELECT * FROM band WHERE disabled != 'expired' and disabled !='bandwidth' and disabled != 'incorrect'") 
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
mysql_query("update status set bandwidth='$result', type='$type' where AccountID='$premid'");
	 $query="Update band set disabled = '$result' WHERE prem='$cook'"; 
 mysql_query($query) or die (mysql_error());
echo "<br />";
}

?>