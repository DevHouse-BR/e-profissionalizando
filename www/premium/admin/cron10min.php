<?php


include "../config.php";
$link = mysql_connect(mysql_host, mysql_user, mysql_password);
mysql_select_db(mysql_db,$link);
mysql_query("UPDATE lastdownloads SET lastdl = '0', extradl = '0'");
mysql_query("update band set disabled='' where disabled='unknown'");


mysql_close($link);
?>