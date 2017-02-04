<?php

/**
 * @author Klaas Vanaudenaerde
 * @copyright 2008
 */
	if(!isset($validlogin))
	{
		$validlogin="0";
	}
if($validlogin == "0")
{
	notallowed();
}
else
{
	$pincredits = $_POST['pin'];
	if($pincredits == "")
	{
		echo "Error (code: 002)";
	}
	else
	{
		$source = mysql_query("SELECT * FROM payment WHERE PIN='$pincredits' and Valid > 0") or die(mysql_error());  
		$num_rows = mysql_num_rows($source);
		if ($num_rows == 0) {
			echo "Sorry, this pin is inactive or has 0 credits";
			}
		else
		{
			while($row = mysql_fetch_array( $source )) {
				$creditsleft = $row['Valid'];
				}
				echo "You have added $creditsleft credits to your account!";
				$now = time();
			$insertlog="INSERT into credittransactions (pin,credits,destinationid,time,ip) values ('$pincredits','$creditsleft','$userid_session','$now','$usrip')";
  			 mysql_query($insertlog) or die("Could not save transaction...");
			mysql_query("update users set type ='premium' where Id='$userid_session'");
			mysql_query("update users set credits = credits + $creditsleft where Id='$userid_session'");
			mysql_query("update payment set Valid='0' where PIN='$pincredits'");
			mysql_query("update historydl set pin='$userid_session' where pin='$pincredits'");
		}
	}
}

?>