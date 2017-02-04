<?php
	if(!isset($validlogin))
	{
		$validlogin="0";
	}
if($validlogin == "0")
{
	?><form class="login" action="login4.php" method="post"><input name="username" type="text" id="usernametop" value="Username" onFocus="clearDefault(this)" /><input name="password" id="passwordtop" type="password" value="Password" onFocus="clearDefault(this)" /><input type="submit" value="" id="loginbutton" src="images/loginbutton.png"></form>

<?php
echo "<a href=\"?page=register\" style=\"color:#FFFFFF;\">Register</a> - <a href=\"?page=forgotpass\" style=\"color:#FFFFFF;\">Forgot Password?</a> | Reset in <b>$timeleft</b><br />";
if($lastdl-$extradl >10)
{
	$dlstatus=10;
}
else
{
	$dlstatus=($lastdl-$extradl)*10;
}
echo "Bandwidth status: <img src=\"bandwidth.php?rating=$dlstatus\" alt=\"$dlstatus %\" title=\"$dlstatus %\"; />";
//echo "Extra downloadslots: $extradl<br />";
//echo "<b>Downloadstatus</b>: $lastdl / $limittot <br />(<a href=\"?page=ads\">Raise this limit</a>)<br /><br />";
	$source = mysql_query("SELECT * FROM downloads WHERE IP='$usrip'") or die(mysql_error());  
	while($row = mysql_fetch_array( $source )) {
		$countdl = $row['count'];
		}
		if($countdl=="")
		{
			$countdl=0;
		}
	//echo "You have downloaded $countdl/10<br /><br />";
	$bandw = 0;
	$source = mysql_query("SELECT sum(size) as totalsize FROM today") 
	or die(mysql_error());  

	while($row = mysql_fetch_array( $source )) {
	$bandw = $row['totalsize'];
	}

		
	$mb = $bandw/1000000;
	$gb = $mb / 1000;
	$bgb = round($gb,2);
	$bmb = round($mb,0);
	
	//echo "Generated today (free users): <br />$bmb Mb ($bgb Gb)<br /><br />";
	
	$bandw = 0;
	$source = mysql_query("SELECT sum(size) as totalsize FROM historydl where pin='free'") 
	or die(mysql_error());  

	while($row = mysql_fetch_array( $source )) {
	$bandw = $row['totalsize'];
	}

		
	$mb = $bandw/1000000;
	$gb = $mb / 1000;
	$bgb = round($gb,2);
	$bmb = round($mb,0);
	
//	echo "Total Generated (free users):<br /> $bmb Mb ($bgb Gb)";

?>


	<?php
}
else
{
	echo "Welcome, <b>$usernamelogin</b> ($type)<br /><br />";
	echo "<b>Credits</b>: $credits <img src=\"images/coins.png\" alt=\"coins\" /> - <a href=\"?page=addcredits\" style=\"color:#FFFFFF;\">Add credits</a> - <a href=\"?page=changepass1\" style=\"color:#FFFFFF;\">Change Password</a><br />";
	echo "<a href=\"?page=logout\" style=\"color:#FFFFFF;\">Logout <img src=\"images/disconnect.png\" border=\"0\" alt=\"coins\" /></a>";
}
?>
