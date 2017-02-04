<?php
$sitename = "rapidshare-premium";
$domain = "rapidshare-premium.com";
$emailsite = "noreply@rapidshare-premium.com";
$van_naam = "rapidshare-premium.com";
$van_email = "noreply@rapidshare-premium.com";
ob_start();
include "core.php";
if (!empty($_GET['visit']))
{
	$ad = $_GET['visit'];
	$source = mysql_query("SELECT * FROM ads WHERE aID='$ad'") or die(mysql_error());  
	$num_rows = mysql_num_rows($source);
	if ($num_rows < 1) {
		echo "Sorry, ad id not found in database";
		mysql_close($link);
		}
		else
		{
			$source = mysql_query("SELECT * FROM ads where aID='$ad'") or die(mysql_error());  
			while($row = mysql_fetch_array( $source )) {
				$type = $row['type'];
			}
			if($type == "tradedoubler")
			{
				$source = mysql_query("SELECT * FROM extradl where adId='$ad' and IP='$usrip'") or die(mysql_error());  
				$num_rows = mysql_num_rows($source);
					if ($num_rows >= 1) {
						mysql_close($conn);
						echo "Sorry, but you already clicked this ad today. Click again tomorrow";
						}
						else
						{
				$source = mysql_query("SELECT * FROM ads WHERE aID='$ad'") or die(mysql_error());  
				while($row = mysql_fetch_array( $source )) {
				$link = $row['link'];
						}
				mysql_query("INSERT INTO extradl (`adId`, `IP`,`click`) VALUES ('" . $ad . "', '".$usrip."', '1');") or die(mysql_error()); 
				mysql_query("update ads set visits = visits+1 WHERE aID='$ad'") or die(mysql_error()); 
				mysql_query("UPDATE lastdownloads SET extradl = extradl + 1");
				mysql_close($conn);
				@header("location:$link");
				}
			}
			else
			{
				$source = mysql_query("SELECT * FROM ads WHERE aID='$ad'") or die(mysql_error());  
				while($row = mysql_fetch_array( $source )) {
				$link = $row['link'];
						}
				mysql_query("INSERT INTO extradl (`adId`, `IP`,`click`) VALUES ('" . $ad . "', '".$usrip."', '1');") or die(mysql_error()); 
				mysql_query("update ads set visits = visits+1 WHERE aID='$ad'") or die(mysql_error()); 
				mysql_query("UPDATE lastdownloads SET extradl = extradl + 1");
				mysql_close($conn);
				@header("location:$link");
			}
		}
}
else
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head><title>Rapidshare-Premium.com - FREE Rapidshare Premium Link Generator</title>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="description" content="Rapidshare-Premium.com, Rapidshare-Premium, rapidshare premiumRapidDownloader, a Free rapidshare premium link generator since 2007. Rapidshare-Premium uses a realtime generator, live links are created. Premium packs and free packs are available. It's usefull for people without a rapidshare premium account">
	<meta name="keywords" content="rapidshare, rapidshare premium link generator, free rapidshare, rapidshare premium, rapidshare account, rapidshare download, movies, games, music, applications, free download, rapidshare premium downloader, rapidshare real time link generator">
	<meta name="distribution" content="global">
    <link rel="stylesheet" href="images/styles.css" type="text/css">

	</head><div id="loading" style="position:absolute;font-family:arial,sans-serif;background:#0070EA;color:white;font-size:12px;top:0;right:0;">Premium Users - Please register an account, and add your pin after you have logged in to the "Add credits" page</div><body style="margin: 5px 0px 0px; background-image: url(images/page-bg.jpg); background-repeat: repeat-x;" bgcolor="#ffffff">
<table class="mainbg" align="center" cellpadding="0" cellspacing="0" width="760">
<tbody><tr>
  <td style="background-image: url(images/top-bg-main.jpg); background-repeat: repeat-x;" valign="top" width="10"><img src="images/top-left-main.jpg" height="10" width="10"></td>
  <td style="background-image: url(images/top-bg-main.jpg); background-repeat: repeat-x;" valign="top">
    <table cellpadding="0" cellspacing="0" width="100%">
	<tbody><tr>
    <td><a href="index.php"><img src="images/main-logo.jpg" alt="RapidDownloader Logo" border="0" height="79" width="340"></a></td>
	<td style="color: rgb(255, 255, 255);" align="right" valign="top"><br>
	<?php include "login3.php" ?></td>
	</tr>
	</tbody></table>
	
  </td>
  <td style="background-image: url(images/top-bg-main.jpg); background-repeat: repeat-x;" align="right" valign="top"><img src="images/top-right-main.jpg" height="10" width="10"></td>
