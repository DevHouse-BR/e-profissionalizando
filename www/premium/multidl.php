<SCRIPT LANGUAGE="JavaScript">
function setCheckboxes(form_name, check_value)
{
    var oElements = (typeof(document.forms[form_name].elements['multidllink[]']) != 'undefined') ? document.forms[form_name].elements['multidllink[]'] : null;
    var iElements  = (typeof(oElements.length) != 'undefined') ? oElements.length : 0;

    if (iElements) {
        for (var i = 0; i < iElements; i++) {
            oElements[i].checked = check_value;
        }
    } else {
        oElements.checked = check_value;
    }
}
</script>
<?php
$j=0;
$rand = rand(0,1000000);
$usrip = $_SERVER['REMOTE_ADDR'];

// Fix URL
    function fixurl()
    {
        global $url;
        if (substr($url,0,7) == "/files/")
        {
            return "";
        }
        if (substr($url,0,7) == "http://")
        {
            $url = substr($url,7);
        }
        if (substr($url,0,4) == "www.")
        {
            $url = substr($url,4);
        }
        /*if (substr($url,-5) == ".html")
        {
            $url = substr($url,0,-5);
        }*/
        if (substr($url,0,11) == "rapidshare.")
        {
            $url = substr($url,11);
        }
        if (substr($url,0,3) == "com")
        {
            $url = substr($url,3);
        }
        else if (substr($url,0,2) == "de")
        {
            return "Fail: We do not currently support .de links.";
        }
        else
        {
            return "Fail: Bad URL.";
        }
    }
 

if(empty($_POST['multidl']))
{
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
		echo "<center>Your files will be checked on rapidshare. Then select the files you want to generate. You won't loose credits with checking them with RS. When you generate them, you will loose credits. Limit your links to 30.<br />If you are getting an error, then please check if there are any white lines entered. We are fixing this bug.<br /><br /><form action=\"index.php?page=multidl\" method=\"post\">
RS Links: <br /><textarea name=\"multidl\" cols=\"50\" rows=\"30\"></textarea><br />
<input name=\"submit\" type=\"submit\" value=\"submit\" /></form></center>";
}
}
else
{
	//POST
	$links = $_POST["multidl"];
	//Exploden
	$aRegels = explode(PHP_EOL, $links);
	// Regels tellen
	$count = count($aRegels);
	// For lus
	if($count > 30)
	{
		echo "<center>Please do not enter more then 30 links</center>";
	}
	else
	{
$source = mysql_query("SELECT * FROM users WHERE Id='$userid_session' and credits >= $count") or die(mysql_error());  
	$num_rows = mysql_num_rows($source);
	if ($num_rows > 0) {
	echo "<center>Please select the files you want to generate.<br />";
	echo "<form action=\"index.php?page=multigenerate\" method=\"post\" name=\"form\">";
	echo "<a href=\"javascript: setCheckboxes('form', true)\">Select all</a> / <a href=\"javascript: setCheckboxes('form', false)\">Unselect all</a>";
	echo "<br /><br /><table>";
	echo "<tr>";
    echo "<th scope=\"col\">File</th>";
    echo "<th scope=\"col\">Select</th>";
 	echo "</tr>";
for($i=0;$i<$count;$i++)
{
	$rslinks = $aRegels[$i];
	$url = $rslinks;
    $error = fixurl();
    if ($error != "")
    {
    	$result = 'Error with the entered URL';
    }
    else
    {
		$result = $rslinks;
	}
	$linkf = str_replace (" ", "", "$rslinks");
$full_link = getserver($linkf);

// HTML weghalen...
if (substr($full_link,-5) == ".html")
{
    //$full_link = substr($full_link,0,-5);
}
$basename = basename($full_link);

			//echo "$file";
			//echo "<br />";
			$j++;
			if($j % 2 == 0)
			{
				$oddeven = "evn";
			}
			else
			{
				$oddeven = "odd";
			}
			  echo "<tr class=\"$oddeven\">";
   				 echo "<td>$basename</td>";
   				 echo "<td><input name=\"multidllink[]\" type=\"checkbox\" value=\"$full_link\" /></td>";
 			 echo "</tr>";
			}
		echo "</table>";
		echo "<input name=\"checkbox\" type=\"submit\" value=\"Generate selected\" /><br /><br />";
		echo "<a href=\"javascript: setCheckboxes('form', true)\">Select all</a> / <a href=\"javascript: setCheckboxes('form', false)\">Unselect all</a></form>";
	echo "</center>";
            }
            else
            {
				echo "Invalid PIN or PIN has not enough credits! Join Premium to use this function";
			}
			}
}

?>