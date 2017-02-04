<?php
$usrip = $_SERVER['REMOTE_ADDR'];
$server1="trinity.nswebhost.com/~rapiddow";
$server2="cpanel2.uk2.net/~rapidmuc";
$server3="76.76.13.95/~opticalg";
$i;
	if(!isset($validlogin))
	{
		$validlogin="0";
	}
if($validlogin=="0")
{
		$source = mysql_query("SELECT * FROM downloads WHERE IP='$usrip' and count <= 10") or die(mysql_error());  

		$num_rows = mysql_num_rows($source);
		if ($num_rows > 0) {
				$res1 = mysql_query("SELECT COUNT(Id) FROM historydl where ip='$usrip' and pin='free' and regenerate != '1'") or die("res1: ".mysql_error()); // vraag het AANTAL items op
				$items_totaal = mysql_result($res1, 0); // het totaal aantal items
				mysql_free_result($res1); // geef het resultaat vrij
				
				$items_per_pagina = 30; // vrij te kiezen
				$aantal_paginas =  ceil($items_totaal / $items_per_pagina); // het aantal items per pagina
				
				// de huidige pagina opvragen
				$huidige_pagina = 0; // default
				if(isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] < $aantal_paginas) {
				    $huidige_pagina = $_GET['p'];
				}
				
				// items van de huidige pagina ophalen
				$offset = $huidige_pagina * $items_per_pagina;
					echo "<center>";
					echo "<form action=\"index.php?page=regenerate\" method=\"post\">";
					echo "<table class=\"X3\">";
					echo "<tr>";
				    echo "<th scope=\"col\">File</th>";
				    echo "<th scope=\"col\">Select</th>";
				 	echo "</tr>";
				$res2 = mysql_query("SELECT * FROM historydl where ip='$usrip' and pin='free' and regenerate != '1' ORDER BY Id DESC LIMIT ".$offset.","
				.$items_per_pagina) or die("res2:". mysql_error());
						while($row = mysql_fetch_array( $res2 )) {
							$file = $row['rsurl'];
							$Id = $row['Id'];
							$basefile = basename($file);
							//echo "$file";
							//echo "<br />";
							  if ($Id % 2 == 0) 
							  { 
						        	$oddeven = "evn"; 
							  } 
							  else
							  { 
									$oddeven = "odd";
							  }
							  echo "<tr class=\"$oddeven\">";
				   				 echo "<td>$basefile</td>";
				   				 echo "<td><input name=\"links[]\" type=\"checkbox\" value=\"$Id\" /></td>";
				 			 echo "</tr>";
							}
						echo "</table>";
						echo "<input name=\"submit\" type=\"submit\" value=\"Re-Generate\" /></form>";
					echo "</center><br />";
				
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
				        echo "<a href=\"index.php?page=history&p=".$i."\">".($i+1)."</a>";
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
				$source = mysql_query("SELECT * FROM downloads WHERE IP='$usrip'") or die(mysql_error()); 
				$num_rows = mysql_num_rows($source);
				if ($num_rows > 0) {
				echo "Sorry, but you can only re-generate links when you have less then 10 downloads, get more download slots with the referral system";
				}
				else
				{
					echo "Sorry, but your IP has no records in our database";
				}
			}
}
else
{
		$source = mysql_query("SELECT * FROM users WHERE Id='$userid_session' and credits >0") or die(mysql_error());  

		$num_rows = mysql_num_rows($source);
		if ($num_rows > 0) {
$res1 = mysql_query("SELECT COUNT(Id) FROM historydl where pin='$userid_session' and regenerate != '1'") or die("res1: ".mysql_error()); // vraag het AANTAL items op
$items_totaal = mysql_result($res1, 0); // het totaal aantal items
mysql_free_result($res1); // geef het resultaat vrij

$items_per_pagina = 30; // vrij te kiezen
$aantal_paginas =  ceil($items_totaal / $items_per_pagina); // het aantal items per pagina

// de huidige pagina opvragen
$huidige_pagina = 0; // default
if(isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] < $aantal_paginas) {
    $huidige_pagina = $_GET['p'];
}

// items van de huidige pagina ophalen
$offset = $huidige_pagina * $items_per_pagina;
	echo "<center>";
	echo "<form action=\"index.php?page=regenerate\" method=\"post\">";
	echo "<table>";
	echo "<tr>";
    echo "<th scope=\"col\">File</th>";
    echo "<th scope=\"col\">Select</th>";
 	echo "</tr>";
$res2 = mysql_query("SELECT * FROM historydl where pin='$userid_session' and regenerate != '1' ORDER BY Id DESC LIMIT ".$offset.","
.$items_per_pagina) or die("res2:". mysql_error());
		while($row = mysql_fetch_array( $res2 )) {
			$file = $row['rsurl'];
			$Id = $row['Id'];
			$basefile = basename($file);
			$i++;
			if ($i % 2 == 0) 
			{ 
				$oddeven = "evn"; 
			} 
			else
			{ 
				$oddeven = "odd";
			}
			  echo "<tr class=\"$oddeven\">";
   				 echo "<td>$basefile</td>";
   				 echo "<td><input name=\"links[]\" type=\"checkbox\" value=\"$Id\" /></td>";
 			 echo "</tr>";
			}
		echo "</table>";
		echo "<input name=\"submit\" type=\"submit\" value=\"Re-Generate\" /></form>";
	echo "</center><br />";

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
        echo "<a href=\"index.php?page=history&p=".$i."\">".($i+1)."</a>";
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
	echo "Sorry but this pin is not valid or has no credits! You need at least 1 credit to see your history!";
}
}
?>
