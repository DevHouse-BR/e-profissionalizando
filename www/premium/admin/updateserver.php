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
$result = mysql_query("UPDATE `servers` SET ServerLink = '".$serverlink."',name='" . $servername . "', type='" . $type . "' , IPadress='" . $ipserver . "' WHERE Id='" . $_GET['id'] . "'");
print "Server updated, please make sure you configured this server good";
} else {

}


?>