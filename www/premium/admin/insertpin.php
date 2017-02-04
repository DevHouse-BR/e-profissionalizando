<?php
include "../db.php";
$pin = $_GET["pin"];
$credits = $_POST["credits"];
$email = $_POST["email"];

mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
mysql_select_db(mysql_db) or die("SQL Died");
mysql_query("INSERT INTO payment (PIN, Valid, email,type) VALUES ('$pin', '$credits','$email','premium')");
echo "PIN <b>$pin</b> with <b>$credits</b> added succesfully!";

?>