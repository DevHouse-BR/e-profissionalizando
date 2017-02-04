<?php
include "../db.php";
include "../config.php";
$link = mysql_connect(mysql_host, mysql_user, mysql_password);
mysql_select_db(mysql_db,$link);
$result4 = mysql_query("truncate table ref");
?>