</tr>

<tr>
  <td colspan="3" valign="top">
    <table align="center" cellpadding="0" cellspacing="0" width="749">
	  <tbody><tr>
        <td valign="top"><img src="images/sub-top.jpg" height="6" width="749"></td>
	  </tr>
	  <tr>
	    <td class="altbg" style="background-image: url(images/dashed-line.jpg); background-repeat: repeat-x; background-position: center bottom;" align="left" valign="top"><br>
		  <table cellpadding="0" cellspacing="0">
		    <tbody><tr>
			<td style="background-image: url(images/dashed-line.jpg); background-repeat: repeat-x; background-position: center bottom;" width="13">&nbsp;</td>
			<td><table cellpadding="0" cellspacing="0"><tbody><tr>
			<td><img src="images/tab-left-on.jpg" height="40" width="7"></td>
			<td style="background-image: url(images/tab-mid-on.jpg); background-repeat: repeat-x;" class="headerfont">&nbsp;&nbsp;<a href="index.php" class="headera">home</a>&nbsp;&nbsp;</td>
			<td><img src="images/tab-right-on.jpg" height="40" width="6"></td>
			</tr></tbody></table></td><td><table cellpadding="0" cellspacing="0"><tbody><tr>
			<td><img src="images/tab-left-off.jpg" height="40" width="7"></td>
			<td style="background-image: url(images/tab-mid-off.jpg); background-repeat: repeat-x;" class="headerfont">&nbsp;&nbsp;<a href="?page=faq" class="headera">faq</a>&nbsp;&nbsp;</td>
			<td><img src="images/tab-right-off.jpg" height="40" width="6"></td>
			</tr></tbody></table></td><td><table cellpadding="0" cellspacing="0"><tbody><tr>
			<td><img src="images/tab-left-off.jpg" height="40" width="7"></td>
			<td style="background-image: url(images/tab-mid-off.jpg); background-repeat: repeat-x;" class="headerfont">&nbsp;&nbsp;<a href="http://www.rapiddownloader.org/forum" class="headera">forums</a>&nbsp;&nbsp;</td>
			<td><img src="images/tab-right-off.jpg" height="40" width="6"></td>
			</tr></tbody></table></td><td><table cellpadding="0" cellspacing="0"><tbody><tr>
			<td><img src="images/tab-left-off.jpg" height="40" width="7"></td>
			<td style="background-image: url(images/tab-mid-off.jpg); background-repeat: repeat-x;" class="headerfont">&nbsp;&nbsp;<a href="?page=join" class="headera">join premium</a>&nbsp;&nbsp;</td>
			<td><img src="images/tab-right-off.jpg" height="40" width="6"></td>
			</tr></tbody></table></td><td><table cellpadding="0" cellspacing="0"><tbody><tr>
			<td><img src="images/tab-left-off.jpg" height="40" width="7"></td>
			<td style="background-image: url(images/tab-mid-off.jpg); background-repeat: repeat-x;" class="headerfont">&nbsp;&nbsp;<a href="?page=premium" class="headera">premium</a>&nbsp;&nbsp;</td>
			<td><img src="images/tab-right-off.jpg" height="40" width="6"></td>
			</tr></tbody></table></td><td><table cellpadding="0" cellspacing="0"><tbody><tr>
			<td><img src="images/tab-left-off.jpg" height="40" width="7"></td>
			<td style="background-image: url(images/tab-mid-off.jpg); background-repeat: repeat-x;" class="headerfont">&nbsp;&nbsp;<a href="?page=contact" class="headera"><u>contact us</u></a>&nbsp;&nbsp;</td>
			<td><img src="images/tab-right-off.jpg" height="40" width="6"></td>
			</tr></tbody></table></td><?php if($type == "premium"){ ?><td><table cellpadding="0" cellspacing="0"><tbody><tr>
			<td><img src="images/tab-left-off.jpg" height="40" width="7"></td>
			<td style="background-image: url(images/tab-mid-off.jpg); background-repeat: repeat-x;" class="headerfont">&nbsp;&nbsp;<a href="?page=search"  class="headera">search</a>&nbsp;&nbsp;</td>
			<td><img src="images/tab-right-off.jpg" height="40" width="6"></td>
			</tr></tbody></table></td> <?php }else {} ?><td><table cellpadding="0" cellspacing="0"><tbody><tr>
			<td><img src="images/tab-left-off.jpg" height="40" width="7"></td>
			<td style="background-image: url(images/tab-mid-off.jpg); background-repeat: repeat-x;" class="headerfont">&nbsp;&nbsp;<a href="http://www.rapidsharetools.net" target="_blank" class="headera"><i>blog</i></a>&nbsp;&nbsp;</td>
			<td><img src="images/tab-right-off.jpg" height="40" width="6"></td>
			</tr></tbody></table></td>			<td width="1"><img src="images/tab-end.jpg" height="40" width="1"></td>
			<td>&nbsp;</td>
			</tr>
		  </tbody></table>
		</td>
	  </tr>
	  <tr>
	    <td bgcolor="#ffffff" height="300" valign="top">

		  <table cellpadding="3" cellspacing="0" width="100%">
		    <tbody><tr>
			  <td>


