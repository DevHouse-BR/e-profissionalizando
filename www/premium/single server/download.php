<?php
error_reporting(0);
set_time_limit(0);
$mysqlserver = "domain.com/_privatedir/"; 
 

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
			downloadf($rslink,$fsize,$prem); // RESUMABLE DOWNLOADS
		}
		else
		{
			downloadfree($rslink,$fsize,$prem); // NO RESUMABLE DOWNLOADS
		}
		curl_close($curl);
		exit;
	}
	else
	{
		echo "Unknown error";
	}
}

    function downloadf($link,$filesize,$prem)
    {
    	ob_start();
    	// RS Link
        $url = @parse_url($link);
        $filename = basename($link);
        // If the link is empty
        if($link == "")
        {
            @header("HTTP/1.0 404 Not Found");
            echo "File Not Found";
            exit;
        }
        @header("Cache-Control:");
        @header("Cache-Control: public");
        @header("Content-Type: application/octet-stream");
        @header("Content-Disposition: attachment; filename=".$filename);
        @header("Accept-Ranges: bytes");
        if(isset($_SERVER['HTTP_RANGE']))
        {
            list($a, $range)=explode("=",$_SERVER['HTTP_RANGE']);
            list($range1,$range2) = explode("-", $range);
            if ($range2 == '' or $range2 < 0 or $range2 >= $filesize) { 
                $range2 = $filesize -1;
            };
            if ($range1 < 0 or $range1 > $range2) { 
                $range1 = 0;
            }
            $new_length = $range2 - $range1 + 1;
            @header("HTTP/1.1 206 Partial Content");
            @header("Content-Range: bytes $range1-$range2/$filesize");
            @header("Content-Length: $new_length");
        }
        else
        {
            @header("Content-Length: ".$filesize);
        }
        $vars = "dl.start=PREMIUM&uri={$url['path']}&directstart=1";
        $head = "Host: {$url['host']}\r\n";
        $head .= "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)\r\n";
        $head .= "Cookie: user={$prem}\r\n";
        $head .= "Content-Type: application/x-www-form-urlencoded\r\n";
        if($range1 != "") $head .= "Range: bytes={$range1}-{$range2}\r\n";
        $head .= "Content-Length: ".strlen($vars)."\r\n";
        $head .= "Connection: close\r\n\r\n";
        $fp = @fsockopen($url['host'], 80, $errno, $errstr);
        	$curl = curl_init();
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_HEADER, 1);
			//curl_setopt($curl, CURLOPT_POST, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; nl; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14");
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
			curl_setopt($curl, CURLOPT_URL, "http://rapidshare.com");
	        $datacurl = curl_exec($curl);
	        if (curl_errno($curl)) {
	        	curl_close($curl);
	            echo "Sory, server could not connect to rapidshare.com";
	            exit;
	        }
      
        @stream_set_timeout($fp, 300);
        fputs($fp, "POST {$url['path']}  HTTP/1.1\r\n");
        fputs($fp, $head.$vars);
        fflush($fp);
        $buff = 256;
        while (!feof($fp))
        {
            $data = fgets($fp, $buff);
            if($headerdone)
            {
                print $data;;
            }
            if(!$headerdone)
            {
                $tmp .= $data;
                $d = explode("\r\n\r\n", $tmp);
                if($d[1])
                {
                    print $d[1];
                    $headerdone = true;
                    $buff = 2048;
                }
            }
            flush();
            ob_flush();
        }
        @fclose($fp);
        exit;
    }
        function downloadfree($link,$filesize,$prem)
    {
    	ob_start();
    	// RS Link
        $url = @parse_url($link);
        $filename = basename($link);
        // If the link is empty
        if($link == "")
        {
            @header("HTTP/1.0 404 Not Found");
            echo "File Not Found";
            exit;
        }
        @header("Content-Type: application/octet-stream");
        @header("Content-Disposition: attachment; filename=".$filename);
        @header("Content-Length: ".$filesize);
        $vars = "dl.start=PREMIUM&uri={$url['path']}&directstart=1";
        $head = "Host: {$url['host']}\r\n";
        $head .= "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)\r\n";
        $head .= "Cookie: user={$prem}\r\n";
        $head .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $head .= "Content-Length: ".strlen($vars)."\r\n";
        $head .= "Connection: close\r\n\r\n";
        $fp = @fsockopen($url['host'], 80, $errno, $errstr);
        	$curl = curl_init();
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_HEADER, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; nl; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14");
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
			curl_setopt($curl, CURLOPT_URL, "http://rapidshare.com");
	        $datacurl = curl_exec($curl);
	        if (curl_errno($curl)) {
	        	curl_close($curl);
				echo "Sory, server could not connect to rapidshare.com";
	            exit;
	        }
        @stream_set_timeout($fp, 300);
        fputs($fp, "POST {$url['path']}  HTTP/1.1\r\n");
        fputs($fp, $head.$vars);
        fflush($fp);
        $buff = 256;
        while (!feof($fp))
        {
            $data = fgets($fp, $buff);
            if($headerdone)
            {
                print $data;;
            }
            if(!$headerdone)
            {
                $tmp .= $data;
                $d = explode("\r\n\r\n", $tmp);
                if($d[1])
                {
                    print $d[1];
                    $headerdone = true;
                    $buff = 2048;
                }
            }
            flush();
            ob_flush();
        }
        @fclose($fp);
        exit;
    }
?>