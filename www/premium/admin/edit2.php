<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
include "../config.php";
$link = mysql_connect(mysql_host, mysql_user, mysql_password);
mysql_select_db(mysql_db,$link);

if ($_POST) {
$prem = $_POST['username'] . '-' . $_POST['password'];
$result = mysql_query("UPDATE `band` SET prem='" . $prem . "', bw='" . $_POST['bandwidth'] . "' , disabled='" . $_POST['dis'] . "' WHERE prem='" . $_POST['old'] . "'");
echo "Updated";
} else {
$acc = $_GET['acc'];
$result = mysql_query("SELECT * FROM `band` WHERE prem='" . $acc . "'");

while($row = mysql_fetch_array( $result )) {

	$bw = $row['bw'];
$dis = $row['disabled'];
	//$acnt = $row['prem'];
	}
	
$prem = explode('-',$_GET['acc']);


?>
<form id="form1" name="form1" method="post" action="edit2.php">
  <p>Username
    <input type="text" name="username" value="<?php echo $prem[0]; ?>"/>
    <br />
    Password
    <input type="text" name="password" value="<?php echo $prem[1]; ?>" />
    <br />
    Bandwidth
    <input type="text" name="bandwidth" value="<?php echo $bw; ?>"/>
<br> Disabled 
    <input type="text" name="dis" value="<?php echo $dis; ?>"/>
    <input name="old" type="hidden" id="old" value="<?php echo $_GET['acc']; ?>" />
  </p>
  <p>
    <input type="submit" name="Submit" value="Update" />
  </p>
</form>
<br />
</body>
</html>
<?php 

}
?>