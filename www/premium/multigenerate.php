<?php

/**
 * @author Klaas Vanaudenaerde
 * @copyright 2008
 */

function convertservers($serverid,$links,$type,$servername)
{
	$serverslinks = str_replace("replace",$serverid,$links);
	echo "$type server - $servername<br />";
	echo "$serverslinks";
}
$usrip = $_SERVER['REMOTE_ADDR'];
	if(!isset($validlogin))
	{
		$validlogin="0";
	}
if(isset($_POST['multidllink']) && !empty($validlogin))
{
	$aantallinks = count($_POST['multidllink']);
    $source = mysql_query("SELECT * FROM users WHERE Id='$userid_session' and credits >= $aantallinks and type != 'free'") or die(mysql_error());      
	$num_rows = mysql_num_rows($source);
		if ($num_rows == 0) {
			echo "Sorry, invalid pin or not enough credits or you have a free pin...";
			}
			else
			{
				echo "We have updated our multidl function!";
    for ($i=0; $i<count($_POST['multidllink']);$i++) {
       $file = $_POST['multidllink'][$i];
       		$md5session = $usrip;
			$md5session .= $file;
			$md5session .= time();
			$md5sess = md5($md5session);
			$try = getFileInfo($file);
			$filesize = $try['fsize'];
       //mysql_query("insert into history (PIN, file, IP) VALUES('$pin','$file','$usrip') ") or die(mysql_error()); 
       mysql_query("insert into historydl (rsurl, ip, session, size, pin,time) VALUES('$file','$usrip','$md5sess','$filesize','$userid_session','$time_generated') ") or die(mysql_error());
							
								$listlinks .= "<a href=\"http://$serverlink[0]/download.php?id=$md5sess\"></a><br />";
						// Making download file
						// Filling server files to display
					/*	$serverfiles .= "<a href=\"http://$server/$md5sess\" target=\"_blank\">http://$server/$md5sess</a><br />"; */
						$namefiles = basename($file);
						/*$namefiles .= "($md5sess) - (size: $filesize)";*/
						//$server6files .= "http://$server6/files/premium/$bestand<br />";
						$httpfiles .= "http://replace/download.php?id=$md5sess<br />";
						$filedetails .= "$md5sess = $namefiles<br />";
						$totalsize += $filesize;
    }
//	$convertfiles = $httpfiles;
			//$totalsizeconvert = round(($totalsize / 1000),1);

			echo "<center><br />You have generated <b>$totalsize</b> KB<br /><br />";
			echo $filedetails;
			echo "<br />";
    		$sourceserver = mysql_query("select * from servers where active = '1'");
			$num_servers = mysql_num_rows($sourceserver);
				while($rowserver = mysql_fetch_array( $sourceserver )) {
					$serverlink = $rowserver['ServerLink'];
					$servername = $rowserver['name'];
					$servertype = $rowserver['type'];
					echo "<br /><b>$servertype server - $servername</b><br />";
					$strreplace = str_replace("replace",$serverlink,$httpfiles);
					echo $strreplace;
					//$resultconvert = convertservers($serverlink,$convertfiles,$servertype,$servername);
					//echo $resultconvert;
					}
			echo "</center>";
    	mysql_query("update users set credits = credits - $aantallinks where Id = '$userid_session'");
    		/*echo "<center>";
			echo "<span class=multigenerate><br />";
			echo $servertitle1;
			echo "<br /><br />";
			echo "$serverlink1";
			echo "<br />";
			echo "</span>";	
			echo "</center>";*/
    
			}
			}
else
{
	notallowed();
}
?>