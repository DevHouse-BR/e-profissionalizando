<?php
$email = $_POST["email"];
$usrip = $_SERVER['REMOTE_ADDR'];
$newpass = "";
$codeinput="abcdefghijklmnopqrstuvxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$aantal=6;
for ($i = 1; $i <= $aantal; $i++) {
$code .= $codeinput[rand(0,strlen($codeinput)-1)];
}
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
$activate = $_GET['activate'];
if(empty($activate))
{
	if(empty($_POST['oldpass']) || empty($_POST['newpass']) || empty($_POST['newpass2']))
	{
		notice("No password entered");
	}
	else
	{
		$oldpass = $_POST['oldpass'];
		$newpass = $_POST['newpass'];
		$newpass2 = $_POST['newpass2'];
		$changekey = $_POST['changekey'];
		$md5oldpass = md5($oldpass);
		$source = mysql_query("SELECT * FROM users WHERE Id = '$userid_session' and active='1' and password='$md5oldpass'") or die(mysql_error()); 
		$num_rows = mysql_num_rows($source);
		if ($num_rows >= 1) 
		{
			if($newpass != $newpass2)
			{
				echo "Sorry, the entered password do not match";
			}
			else
			{
				$source = mysql_query("SELECT * FROM users WHERE Id = '$userid_session'") or die(mysql_error()); 
				while($row = mysql_fetch_array( $source )) {
					$emailrow = $row["email"];
					$sendto=$emailrow;
					$mail_subject = "Change Password Rapidshare-Premium";
					$mail_text = "Dear, \r\n \r\nYou have requested to change your password from ip: $usrip;.\r\n".
						"Your new password is: $newpass \r\n \r\n".
						"Please use this link to confirm it - Please make sure you are logged in to your account to activate it: \r\n \r\n".
						"http://rapidshare-premium.com/?page=changepass&activate=$changekey\r\n \r\n".
						"$domain";
						
					$mail_headers = 'From: noreply@'.$domain.''."\r\n".
					'Reply-To: noreply@'.$domain.''."\r\n".
					'Mime-Version: 1.0'."\r\n". 
					'X-Mailer: PHP/'.phpversion();
				mail($sendto, $mail_subject, $mail_text,$mail_headers);
				$md5newpass = md5($newpass);
				mysql_query("update users set newpassword='$md5newpass', changepasskey='$changekey' where Id = '$userid_session'") or die(mysql_error()); 
					}
					echo "An activation mail to change your password has been sent to your email address.";
			}

		}
		else
		{
			echo "Sorry, but the entered password or username was not correct...";
		}
			?>
			<?php
}
}
else
{
		$source = mysql_query("SELECT * FROM users WHERE Id = '$userid_session' and active='1' and changepasskey='$activate'") or die(mysql_error()); 
		$num_rows = mysql_num_rows($source);
		if ($num_rows >= 1) 
		{
			while($row = mysql_fetch_array( $source )) {
				$newpassword = $row['newpassword'];
				}
			mysql_query("update users set password='$newpassword', changepasskey='', newpassword='' where Id = '$userid_session'") or die(mysql_error()); 
			echo "Your password has been changed!";
		}
		else
		{
			echo "Sorry, but the activation key has not been found.";
		}
}
}
?>
