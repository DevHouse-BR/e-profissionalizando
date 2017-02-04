<?php

/**
 * @author Klaas Vanaudenaerde
 * @copyright 2008
 */
 
 	function get_value_from_code( $before, $after, $code)
	{
		$match = '#'.$before.'(.+?)'.$after.'#';
		if( preg_match( $match, $code, $match))
		{
			return $match[1];
		}
		return false;
	}
	function getfiletype($rapidsharelink)
	{
			if (substr($rapidsharelink,-4) == ".rar")
			{
		    	return "rar";
			}
			else if (substr($rapidsharelink,-4) == ".avi" || substr($rapidsharelink,-4) == ".AVI")
			{
		    	return "wmv";
			}
			else if (substr($rapidsharelink,-4) == ".zip")
			{
		    	return "zip";
			}
			else if (substr($rapidsharelink,-4) == ".wmv")
			{
		    	return "wmv";
			}
			else if (substr($rapidsharelink,-4) == ".mpg")
			{
		    	return "wmv";
			}
			else if (substr($rapidsharelink,-4) == ".flv")
			{
		    	return "flv";
			}
			else if (substr($rapidsharelink,-4) == ".exe")
			{
		    	return "exe";
			}
			else
			{
				return "unkown";
			}
	}
	function afkorten($var, $lengte) {
		$ret = $var;
		if (strlen($ret) > $lengte) {
		$ret = substr($ret, 0, $lengte-3)."...";
		}
		return $ret;
	}
	
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
$zoekterm = $_POST["zoekterm"];

if(empty($zoekterm))
{
	?>
		Here you can search in files that our users (FREE and PREMIUM users have generated), you can not see who generated them.<br /><br />
	<center><form class="login" action="?page=search" method="post"><input name="zoekterm" type="text" value="" onFocus="clearDefault(this)" />&nbsp;<input type="submit" value="Search"></form></center>
	<?php
}
else
{
	$blacklist = array("rapidshare", "rapid share","rapids hare", "rapi dshare", "http", "http://", "www", "html", ".html", "share", "rapid",".com","files");
	$totaalblacklist = count($blacklist);
	$i = 0;
	/*if($zoekterm == "rapidshare" || $zoekterm == "rapid share" || $zoekterm == "rapids hare" || $zoekterm == "rapi dshare")
	{
		echo "Sorry, blacklisted word";
	}
	else
	{*/
$replace = str_replace(" ","%",$zoekterm);
$zoektermfinal = "%";
$zoektermfinal .= $replace;
$zoektermfinal .= "%";

/*$i=0;
while($i<=$aantalzoektermen)
{
	$zoekresult .= "%";
	$zoekresult .= $zoektermarray[$i];
	$zoekresult .= "%";
	$i++;
}

	if (substr($zoekresult,-2) == "%%")
	{
    $zoekresult = substr($zoekresult,0,-1);
	}
	//echo $zoekresult;*/
$source = mysql_query("select distinct rsurl, size from historydl where rsurl LIKE 'http://%.rapidshare.com/files/%/$zoektermfinal'");
		$num_rows = mysql_num_rows($source);
		if ($num_rows > 0) {
mysql_query("insert into search (searchtext, time) VALUES('$zoekterm','$time_generated') ") or die(mysql_error());
echo "<center><b>$num_rows</b> files found</center><br /><br />";
notice("These files may have passwords, downloading these files is at own risk. You can search for the files on google. - Rightclick on the link and copy the link.");
echo "<br />";
$i=0;
$res1 = mysql_query("select distinct rsurl, size from historydl where rsurl LIKE 'http://%.rapidshare.com/files/%/$zoektermfinal'") or die("res1: ".mysql_error()); // vraag het AANTAL items op
$items_totaal = mysql_result($res1, 0); // het totaal aantal items
mysql_free_result($res1); // geef het resultaat vrij

$items_per_pagina = 400; // vrij te kiezen
$aantal_paginas =  ceil($items_totaal / $items_per_pagina); // het aantal items per pagina

// de huidige pagina opvragen
$huidige_pagina = 0; // default
if(isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] < $aantal_paginas) {
    $huidige_pagina = $_GET['p'];
}

// items van de huidige pagina ophalen
$offset = $huidige_pagina * $items_per_pagina;
$res2 = mysql_query("select distinct rsurl, size from historydl where rsurl LIKE 'http://%.rapidshare.com/files/%/$zoektermfinal' ORDER BY Id DESC LIMIT ".$offset.",".$items_per_pagina) or die("res2:". mysql_error());
		while($row = mysql_fetch_array( $res2 )) {
								$rapidsharelink = $row['rsurl'];
								$filesizesearch = $row['size'];
								$server = get_value_from_code("http://","rapidshare",$rapidsharelink);
								$rapidsharecutlink = str_replace($server,"",$rapidsharelink);
								//echo $rapidsharecutlink;
								$rapidsharebasename = basename($rapidsharecutlink);
								$filetype = getfiletype($rapidsharecutlink);
								$rapidsharekortlink = afkorten($rapidsharebasename, "75");
								$mbsearch = $filesizesearch/1000000;
								$bmbsearch = round($mbsearch,0);
			$i++;
			if ($i % 2 == 0) 
			{ 
				$oddeven = "evn"; 
			} 
			else
			{ 
				$oddeven = "odd";
			}
			?>
				<table><tr class="<?php echo $oddeven; ?>"><td width="22"><img src="images/filetype/<?php echo $filetype; ?>.gif"></td><td>
<a href="<?php echo $rapidsharecutlink; ?>"><b><?php echo $rapidsharekortlink; ?></b></a><br /><font color="#969696"><b>Size</b> <?php echo $mbsearch; ?> MB</font>

</td></tr></table><br />
<?php
			}
			echo "<br />";

/*
doe hier iets met de gegevens in $res2
...
*/

// resultaten vrijgeven
mysql_free_result($res2);


// navigatie
echo "<center>";
for($i = 0; $i < $aantal_paginas; $i++) {
    if($huidige_pagina == $i) {
        // huidige pagina is niet klikbaar
        echo "<b>".($i+1)."</b>";
    } else {
        // een andere pagina dan de huidige is wel klikbaar
        echo "<a href=\"index.php?page=search&p=".$i."\">".($i+1)."</a>";
    }
   // deel-streepje tussen alle items
    if($i < $aantal_paginas - 1) {
        echo " - ";
    }
}
echo "</center>";
}
else
{
	notice("No results");
}
}
}
?>