<?php
$email = $_POST["email"];
$usrip = $_SERVER['REMOTE_ADDR'];
$newpass = "";
$codeinput="abcdefghijklmnopqrstuvxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$aantal=6;
for ($i = 1; $i <= $aantal; $i++) {
$newpass .= $codeinput[rand(0,strlen($codeinput)-1)];
}
if(empty($_POST["email"]))
{
?>
<center><form action="index.php?page=forgotpass" method="post">E-Mail address: <input name="email" type="text" size="40" /> <input name="submit" type="submit" value="Mail It!" /></form></center>
<?php
}
else
{
		$source = mysql_query("SELECT * FROM users WHERE email = '$email' and active='1'") or die(mysql_error()); 
		$num_rows = mysql_num_rows($source);
		if ($num_rows >= 1) 
		{
			$source = mysql_query("SELECT * FROM users WHERE email = '$email'") or die(mysql_error()); 
			while($row = mysql_fetch_array( $source )) {
				$emailrow = $row["email"];
				$sendto=$emailrow;
				$mail_subject = "Your NEW password on Rapidshare-Premium";
				$mail_text = "Dear, \r\n \r\nYou have requested a forgot password from ip: $usrip;.\r\n".
					"Your new password is: $newpass \r\n \r\n".
					"$domain";
					
				$mail_headers = 'From: noreply@'.$domain.''."\r\n".
				'Reply-To: noreply@'.$domain.''."\r\n".
				'Mime-Version: 1.0'."\r\n". 
				'X-Mailer: PHP/'.phpversion();
			mail($sendto, $mail_subject, $mail_text,$mail_headers);
			$md5newpass = md5($newpass);
			mysql_query("update users set password='$md5newpass' where email = '$email'") or die(mysql_error()); 
				}
				echo "Your new password has been mailed to $email";
		}
		else
		{
			echo "Sorry, but your e-mail adress has not been found in the database. Or it has not been activated...";
		}
			?>
			<?php
}

?>
