			<h1>THANK YOU FOR YOUR PREMIUM PURCHASE AT RAPIDDOWNLOADER</h1>
				<div align="center">	
<?php
$error = $_GET["error"];
$code = $_GET["pin"];
if($error == "1")
{
echo "<p>You tried to cheat on the payment system. Please contact support (error 1)</p>";
}
if($error == "2")
{
echo "<p>Payment was not complete. Please contact support (error 2)</p>";
}
if ($error == "3")
{
echo "<p>Error with transaction! Please contact support (error 3)</p>";
}
if ($code != "")
{
echo "<p>Your PIN code is <b>$code</b> - Please keep it safe. If you have forgotten your PIN, please contact us</p>";
}
?></div>