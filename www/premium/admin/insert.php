<?php
include "../config.php";
mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
mysql_select_db(mysql_db) or die(mysql_error());
$num = '1';
$today = date('dmy');
//$source = mysql_query("SELECT * FROM band ORDER BY bw ASC ") 
if ($_POST) {
if ($_POST['username']=='') { die ("Username field empty"); }
if ($_POST['password']=='') { die ("Password field empty"); }
$premium = $_POST['username'] . '-' . $_POST['password'];
$type = $_POST['type'];
$source = mysql_query("INSERT INTO `band` (`prem`, `disabled`,`type`) VALUES ('" . $premium . "', 0, '" . $type . "');")
or die(mysql_error());  
$source = mysql_query("INSERT INTO `status` (`bandwidth`, `status`,`type`) VALUES (0, 1, '" . $type . "');")
or die(mysql_error());  
print "Added Account";
} else {

}


?>