

<?php
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$tx_token = $_GET['tx'];

$auth_token = "your paypal auth token";

$req .= "&tx=$tx_token&at=$auth_token";


// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
// If possible, securely post back to paypal using HTTPS
// Your PHP server will need to be SSL enabled
// $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
// read the body data
$res = '';
$headerdone = false;
while (!feof($fp)) {
$line = fgets ($fp, 1024);
if (strcmp($line, "\r\n") == 0) {
// read the header
$headerdone = true;
}
else if ($headerdone)
{
// header has been read. now read the contents
$res .= $line;
}
}

// parse the data
$lines = explode("\n", $res);
$keyarray = array();
if (strcmp ($lines[0], "SUCCESS") == 0) {
for ($i=1; $i<count($lines);$i++){
list($key,$val) = explode("=", $lines[$i]);
$keyarray[urldecode($key)] = urldecode($val);
}
// check the payment_status is Completed
// check that txn_id has not been previously processed
// check that receiver_email is your Primary PayPal email
// check that payment_amount/payment_currency are correct
// process payment
$firstname = $keyarray['first_name'];
$lastname = $keyarray['last_name'];
$itemname = $keyarray['item_name'];
//$amount = $keyarray['mc_gross'];
$payermail = $keyarray['payer_email'];

echo ("<p><h3>Thank you for your purchase!</h3></p>");

//Code laten genereren    
$code = "";
$codeinput="abcdefghijklmnopqrstuvxyz0123456789";
$aantal=32;
for ($i = 1; $i <= $aantal; $i++) {
$code .= $codeinput[rand(0,strlen($codeinput)-1)];
}
//afsluiten
$transaction = $_GET['tx'];
$status = $_GET['st'];
$amount = $_GET['amt'];
$currency = $_GET['cc'];
//echo "$payment";
//if (strcmp ($res, "VERIFIED") == 0)
//{
if($status == "Completed" && $currency = "EUR")
{
	$source = mysql_query("SELECT * FROM payment WHERE transaction='$transaction' and done = '1'") or die(mysql_error());  
	$num_rows = mysql_num_rows($source);
	if ($num_rows > 0) {
		while($row = mysql_fetch_array( $source )) {
			$pincode = $row['PIN'];
			}
		echo "Sorry, already validated. Your pin code is $pincode";
		}
	else
	{
	mysql_query("INSERT INTO payment (`transaction`, `done`) VALUES ('" . $transaction . "','1');") or die(mysql_error()); 
	if($amount == "1" || $amount == "1.00")
	{
		//Generate a code & insert into DB
		//echo "Your PIN code is: $code";
		mysql_query("update payment set PIN='$code', Valid='$pack1', email='$payermail', type='premium' where transaction='$transaction';")
		or die(mysql_error()); 
		if(!empty($refferedby))
		{
		mysql_query("update users set credits=credits+$refamountpack1 where Id='$refferedby'") or die(mysql_error()); 
		mysql_query("insert into refbuy (`IP`, `transaction`, `refid`, `credits`) VALUES ('" . $usrip . "','" . $transaction . "','" . $refferedby . "','".$pack1."');") or die(mysql_error()); 
		}
		else
		{}
		$sendto=$payermail;
				$mail_subject = "PREMIUM PIN $sitename";
				$mail_text = "Thank you for PREMIUM purchase at $sitename.\r\n".
					"Your PREMIUM pin is: $code \r\n".
					"It contains $pack1 credits! \r\n".
					"In case the pin doesn't work, contact an admin: \r\n \r\n".
					"URL: www.$domain \r\n";
					
				$mail_headers = 'From: noreply@'.$domain.''."\r\n".
				'Reply-To: noreply@'.$domain.''."\r\n".
				'Mime-Version: 1.0'."\r\n". 
				'X-Mailer: PHP/'.phpversion();
			mail($sendto, $mail_subject, $mail_text,$mail_headers);
		echo "<script language=\"JavaScript\">
		<!--
 		window.location=\"http://www.$domain/?page=purchase&pin=$code\";//--></script>";
		//header("location:buy.php?pin=$code");
	}
	if($amount == "3" || $amount == "3.00")
	{
		//Generate a code & insert into DB
		//echo "Your PIN code is: $code";
		mysql_query("update payment set PIN='$code', Valid='$pack2', email='$payermail', type='premium' where transaction='$transaction';")
		or die(mysql_error()); 
		if(!empty($refferedby))
		{
		mysql_query("update users set credits=credits+$refamountpack2 where Id='$refferedby'") or die(mysql_error()); 
		mysql_query("insert into refbuy (`IP`, `transaction`, `refid`, `credits`) VALUES ('" . $usrip . "','" . $transaction . "','" . $refferedby . "','".$pack2."');") or die(mysql_error()); 
		}
		else
		{}
				$sendto=$payermail;
				$mail_subject = "PREMIUM PIN $sitename";
				$mail_text = "Thank you for PREMIUM purchase at $sitename.\r\n".
					"Your PREMIUM pin is: $code \r\n".
					"It contains $pack2 credits! \r\n".
					"In case the pin doesn't work, contact an admin \r\n \r\n".
					"URL: www.$domain \r\n";
					
				$mail_headers = 'From: noreply@'.$domain.''."\r\n".
				'Reply-To: noreply@'.$domain.''."\r\n".
				'Mime-Version: 1.0'."\r\n". 
				'X-Mailer: PHP/'.phpversion();
			mail($sendto, $mail_subject, $mail_text,$mail_headers);
		echo "<script language=\"JavaScript\">
		<!--
 		window.location=\"http://www.$domain/?page=purchase&pin=$code\";//--></script>";
	}
	if($amount == "6" || $amount == "6.00")
	{
		//Generate a code & insert into DB
		//echo "Your PIN code is: $code";
		mysql_query("update payment set PIN='$code', Valid='$pack3', email='$payermail', type='premium' where transaction='$transaction';")
		or die(mysql_error()); 
		if(!empty($refferedby))
		{
		mysql_query("update users set credits=credits+$refamountpack3 where Id='$refferedby'") or die(mysql_error()); 
		mysql_query("insert into refbuy (`IP`, `transaction`, `refid`, `credits`) VALUES ('" . $usrip . "','" . $transaction . "','" . $refferedby . "','". $pack3."');") or die(mysql_error()); 
		}
		else
		{}
				$sendto=$payermail;
				$mail_subject = "PREMIUM PIN $sitename";
				$mail_text = "Thank you for PREMIUM purchase at $sitename.\r\n".
					"Your PREMIUM pin is: $code \r\n".
					"It contains $pack3 credits! \r\n".
					"In case the pin doesn't work, contact an admin \r\n \r\n".
					"URL: www.$domain \r\n";
					
				$mail_headers = 'From: noreply@'.$domain.''."\r\n".
				'Reply-To: noreply@'.$domain.''."\r\n".
				'Mime-Version: 1.0'."\r\n". 
				'X-Mailer: PHP/'.phpversion();
			mail($sendto, $mail_subject, $mail_text,$mail_headers);
		echo "<script language=\"JavaScript\">
		<!--
 		window.location=\"http://www.$domain/?page=purchase&pin=$code\";//--></script>";
	}
	if($amount == "20" || $amount == "20.00")
	{
		//Generate a code & insert into DB
		//echo "Your PIN code is: $code";
		mysql_query("update payment set PIN='$code', Valid='1000', email='$payermail', type='premium' where transaction='$transaction';")
		or die(mysql_error()); 
		echo "<script language=\"JavaScript\">
		<!--
 		window.location=\"http://www.$domain/?page=purchase&pin=$code\";//--></script>";
	}
	if($amount != "1" || $amount != "3" || $amount != "6" || $amount != "20" || $amount != "1.00" || $amount != "20.00" || $amount != "3.00" || $amount != "6.00")
	{
		echo "<script language=\"JavaScript\">
		<!--
 		window.location=\"http://www.$domain/?page=purchase&error=1\";//--></script>";
	}
	}
}
else
{
		echo "<script language=\"JavaScript\">
		<!--
 		window.location=\"http://www.$domain/?page=purchase&error=2\";//--></script>";
}
//}
}
else if (strcmp ($lines[0], "FAIL") == 0) {
echo "INVALID TRANSACTION!<br /><br />";
}

}

fclose ($fp);

?>

Your transaction has been completed, and a receipt for your purchase has been emailed to you.<br>You may log into your account at <a href='https://www.paypal.com'>www.paypal.com</a> to view details of this transaction.<br>
