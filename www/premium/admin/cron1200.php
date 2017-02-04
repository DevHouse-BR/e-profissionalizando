<?php


include "../config.php";
$link = mysql_connect(mysql_host, mysql_user, mysql_password);
mysql_select_db(mysql_db,$link);
mysql_query("truncate table downloads");
mysql_query("truncate table extradl");


mysql_close($link);
?>