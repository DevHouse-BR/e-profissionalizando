<?php
$pagestatus = "1";
if($pagestatus == "1")
{
if(empty($_GET['ID']))
{
	if(!isset($validlogin))
	{
		$validlogin="0";
	}
	if($validlogin == "")
	{
		$source = mysql_query("SELECT * FROM downloads WHERE IP='$usrip' and count > 0") or die(mysql_error());  

		$num_rows = mysql_num_rows($source);
		if ($num_rows > 0) {
			$md5ip = md5($usrip);
		echo "This is your personal REFERRAL link! With this link, you can get extra download credits.<br />";
		echo "Each UNIQUE visit on your REFERRAL link is an extra credit (download).<br /><br />";
		echo "<center>Your referral link is: <a href=\"?page=ref&type=free&ID=$usrip\">?page=ref&type=free&ID=$usrip</a> (Right click - copy url)</center>";
			}
			else
			{
				$source = mysql_query("SELECT * FROM downloads WHERE IP='$usrip'") or die(mysql_error()); 
				$num_rows = mysql_num_rows($source);
				if ($num_rows > 0) {
				echo "<center>Sorry, but negative downloads don't exist...!</center>";
				}
				else
				{
					echo "Sorry, but your IP has no records in our database";
				}
			}
	}
	else
	{
		echo "This is your personal REFERRAL link! With this link, you can get extra download credits. Visits from AUTOSURF or PROXY sites or other PPC sites will not be tolerated and accounts will be closed without any notice! By using the REF system you are aware of this rule.<br />";
		echo "Each UNIQUE visit on your REFERRAL link is an extra credit (download). You can have upto 20 extra credits per day.<br /><br />";
			if($credits > 0)
			{
				echo "<center>Your referral link is: <a href=\"?page=ref&ID=$userid_session\">?page=ref&ID=$userid_session</a>  (Right click - copy url)</center>";
			}
			else
			{
				echo "<center>Sorry, but to use the REFERRAL system, you need at least 1 credit in your pin!</center>";
			}
	}
}
else
{
   		include "db.php";
   		$typeref = $_GET['type'];
   		if($typeref == "free")
   		{
   			$s=$_SERVER["REMOTE_ADDR"];
			$encID=$_GET['ID'];
			$ID = mysql_real_escape_string($encID);
			$recentdate=date("U");
			$checkdate=$recentdate-3600*24;
			$feating=$recentdate-45;
			$checkref="SELECT refID from ref where refIP='$s' and pinID='$ID'";
			$checkref2=mysql_query($checkref) or die(mysql_error());
			$checkref3=mysql_num_rows($checkref2);
			$countref="SELECT count(pinID) as aantal from ref where pinID='$ID'";
			$countref2=mysql_query($countref) or die(mysql_error());
			$countref3=mysql_fetch_array($countref2);
			$globalref="SELECT count(pinID) as aantal from ref where pinID NOT LIKE '%.%.%.%'";
			$globalref2=mysql_query($globalref) or die(mysql_error());
			$globalref3=mysql_fetch_array($globalref2);
			$getpin="SELECT * from downloads where IP='$ID' and count > 0";
			$getpin2=mysql_query($getpin) or die("Could not get member...");
			$getpin3=mysql_num_rows($getpin2);
			if($checkref3>0)
			{  
			  print "<center><h2>You have already credited this person today</h2></center>";
			  print "<center><h2>You will have to wait until tommorrow to credit this person again</h2></center>"; 
			}
			else if($getpin3 == 0)
			{
			  print "<center><h2>Sorry, but this IP does not exist or is not allowed to be credited at this time!</h2></center>";
			}
			else if($countref3['aantal'] >= "10")
			{
			  print "<center><h2>Sorry, but this IP has already received 10 credits for today.</h2></center>";
			}
			else if($globalref3['aantal'] >= "20")
			{
			  print "<center><h2>Sorry, but the global ref visits for today are exceeded. We only allow 30 ref visits each day.</h2></center>";
			}
			else
			{
			   print "<center>";
			   $updateperson="Update downloads set count=count-1 where IP='$ID'";
			   mysql_query($updateperson) or die("Could not update row...");
			   $updaterecords="INSERT into ref (refIP,pinID,refTime) values ('$s','$ID','$recentdate')";
			   mysql_query($updaterecords) or die("Could not update row...");
			
					
			   print "<br><h3>$ID has gained another download from Rapidshare!.</h3></center>";
			}
		}
		else
		{
$s=$_SERVER["REMOTE_ADDR"];
$encID=$_GET['ID'];
$ID = mysql_real_escape_string($encID);
$recentdate=date("U");
$checkdate=$recentdate-3600*24;
$feating=$recentdate-45;
$checkref="SELECT refID from ref where refIP='$s' and pinID='$ID' and refTime>'$checkdate'";
$checkref2=mysql_query($checkref) or die(mysql_error());
$checkref3=mysql_num_rows($checkref2);
$countref="SELECT count(pinID) as aantal from ref where pinID='$ID'";
$countref2=mysql_query($countref) or die(mysql_error());
$countref3=mysql_fetch_array($countref2);
$getpin="SELECT * from users where Id='$ID' and credits > 0";
$getpin2=mysql_query($getpin) or die("Could not get premium member...");
$getpin3=mysql_num_rows($getpin2);
if($checkref3>0)
{  
  print "<center><h2>You have already credited this person today</h2></center>";
  print "<center><h2>You will have to wait until tommorrow to credit this person again</h2></center>";
}
else if($getpin3 == 0)
{
  print "<center><h2>Sorry but this is not a PREMIUM user. Or this user does not exist!</h2></center>";
}
else if($countref3['aantal'] >= "20")
{
  setcookie("refferedby", $ID, time()+3600000); 	
  print "<center><h2>Sorry, but this pin has already received 20 credits for today.</h2></center>";
}
else
{
   print "<center>";
   $updateperson="Update users set credits=credits+'1' where Id='$ID'";
   mysql_query($updateperson) or die("Could not update premium member...");
   $updaterecords="INSERT into ref (refIP,pinID,refTime) values ('$s','$ID','$recentdate')";
   mysql_query($updaterecords) or die("Could not update...");

	if($userid_session == $ID)
	{	
		setcookie("refferedby"); 	
	}
	else
	{
		setcookie("refferedby", $ID, time()+3600000); 
	}	
   print "<br><h3>$ID has gained another download from Rapidshare!.</h3></center>";
}
}
}
}
else
{
	echo "Sorry, but because of the many fraud clicks through autosurfers, we have decided to disable the ref function. We will be remaking this page.";
}
?>
