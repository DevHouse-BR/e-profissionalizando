<?php 
session_start();
$action = $_GET['action'];
if($action == "activate")
{
	$key = $_GET['key'];
	
	$source = mysql_query("SELECT * FROM users WHERE activatekey='$key' and active = '0'") or die(mysql_error());  
		$num_rows = mysql_num_rows($source);
		if ($num_rows == 0) {
		echo "Sorry, invalid activationkey or activationkey already activated";
		}
		else
		{
				$source = mysql_query("SELECT * FROM users WHERE activatekey='$key' and active = '0'") or die(mysql_error());  
				$num_rows = mysql_num_rows($source);
				if ($num_rows > 0) {
					mysql_query("update users set active='1' where activatekey='$key';") or die(mysql_error()); 
					echo "Your account has been activated, you can now login with your username & password";
				}
		}
}
else
{
$code = "";
$codeinput="abcdefghijklmnopqrstuvxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$aantal=32;
for ($i = 1; $i <= $aantal; $i++) {
$code .= $codeinput[rand(0,strlen($codeinput)-1)];
}
?>
<br />
<center>Register here for a free account, in this account you can add credits with a pin. An activation key will be mailed to your email.<br />
<br />
<form method="post" name="form_two" action="index.php?page=registered">
<table width="200" border="1" class="join">
  <tr>
    <th scope="row">Username</th>
    <td><label>
      <input type="text" id="fname" name="username" size="60" />
    </label></td>
  </tr>
    <tr>
    <th scope="row">Password</th>
    <td><label>
      <input type="password" id="fname" name="password" size="60" />
    </label></td>
  </tr>
      <tr>
    <th scope="row">Password (again)</th>
    <td><label>
      <input type="password" id="fname" name="password2" size="60" />
    </label></td>
  </tr>
  <tr>
    <th scope="row">Email address</th>
    <td><label>
      <input type="text" id="fname" name="email" size="60" />
    </label></td>
  </tr>
  <tr>
    <th scope="row">Eail address (again)</th>
    <td><label>
      <input type="text" id="fname" name="email2" size="60" />
    </label></td>
  </tr>
    <tr>
    <th scope="row">CAPTCHA</th>
    <td><img src="captchaeasy.php" alt="captcha" /></td>
  </tr>
    <tr>
    <th scope="row">Enter CAPTCHA</th>
    <td><label>
      <input type="text" id="fname" name="code" size="60" />
    </label></td>
  </tr>
  <tr>
    <th colspan="2" scope="row"><label>
    <input type="hidden" name="activationkey" value="<?php echo $code; ?>">
      <input type="submit" name="button" id="button" value="Register" />
    </label></th>
    </tr>
</table>
</form></center>
<?php
}
?>