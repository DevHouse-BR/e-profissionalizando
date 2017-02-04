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
//Define download servers
						}
						else
						{

						}

$usrip1 = $_SERVER['REMOTE_ADDR'];
$rand = rand(0,1000000);

if(isset($_POST['submit']))
{
    for ($i=0; $i<count($_POST['links']);$i++) {
       $fileid = $_POST['links'][$i];
       //echo "$fileid";
       	$source = mysql_query("SELECT * FROM historydl WHERE Id = '$fileid'") or die(mysql_error()); 
		while($row = mysql_fetch_array( $source )) {
			$file = $row['rsurl'];
			$md5session = $usrip;
			$md5session .= $file;
			$md5session .= time();
			$md5sess = md5($md5session);
			$try = getFileInfo($file);
			$filesize = $try['fsize'];
			if($pin == "")
			{
				$pin = "free";
			}
			if($validlogin == "0")
			{
				mysql_query("insert into historydl (rsurl, ip, session, size, pin, regenerate, time) VALUES('$file','$usrip','$md5sess','$filesize','free','1','$time_generated') ") or die(mysql_error());
			}
			else
			{
				mysql_query("insert into historydl (rsurl, ip, session, size, pin, regenerate, time) VALUES('$file','$usrip','$md5sess','$filesize','$userid_session','1','$time_generated') ") or die(mysql_error());
			}
       //mysql_query("insert into history (PIN, file, IP) VALUES('$pin','$file','$usrip') ") or die(mysql_error()); 
       

						// Making download file
						// Filling server files to display
						$serverfiles .= "<a href=\"http://$server/download.php?id=$md5sess\" target=\"_blank\">http://$server/download.php?id=$md5sess</a><br />";
						$namefiles .= basename($file);
						$namefiles .= "($md5sess) - (size: $filesize)<br />";
						//$server6files .= "http://$server6/files/premium/$bestand<br />";
			}
    }
    		echo "<center>";
			echo "<span class=multigenerate><br />";
			echo $namefiles;
			echo "<br /><br />";
			echo $serverfiles;
			echo "<br />";
			echo "</span>";	
			echo "</center>";

}
else
{
	echo "Sorry you cannot view this file directly from here";
}
?>