<?php 
	if(!isset($validlogin))
	{
		$validlogin="0";
	}
if($validlogin=="")
{
	echo "Sorry but you do not have access to view this page";
}
else
{
	$i=0;
?>
<center>On this page you can see the network status. It checks if the downloadservers are working or not. If a server is offline it will be displayed and updated in our database. We check every 7 minutes on our downloadservers to see if there are no problems.<br /><br /><table>
	<tr>
		<th>URL</th>
		<th>ServerName</th>
		<th>Type</th>
		<th>Status</th>
		<th>Visit</th>
	</tr>
<?php
$source = mysql_query("SELECT * FROM servers where harddisable!='1'") or die(mysql_error()); 
while($row = mysql_fetch_array( $source )) {
$Id = $row['Id'];
$url = $row['ServerLink'];
$name = $row['name'];
$active = $row['active'];
$typeaccsrv = $row['type'];
?>
<?php $i++; ?>
<?php if($i%2==0) { $oddeven="even"; } else { $oddeven="odd"; } ?>
	<tr class="<?php echo $oddeven; ?>">
		<td><?php echo "$url"; ?></td>
		<td><?php echo "$name"; ?></td>
		<td><?php echo "$typeaccsrv"; ?></td>
		<td><?php echo "<img src=\"images/$active.png\" alt=\"$active\" />" ?></td>
		<td><?php echo "<a href=\"http://$url/download.php?id=abc\" target=\"_blank\">Visit</a>"; ?></td>
	</tr>
<?php
}
?>
</table>
<?php
 }
?>