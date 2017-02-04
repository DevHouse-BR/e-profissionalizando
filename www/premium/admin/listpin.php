<link href="style.css" rel="stylesheet" type="text/css" />
<?php

include "../db.php";
?>
<table>
	<tr>
		<th>Id</th>
		<th>PIN</th>
		<th>Valid</th>
		<th>email</th>
		<th>edit</th>
	</tr>
<?php
mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
mysql_select_db(mysql_db) or die("SQL Died");
$source = mysql_query("SELECT * FROM payment") or die(mysql_error()); 
while($row = mysql_fetch_array( $source )) {
$pID = $row['pID'];
$pin = $row['PIN'];
$valid = $row['Valid'];
$email = $row['email'];
?>
	<tr>
		<td><?php echo "$pID"; ?></td>
		<td><?php echo "$pin"; ?></td>
		<td><?php echo "$valid"; ?></td>
		<td><?php echo "$email"; ?></td>
		<td><a href="editpin.php?pin=<?php echo "$pin"; ?>"><img src="edit_icon.gif" alt="<?php echo "$pin"; ?>" border="0" /></a></td>
	</tr>
<?php
}

?>