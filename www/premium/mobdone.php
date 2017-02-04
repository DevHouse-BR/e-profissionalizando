<?php

// this sample provides a download of a binary mp3 file if the PIN code is valid
$err = "";

if ( isset($_GET["subkey"]) && !empty($_GET["subkey"]) && isset($_GET["pin"]) && !empty($_GET["pin"]) ) {
// You need to have an app code, www.daopay.com to create a website and a program
    $handle = file_get_contents( "http://DaoPay.com/svc/PINcheck?appcode=YOUR APP CODE HERE&subkey=". urlencode($_GET['subkey']) ."&pin=". urlencode($_GET['pin']) );
    
    if ($handle) {
        
        if( substr($handle, 0, 2) == "ok" ) {
            include "db.php";
            $validationcode = $_GET['pin'];
	    	$conn=mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
			mysql_select_db(mysql_db) or die("SQL Died");
			$source = mysql_query("SELECT * FROM phone WHERE Validation='$validationcode'") or die(mysql_error());  
			$num_rows = mysql_num_rows($source);
			if ($num_rows > 0) {
				echo "Your pin-code is already validated!";
				mysql_close($conn);
				exit;
				}
				else
				{
	      //Code laten genereren    
			$code = "";
			$codeinput="abcdefghijklmnopqrstuvxyz0123456789";
			$aantal=32;
			for ($i = 1; $i <= $aantal; $i++) {
				$code .= $codeinput[rand(0,strlen($codeinput)-1)];
			}
			$IP = $_SERVER['REMOTE_ADDR'];
			
			mysql_query("INSERT INTO payment (`PIN`, `Valid`,`email`,`type`) VALUES ('" . $code . "', 500, '".$validationcode."','premium');")
			or die(mysql_error()); 
			mysql_query("INSERT INTO phone (`PIN`, `Validation`,`ip`) VALUES ('" . $code . "', '".$validationcode."', '".$IP."');")
			or die(mysql_error()); 
					if(!empty($refferedby))
					{
					mysql_query("update users set credits=credits+$refamountpack1 where Id='$refferedby'") or die(mysql_error()); 
					mysql_query("insert into refbuy (`IP`, `transaction`, `refid`, `credits`) VALUES ('" . $usrip . "','" . $validationcode . "','" . $refferedby . "','".$pack1."');") or die(mysql_error()); 
					}
					else
					{}
			echo "<center>Your pincode was accepted!<br /> THIS is your premium download pin code: <h2>$code</h2><br />Make sure you do not loose this information, also keep this number with you (transaction pincode): $validationcode</center>";
			mysql_close($conn);
            //exit;
            }
        
        } else {
        
            echo "Error! Wrong pin or an unknown error has occured";
            //exit;
        
        }
    
    } else {
    
    $err = "Could not validate the PIN code";
    
    }

}
?> 