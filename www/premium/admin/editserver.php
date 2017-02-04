<?php 
include "../db.php";
$id = $_GET['id'];
if(!empty($id))
{
mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
mysql_select_db(mysql_db) or die("SQL Died");
$source = mysql_query("SELECT * FROM servers where Id='$id'") or die(mysql_error()); 
while($row = mysql_fetch_array( $source )) {
$Id = $row['Id'];
$serverurl = $row['ServerLink'];
$active = $row['active'];
$servername = $row['name'];
$type = $row['type'];
$ipadress = $row['IPadress'];
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<br /><br />
<form id="form1" name="form1" method="post" action="updateserver.php?id=<?php echo $id; ?>">
<table width="200" border="1">
  <tr>
    <th scope="row">URL</th>
    <td><label>
      <input type="text" name="serverlink" id="textfield" value="<?php echo $serverurl; ?>" />
    </label></td>
  </tr>
    <tr>
    <th scope="row">Servername</th>
    <td><label>
      <input type="text" name="servername" id="textfield" value="<?php echo $servername; ?>" />
    </label></td>
  </tr>
      <tr>
    <th scope="row">IP Adress</th>
    <td><label>
      <input type="text" name="ipserver" id="textfield" value="<?php echo $ipadress; ?>" />
    </label></td>
  </tr>
  <tr>
    <th colspan="2" scope="row">Type</th></tr>
    
<tr><th>Free</th><td><input name="type" type="radio" value="free" <?php if ($type =="free") { echo "checked=\"1\""; }else { echo ""; } ?>></td></tr>
<tr><th>Premium</th><td><input type="radio" name="type" value="premium" <?php if ($type =="premium") { echo "checked=\"1\""; }else { echo ""; } ?>></td></tr>
  <tr>
    <th colspan="2" scope="row"><label>
      <input type="submit" name="button" id="button" value="Submit" />
    </label></th>
    </tr>
</table>
</form>
<?php
}
}
else
{
	
}
?>