<table cellpadding="0" cellspacing="0" width="100%">
	<tbody><tr>
		<td style="padding: 10px;" valign="top" width="80%">
		<?php
		if($type == "premium")
		{
			?>
			<div align="center"><table class="head"><tr><td>You are a PREMIUM downloader</td><td><a href="?page=accountstatus">RS Accountstatus</a></td><td><a href="?page=ref">Referral Link</a></td></tr><tr><td><a href="?page=history">Generated History</a></td><td><a href="?page=multidl">MultiDL</a></td><td><a href="?page=network">Network Status</a></td></tr></table><br /><?php include "poll.php"; ?><br /></div>
			<?php
		}
		else
		{
			?>
			<div align="center"><?php //echo $paypopup; ?><table class="head"><tr><td>You are a FREE downloader</td><td>Your limit: <?php echo $countdl; ?>/10</td><td>Global: <?php echo $lastdl; ?> / <?php echo $limittot; ?> - <a href="?page=ads">Raise limit</a></td></tr><tr><td><a href="?page=history">Generated History</a></td><td><a href="?page=ref">Referral Link</a></td><td><a href="?page=join">Want more? Join PREMIUM</a></td></tr></table></div><br />
<center><a href="?page=join"><img src="images/premium_join.png" border="0" alt="Premium" /></a></center>
<?php
		}
		?>
<?php
$sExpressie = "(http:|ftp:|shttp:|www.|.php|.pl|.cgi|.asp|index.php|index)"; 
if(isset($_GET['page']))
    {
    if(eregi($sExpressie,$_GET['page']))
        { echo '<p> </p>'; }
    else
        {
        if(file_exists($_GET['page'].'.php'))
            { include $_GET['page'].'.php'; }
        else
            { echo '<p>Page does not exist</p>'; }
        }
    }
if(!isset($_GET['page']))
{
	include "home.php";
}
?>
<?php
if($type != "premium")
{
	?><br /><br /><hr>
<center>Ads here
</center>
	<?php
}
else
{
	
}
?>
  <center>Stats</center>

		</td>
		<td align="right" valign="top" width="20%">
		<img src="images/payment.jpg" alt="payment" /><br />

Banner here
		</td>
	</tr>
</tbody></table>


              </td>
            </tr>
		  </tbody></table>
	    </td>
      </tr>
      <tr>
	    <td style="background-image: url(images/dashed-line.jpg); background-repeat: repeat-x;" height="1" valign="top"><img src="images/dashed-line.jpg" height="1" width="4"></td>
	  </tr>
	  <tr>
	    <td class="altbg" valign="top">
		  &nbsp;<br>&nbsp;
		</td>
	  </tr>
	  <tr>
        <td valign="top"><img src="images/sub-bottom.jpg" height="6" width="749"></td>
	  </tr>
</tbody></table>
    </td>
  </tr>
  
<tr>
  <td height="60" valign="bottom" width="10"><img src="images/bottom-left-main.jpg" height="10" width="10"></td>
  <td class="small" align="center">Copyright © 2008 <a href="index.php" class="smalla">RapidDownloader</a> - Developed by <a href="http://www.rapidsharetools.net/" class="smalla">RapidshareTools</a> - We are in no way affiliated with rapidshare.com<br />We stream files through our servers, we do not save any files to our harddisk - <a href="?page=tos" class="smalla">Terms Of Service</a></td>
  <td align="right" valign="bottom"><img src="images/bottom-right-main.jpg" height="10" width="10"></td>
</tr>
</tbody></table></body></html>
<?php
mysql_close($mysql);
}
?>