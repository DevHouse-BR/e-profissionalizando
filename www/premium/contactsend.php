<?php 

// get posted data into local variables
$EmailTo = "klaas.vanaudenaerde@gmail.com";
$Subject = "RS Contact Admin";
$Name = Trim(stripslashes($_POST['Name'])); 
$Email = Trim(stripslashes($_POST['Email'])); 
$Message = Trim(stripslashes($_POST['Message'])); 

// validation
$validationOK=true;
if (!$validationOK) {
  print "Error";
  exit;
}

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $Name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $Email;
$Body .= "\n";
$Body .= "IP: ";
$Body .= $usrip;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $Message;
$Body .= "\n";

// send email 
$success = mail($EmailTo, $Subject, $Body, "From: <LH RapidShare>");

// redirect to success page 
if ($success){
  print "<center>Your email has been sent.</center>";
}
else{
  print "Failed to send, Close window, reopen and try again.";
}
?>