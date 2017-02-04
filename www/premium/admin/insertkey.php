<?php
include "../db.php";
$key = $_GET["key"];
$downloadurl = $_POST["downloadurl"];
$date = $_POST["date"];

mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
mysql_select_db(mysql_db) or die("SQL Died");
mysql_query("INSERT INTO downloadkey (URL, code, active, date) VALUES ('$downloadurl', '$key','0','$date')");
echo "Key <b>$key</b> with <b>$downloadurl</b> added for $date succesfully!";

?>