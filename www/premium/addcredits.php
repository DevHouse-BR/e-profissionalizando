<?php

/**
 * @author Klaas Vanaudenaerde
 * @copyright 2008
 */
	if(!isset($validlogin))
	{
		$validlogin="0";
	}
if($validlogin == "0")
{
	notallowed();
}
else
{
	?>
	Here you can add the pincode which you have ordered. If you do not have one, <a href="?page=join">click here</a>.<br /><br />
	<center><form class="login" action="?page=insertcredits" method="post"><input name="pin" type="text" value="pincode" onFocus="clearDefault(this)" />&nbsp;<input type="submit" value="Add Credits"></form></center>
	<?php
}


?>