Click an account to delete (There is no confirmation before deleting!).<br><br>
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
	echo "<a href='del2.php?acc=$prem'>$prem</a> - $bw<br>";
	
	}


?>