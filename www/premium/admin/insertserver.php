<?php
include "../config.php";
mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
mysql_select_db(mysql_db) or die(mysql_error());
if ($_POST) {
if ($_POST['servername']=='') { die ("Servername field empty"); }
if ($_POST['serverlink']=='') { die ("Serverlink field empty"); }
$servername = $_POST['servername'];
$serverlink = $_POST['serverlink'];
$ipserver = $_POST['ipserver'];
$type = $_POST['type'];
$source = mysql_query("INSERT INTO servers (name, ServerLink, type, IPadress, active) VALUES ('" . $servername . "', '" . $serverlink . "', '" . $type . "','".$ipserver."', '1');")
or die(mysql_error());  
print "Server added, please make sure you configured this server good";
} else {

}


?>