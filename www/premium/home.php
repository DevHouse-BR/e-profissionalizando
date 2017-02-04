		<center>Use the form below to download your file from Rapidshare.com. <a href="?page=multidl">Multiple file downloader tool here</a>.<br><br>
<br />

		<br style="line-height: 6px;">
		<table style="border: 1px solid rgb(204, 204, 204);" cellpadding="10" cellspacing="0" width="100%">
			<form method="post" action="index.php">
				<tbody><tr>
					<td bgcolor="#eaeaea" valign="top" width="100%">
					<b>Enter rapidshare.com Link:</b>
					<input name="link" style="width: 435px;" type="text" value="<?php if (isset($_POST['link'])) {echo($_POST['link']);} else {echo('');} ?>"><br><br style="line-height: 6px;"><br />
					<?php if ($type != "premium" && $usedownloadkey == "1")
					{
						?>Now a downloadkey is needed to download your files. This is the only thing we ask you to do (but also keep supporting our site in all the other ways).<br /><br />
						
					<b>Enter DownloadKey (FREE users) - Expires every day at 00.00 GMT +1<br />
					<?php
						$source = mysql_query("select * from downloadkey where active='1'");
							while($row = mysql_fetch_array( $source )) {
									$urlcode = $row['URL'];
									$code = $row['code'];
								}
								?><a href="<?php echo $urlcode; ?>" target="_blank"> --> DOWNLOAD DOWNLOADKEY FROM RAPIDSHARE (1MB): <--</a></b>
					<input name="downloadkey" style="width: 435px;" type="text" value="<?php if (isset($_POST['downloadkey'])) {echo($_POST['downloadkey']);} else {echo('');} ?>"><br><br style="line-height: 6px;">
						<?php
					}
					else
					{
					}
					?>
					
					<br style="line-height: 4px;">
					<input name="submit" value="download file" type="submit"> or use the <a href="?page=multidl">Multiple File Downloader Tool</a>.
					</td>
				</tr>
			<?php
			$filenameshow = basename($linkfiltered);
			?>
		</tbody></form></table><br /><?php if($result=="") {} else { ?> Your File: <?php echo "<b>$filenameshow</b>"; ?> (<?php echo $filesize; ?>) <?php } ?><br />
		<?php echo $result; ?><br />
</center>