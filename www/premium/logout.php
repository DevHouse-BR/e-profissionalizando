<?php

/**
 * @author Klaas Vanaudenaerde
 * @copyright 2008
 */


// was er in de eerste plaats een cookie geset?
if(isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['userid'])) {
  // verwijder het cookie
  $leeg = "";
  setcookie("username"); 
  setcookie("password"); 
  setcookie("userid"); 
} 
else
{
	echo "error";
}
header("location:index.php");
echo $pin;

?>