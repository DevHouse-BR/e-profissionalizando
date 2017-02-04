<link href="style.css" rel="stylesheet" type="text/css" />
<?php

include "../db.php";
?>
Add a server<br /><br />
<table>
	<tr>
		<th>ServerURL</th>
		<th>Name</th>
		<th>Active</th>
		<th>Type</th>
		<th>edit</th>
	</tr>
<?php
mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
mysql_select_db(mysql_db) or die("SQL Died");
$source = mysql_query("SELECT * FROM servers") or die(mysql_error()); 
while($row = mysql_fetch_array( $source )) {
$Id = $row['Id'];
$serverurl = $row['ServerLink'];
$active = $row['active'];
$servername = $row['name'];
$type = $row['type'];
?>
	<tr>
		<td><?php echo "$serverurl"; ?></td>
		<td><?php echo "$servername"; ?></td>
		<td><?php echo "$active"; ?></td>
		<td><?php echo "$type"; ?></td>
		<td><a href="editserver.php?id=<?php echo "$Id"; ?>"><img src="edit_icon.gif" alt="<?php echo "$Id"; ?>" border="0" /></a></td>
	</tr>
<?php
}

?>