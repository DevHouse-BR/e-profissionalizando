<?php
// DB Connection
$code = $_POST['code'];
if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Controle op kwaadwillende input...
    if (ereg ('[.,$&()*"\/ ><;:|}{_+=^#!~`%@]', $_POST['code'])) { 
        // Verboden karakters gevonden
        echo "<p>Found not allowed chars...</p>"; // Die!
    }else{
        // Service van de zaak: case-insensitive
        $tekst = strtoupper($_POST['code']);
    }
    if($tekst){
        if ($tekst != $_SESSION['teBewaren']) {
            // Afwijkende codes
            echo "<p>BAD CODE!</p>";
        }else{
            if(empty($_POST['email']))
{
	echo "Sorry, you did not enter any email address";
}
else
{
	$email = $_POST['email'];
	$email2 = $_POST['email2'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$username = $_POST['username'];
	$activationkey = $_POST['activationkey'];
	
	if ($email != $email2)
	{
		echo "Sorry, the 2 email addresses you entered do not match";
	}
	else if ($password != $password2)
	{
		echo "Sorry, the 2 passwords you entered do not match";
	}
	else
	{
		$source = mysql_query("SELECT * FROM users WHERE username = '$username'") or die(mysql_error());  
		$num_rows = mysql_num_rows($source);
		if ($num_rows > 0) {
			echo "Sorry, but this username has already been taken.";
		}
		else
		{		
		$source = mysql_query("SELECT * FROM users WHERE email = '$email'") or die(mysql_error());  

		$num_rows = mysql_num_rows($source);
		if ($num_rows >= 1) {
			echo "Sorry, but this email address exists already in our database";
			}
			else
			{
				$source = mysql_query("SELECT * FROM payment WHERE PIN = '$pin' and type = 'free'") or die(mysql_error());  
				$num_rows = mysql_num_rows($source);
				if ($num_rows >= 1) {
					echo "Sorry, but this PIN already exists in our database!";
					}
					else
					{
   		 if (preg_match('~^[a-z0-9][a-z0-9_.\-]*@([a-z0-9]+\.)*[a-z0-9][a-z0-9\-]+\.([a-z]{2,6})$~i', $email) ){
            echo "Thank You, you are registered! Please check your e-mail to activate your account. Also check your SPAM inbox. Did";
            	$sendto=$email;
				$mail_subject = "ACTIVATION KEY - $sitename";
				$mail_text = "Thank you for registration at $sitename.\r\n".
					"Your ACTIVATION key is: $activationkey \r\n". 
					"Click here to activate: http://www.$domain/?page=register&action=activate&key=$activationkey \r\n \r\n".
					"Your username: $username \r\n".
					"Your password: $password \r\n \r\n".
					"In case the key doesn't work, contact an admin \r\n \r\n".
					"URL: www.$domain \r\n";
					
				$mail_headers = 'From: noreply@'.$domain.''."\r\n".
				'Reply-To: noreply@'.$domain.''."\r\n".
				'Mime-Version: 1.0'."\r\n". 
				'X-Mailer: PHP/'.phpversion();
			mail($sendto, $mail_subject, $mail_text,$mail_headers);
			$md5password = md5($password);
        mysql_query("INSERT INTO users (`username`, `email`,`password`,`credits`,`type`,`active`,`activatekey`) VALUES ('$username', '$email', '".$md5password."','0','free','0','$activationkey');")
		or die(mysql_error()); 
         }else{
                  echo "You did not enter a valid email address, please try again!";
                } 
                }
                }
	}
	
}
		}
		}
    }else{
        // Geen code gepost
        echo "<p>NO CODE!</p>";
    }
} 

?>
