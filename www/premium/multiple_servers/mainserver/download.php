<?php
error_reporting(0);
set_time_limit(0);
$mysqlserver = "domain.com/_privatedir/";
$downloadserverdomain = "domain.com";

 	function get_value_from_code( $before, $after, $code)
	{
		$match = '#'.$before.'(.+?)'.$after.'#';
		if( preg_match( $match, $code, $match))
		{
			return $match[1];
		}
		return false;
	}
$id = $_GET['id'];
$usrip = $_SERVER['REMOTE_ADDR'];

$exec=$_GET['exec'];

if($exec=="testrs")
{
        $fp = @fsockopen("rapidshare.com", 80, $errno, $errstr, 10);
        if (!$fp)
        {
			echo "fail";
        }
        else
        {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_HEADER, 1);
			//curl_setopt($curl, CURLOPT_POST, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; nl; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14");
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
			curl_setopt($curl, CURLOPT_URL, "http://rapidshare.com");
	        $data = curl_exec($curl);
	        if (curl_errno($curl)) {
	            echo "fail curl";
	            curl_close($curl);
	        } else {
	            echo "connected";
	            curl_close($curl);
	        }
	}
}

if($exec == "errorreport")
{
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors','On');
}

if($id == "")
{
	echo "Empty ID";
}
else
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_HEADER, 1);
	//curl_setopt($curl, CURLOPT_POST, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_TIMEOUT, 20);
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
	curl_setopt($curl, CURLOPT_URL, "http://$mysqlserver/get_file_info.php?id=$id&usrip=$usrip");
	$xxx = curl_exec($curl);
	$check1 = explode('Invalid session',$xxx);
	if (isset($check1[1])) {
		echo "Invalid session";
		curl_close($curl);
		exit;
		}
	$check2 = explode('Empty ID',$xxx);
	if (isset($check2[1])) {
		echo "Empty ID";
		curl_close($curl);
		exit;
		}
	$check3 = explode('Not allowed to see this page from here',$xxx);
	if (isset($check3[1])) {
		echo "Download server error";
		curl_close($curl);
		exit;
	}
	$check4 = explode('rapidshare',$xxx);
	if (isset($check4[1])) {
		$rslink = get_value_from_code('rsurl:','<br />filesize:', $xxx);
		$filesize = get_value_from_code('filesize:','<br />premium:', $xxx);
		$prem = get_value_from_code('premium:','<br />type:', $xxx);
		$type = get_value_from_code('type:','<br />end', $xxx);
		$fsize = str_replace (" ", "", "$filesize");
		$mirrors = get_value_from_code('startmirrors','endmirrors', $xxx);
		if($type == "premium")
		{
				curl_close($curl);
				$hosts = explode('%%', $mirrors);
				$rand_host = array_rand($hosts, 2);
				$newmirror = $hosts[$rand_host[0]];
				$aantalhosts = count($hosts);
				if($aantalhosts == "0")
				{
					echo "Sorry, no available mirrors to download from";
					exit;
				}
		        $redirectid = $_GET['id'];
				@Header( "HTTP/1.1 301 Moved Permanently" );
				@Header( "Location: http://$newmirror.$domain/download.php?id=$redirectid" );
	            exit;
		}
		else
		{
				curl_close($curl);
				$hosts = explode('%%', $mirrors);
				$rand_host = array_rand($hosts, 2);
				$newmirror = $hosts[$rand_host[0]];
				if($aantalhosts == "0")
				{
					echo "Sorry, no available mirrors to download from";
					exit;
				}
		        $redirectid = $_GET['id'];
				@Header( "HTTP/1.1 301 Moved Permanently" );
				@Header( "Location: http://$newmirror.$domain/download.php?id=$redirectid" );
	            exit;
		}
		curl_close($curl);
		exit;
	}
	else
	{
		echo "Unknown error (Rapidshare accounts out of usage)";
	}
}
?>