<?php
session_start();
include "db.php";
$conn=mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
mysql_select_db(mysql_db) or die("SQL Died");
$username = $_POST['username'];
$password = $_POST['password'];
$md5password = md5($password);
$espin = mysql_real_escape_string($pin);
						$source = mysql_query("SELECT * FROM users WHERE username='$username' and password='$md5password' and active='1'") or die(mysql_error());  

						$num_rows = mysql_num_rows($source);
						if ($num_rows == 0) {
							mysql_close($conn);
							header("location:index.php?page=errorlogin");
							}
						else
						{
							while($row = mysql_fetch_array( $source )) {
								$userids = $row['Id'];
							}
							mysql_close($conn);
							setcookie("username", $username, time()+3600000); 
							setcookie("password", $md5password, time()+3600000); 
							setcookie("userid", $userids, time()+3600000); 
							header("location:index.php");
						}
?>