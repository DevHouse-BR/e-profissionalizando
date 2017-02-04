<?php

// Vars
$domain = ".domain.com"; // ONLY IF YOU WANT TO USE MULTIPLE SERVERS
//Please add subdomains in the database, this will allow you to create a downloadserver located on another server
//With EveryDNS you can manage your domains very easily, you can add subdomains to get hosted on other servers

// EDIT MYSQL DB HERE
define('mysql_host','localhost',0);
define('mysql_user','user',0);
define('mysql_password','password',0);
define('mysql_db','database',0);


/* DO NOT CHANGE ANYTHING BELOW THIS LINE */

 	function get_value_from_code( $before, $after, $code)
	{
		$match = '#'.$before.'(.+?)'.$after.'#';
		if( preg_match( $match, $code, $match))
		{
			return $match[1];
		}
		return false;
	}

	$conn = mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
	mysql_select_db(mysql_db) or die(mysql_error());
$ipserver = $_SERVER["REMOTE_ADDR"];

	$source = mysql_query("SELECT * FROM servers WHERE IPadress LIKE '%$ipserver%'") or die(mysql_error());  

	$num_rows = mysql_num_rows($source);
	if ($num_rows > 0) {

$downloadid = $_GET['id'];
$usrip = $_GET['usrip'];

if(!empty($downloadid))
{
	$esid = mysql_real_escape_string($downloadid);
	$source = mysql_query("SELECT * FROM historydl WHERE session='$esid' and ip = '$usrip'") or die(mysql_error());  

	$num_rows = mysql_num_rows($source);
	if ($num_rows > 0) {
		while($row = mysql_fetch_array( $source )) {
			$link = $row['rsurl'];
			$pin = $row['pin'];
			$filesize = $row['size'];
				}
				if($pin == "free")
				{
					
					$type = "free";
					// Available Downloadservers
					$source = mysql_query("SELECT * FROM servers WHERE active = '1' and type = '$type'") or die(mysql_error()); 
					$i = 0;
					$mirrorvol = "startmirrors";
					$num_rows = mysql_num_rows($source);
					while($row = mysql_fetch_array( $source )) {
						$i ++;
						$mirrorlink=$row['ServerLink'];
						$mirrorlinkhttp = "http://";
						$mirrorlinkhttp .= $mirrorlink;
						$mirrors = get_value_from_code("","$domain",$mirrorlink);
						$mirrorvol .= $mirrors;
						if($num_rows == $i)
						{
							$mirrorvol .= "endmirrors";
						}
						else	
						{
							$mirrorvol .= "%%";
						}	
					}
					$source = mysql_query("SELECT * FROM band WHERE disabled != 'expired' and disabled != 'bandwidth' and disabled != 'unknown' and disabled != 'incorrect' and type='free' ORDER BY RAND() LIMIT 0,1") or die(mysql_error()); 
					$num_rows = mysql_num_rows($source);
					while($row = mysql_fetch_array( $source )) {
						$prem=$row['prem'];
						mysql_close($conn);
					}
					if($num_rows == 0)
					{
					}
					else
					{
						echo "rsurl:$link<br />filesize:$filesize<br />premium:$prem<br />type:free<br />end";
						echo "<br />$mirrorvol";
					}					
				}
				else
				{
					// Available Downloadservers
					$source = mysql_query("SELECT * FROM servers WHERE active = '1'") or die(mysql_error()); 
					$i = 0;
					$mirrorvol = "startmirrors";
					$num_rows = mysql_num_rows($source);
					while($row = mysql_fetch_array( $source )) {
						$i ++;
						$mirrorlink=$row['ServerLink'];
						$mirrorlinkhttp = "http://";
						$mirrorlinkhttp .= $mirrorlink;
						$mirrors = get_value_from_code("",".imageutd.com",$mirrorlink);
						$mirrorvol .= $mirrors;
						if($num_rows == $i)
						{
							$mirrorvol .= "endmirrors";
						}
						else	
						{
							$mirrorvol .= "%%";
						}	
					}
				$source = mysql_query("SELECT * FROM users WHERE Id='$userid_session'") or die(mysql_error()); 
				while($row = mysql_fetch_array( $source )) {
					$type = $row['type'];
					}
					$type = "premium";
					$source = mysql_query("SELECT * FROM band WHERE disabled != 'expired' and disabled != 'bandwidth' and disabled != 'unknown' and disabled != 'incorrect' and type='premium' ORDER BY RAND() LIMIT 0,1") or die(mysql_error()); 
					$num_rows = mysql_num_rows($source);
					while($row = mysql_fetch_array( $source )) {
					mysql_close($conn);
					$prem=$row['prem'];
					}
					if($num_rows == 0)
					{
					}
					else
					{
						echo "rsurl:$link<br />filesize:$filesize<br />premium:$prem<br />type:$type<br />end";
						echo "<br />$mirrorvol";
					}	
				}
		}
		else
		{
			mysql_close($conn);
			echo "Invalid session";
		}
	}
	else
	{
		mysql_close($conn);
		echo "Empty ID";
	}
}
else
{
	mysql_close($conn);
	echo "Not allowed to see this page from here $ipserver";
}
?>