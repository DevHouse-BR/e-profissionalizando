<?php include_once("config.inc.php"); ?>
<html>
	<head>		
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<META HTTP-EQUIV="Expires" CONTENT="Fri, Jun 12 1981 08:20:00 GMT"> 
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache"> 
		<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache"> 
		
    

    <title>Bandwidth Speed Test</title>
	</head>



<body>


    
        
                
                <h2 class="nomb" align="center">Teste em progresso</h2>
                                
                <!-- 2 same width columns (50%/50%) -->
                <div class="box">                                      
				<br><br><br><br><br><br>
                        <div style="visibility:visible" top="100" id="inprogress" align="center">
				                	   <br><br><img id="inprogress_img" src="images/processing.gif">
                        			</div>

                        
               
                    
    
            
				<script>
<!--
	time      = new Date();
	starttime = time.getTime();
// -->
</script>

<?php

	$data_file = "payload.bin";
	$fd = fopen ($data_file, "rb");
	if (isset($_GET['kbps'])) {
		$test_kbytes = ($_GET['kbps'] / 8) * 10;  //set the download to take 10 seconds
		if ($test_kbytes > 3000) {
			$test_kbytes = 3000;
		}
	} else {
		$test_kbytes = $default_kbyte_test_size;
	}
	
	$contents = fread ($fd, $test_kbytes * 1024);
		
	echo "<!-- $contents -->";
	fclose ($fd);

?>

<script>
<!--
	time          = new Date();
	endtime       = time.getTime();
	if (endtime == starttime)
		{downloadtime = 0
		}
	else
	{downloadtime = (endtime - starttime)/1000;
	}

	kbytes_of_data = <?php echo $test_kbytes; ?>;
	linespeed     = kbytes_of_data/downloadtime;
	kbps          = (Math.round((linespeed*8)*10*1.024))/10;

	<?php
			$nexturl = "results.php?kbps=' + kbps + '&downloadtime=' + downloadtime + '&KB=' + kbytes_of_data + '&recorded=1";
	?>

	nextpage='<?php echo $nexturl; ?>';
	document.location.href=nextpage
// -->
</script>


</body>
</html>
