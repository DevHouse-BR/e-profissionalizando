<div align="center"><table>
<tr>
	<td><b>AccountID</b></td>
	<td><b>Bandwidth</b></td>
	<td><b>Status</b></td>
	<td><b>Type</b></td>
</tr>
<?php
$source = mysql_query("SELECT * FROM status order by AccountID asc") 
or die(mysql_error());  
while($row = mysql_fetch_array( $source )) {
$premid = $row['AccountID'];
$bw = $row['bandwidth'];
if($bw=="bandwidth" || $bw=="expired" || $bw=="incorrect" || $bw=="unknown")
{
$status="0";
}
else
{
$status="1";
}
$today = $row['today'];
$type1= $row['type'];
?>
<tr>
	<td><?php echo "$premid"; ?></td>
	<td><?php echo "$bw"; ?> / 25 GB</td>
	<td><center><img src="images/<?php echo "$status"; ?>.png" alt="<?php echo "$status"; ?>"/></center></td>
	<td><?php echo "$type1"; ?></td>
</tr>
<?php
}
?>
</table></div>