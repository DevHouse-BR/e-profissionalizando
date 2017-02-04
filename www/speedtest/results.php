<?php include_once("config.inc.php"); ?>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <!-- This website template was downloaded from http://www.nuviotemplates.com - visit us for more templates -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="en" />
    <meta name="robots" content="all,follow" />

    <meta name="author" lang="en" content="All: Your website name [www.your-website.com]; e-mail: info@your-website.com" />
    <meta name="copyright" lang="en" content="webdesign: Vit Dlouhy [Nuvio - www.nuvio.cz; NuvioTemplates - www.nuviotemplates.com]; e-mail: hello@nuviotemplates.com" />

    <meta name="description" content="..." />
    <meta name="keywords" content="..." />
    
    

    <title>Teste de Velocidade</title>
</head>

<body>


        
                
                <h2 class="nomb" align="center">Resultados</h2>
				<div align="center">
					<table border="0" width="60%">
						<tr>
							<td>Para um resultado mais preciso, feche todo e 
							qualquer programa que consuma internet, assim como 
							todas as outras páginas da internet, e clique em 
							testar novamente.</td>
						</tr>
					</table>
				</div>
                                
             
                <div class="box">                                      

                      <?php 
	$kbps = round($_GET['kbps'], 2);
	$ksec = round($kbps / 8, 2);
	$mbps = round($kbps / 1024, 2);
	$msec = round($mbps / 8, 2);
?>
<center>
<br><br><font size=+1>Sua velocidade atual é:</font>&nbsp;
<font size=+1 color=green>

<?php
   if ($mbps > 1) {
		printf ("%.2f",$mbps); 	
      echo " Mbps<br>";
   } else {
		printf ("%.2f",$kbps); 	
      echo "Kbps<br>";
   }
?>
</font>
<?php
   if ($msec > 1) {
      echo "<font size=+1>Sua velocidade de download é <font color=green>" . $msec . " MB/sec </font> dos seus servidores.</font>";
   } else {
      echo "<font size=+1>Sua velocidade de download é <font color=green>" . $ksec . " KB/sec </font>dos seus servidores.</font>";
   }
?>

<br><br>

<table bgcolor=#FFA500 cellspacing=0 cellpadding=1 border=0><tr><td>

<table bgcolor=#ffffff cellspacing=5 cellpadding=0 border=0>

<?php

$service_speeds = array();

foreach(array_keys($services) as $service) {
	array_push ($service_speeds, $service);
}

$max_in_array = max ($service_speeds);

if ($kbps > $max_in_array) {
	$bar_scale = 400/$kbps;
} else {
	$bar_scale = 0.267;
}

foreach(array_keys($services) as $service) {

	if (($service > $kbps) && $you_out == False) {
		$bar_size = $kbps * $bar_scale;
		$you_bar_height = $bar_height + 5;
		echo "<tr>\n";
		echo "<td align=left><b>$kbps kbps</b></td>\n";
		echo "<td align=center><b>Você</b></td>\n";
		echo "<td align=left><img src=images/$user_graph_image
			height=$you_bar_height width=$bar_size></td>"; 
		echo "</tr>\n";
		$you_out = True;
	}


	$name = $services[$service]["name"];
	$image = $services[$service]["image"];
	$bar_size = $service * $bar_scale;

	echo "<tr>\n";
	echo "<td align=left>$service kbps</td>\n";
	echo "<td align=center>$name</td>\n";
	echo "<td align=left><img src=images/$image height=$bar_height
		width=$bar_size></td>"; 
	echo "</tr>\n";

}

	if ($you_out == False) {
			$bar_size = $kbps * $bar_scale;
		$you_bar_height = $bar_height + 5;
		echo "<tr>\n";
		echo "<td align=left><b>$kbps kbps</b></td>\n";
		echo "<td align=center><b>Você</b></td>\n";
		echo "<td align=left><img src=images/$user_graph_image
			height=$you_bar_height width=$bar_size></td>"; 
		echo "</tr>\n";
	}

?>

</table>

</table>

<font size=+0>
<br><br>

<input type="submit" value="Testar novamente" onClick="location.href='test.php'" class="button" /><br>
</font>

</body>
</html>

<?php

if ($mysql == True) {
	$link = mysql_connect($database["host"], $database["login"],
		$database["password"])
    	or die("Could not connect");
	mysql_select_db($database["database"])
    	or die("Could not select database");

	$ip = $_SERVER['REMOTE_ADDR'];
	$name = gethostbyaddr($ip);
	$query = "INSERT INTO readings (speed, ip, name) VALUES ($kbps, '$REMOTE_ADDR', '$name')";
	$result = mysql_query($query)
    	or die("Query failed");
}

?>
 
                        
                
                </div> <!-- /box -->    

            </div> <!-- /content -->

            
                
    
            </div> <!-- /aside -->
        
        </div> <!-- /cols -->

        



    </div> <!-- /main-in -->
    
</div> <!-- /main -->

</body>
</html>