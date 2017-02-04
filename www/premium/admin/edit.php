<?php
include "../config.php";

mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
mysql_select_db(mysql_db) or die(mysql_error());


//$source = mysql_query("SELECT * FROM band ORDER BY bw ASC ") 
$source = mysql_query('SELECT *FROM `band` ORDER BY `band`.`bw` ASC')
or die(mysql_error());  

while($row = mysql_fetch_array( $source )) {
$prem = $row['prem'];
$bw = $row['bw'];
$dis = $row['disabled'];
if ($dis != "") {
echo "<font color='red'><a href='edit2.php?acc=$prem'>$prem</a> - $bw<br></font>";
} else {
echo "<a href='edit2.php?acc=$prem'>$prem</a> - $bw<br>";
}
	
	}


?>