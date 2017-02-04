<?php

/**
 * @author Klaas Vanaudenaerde
 * @copyright 2008
 */

	include "db.php";
		function getserver($link)
	{
        $url = @parse_url($link);
        $fp = @fsockopen($url['host'], 80, $errno, $errstr);
        if (!$fp)
        {
        	$basename = basename($link);
            $errormsg = "$basename : Error: <b>$errstr</b>, please try again.";
            echo $errormsg;
            exit;
        }
        $out = "GET {$url['path']} HTTP/1.1\r\n";
        $out .= "Host: {$url['host']}\r\n";
        $out .= "Connection: Close\r\n\r\n";
        fwrite($fp, $out);
        unset($string);
        while (!feof($fp))
        {
            $string .= fgets($fp, 128);
        }
        @fclose($fp);
        preg_match( "#<form action=\"(.+?)\" method=\"post\">#", $string, $serv );
        if($serv[1])
        {
            return $serv[1];
        }
        else
        {
            preg_match("#<b><!--#", $string, $er);
            $basename = basename($link);
            $errormsg = $er[1] != "" ? $er[1] : "$basename : File not found";
            echo $errormsg;
            exit;
        }
	}
	function getFileInfo($link)
	{
		$type = "free";
    	$conn = mysql_connect(mysql_host, mysql_user, mysql_password) or die(mysql_error());
		mysql_select_db(mysql_db) or die(mysql_error());
		$source = mysql_query("SELECT * FROM band WHERE disabled != 'expired' and disabled != 'bandwidth' and disabled != 'unknown' and disabled != 'incorrect' ORDER BY RAND() LIMIT 0,1") or die(mysql_error()); 
		while($row = mysql_fetch_array( $source )) {
		$prem=$row['prem'];
		}
		
        $url = parse_url($link);
        $vars = "dl.start=PREMIUM&uri={$url['path']}&directstart=1";
        $head = "Host: {$url['host']}\r\n";
        $head .= "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)\r\n";
        $head .= "Cookie: user={$prem}\r\n";
        $head .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $head .= "Content-Length: ".strlen($vars)."\r\n";
        $head .= "Connection: close\r\n\r\n";
        $fp = @fsockopen($url['host'], 80, $errno, $errstr);
        if (!$fp)
        {
            echo "The script says <b>$errstr</b>, please try again later.";
            exit;
        }
        fputs($fp, "POST {$url['path']}  HTTP/1.1\r\n");
        fputs($fp, $head.$vars);
        $buff = 64;
        while (!feof($fp))
        {
            $tmp .= fgets($fp, $buff);
            $d = explode("\r\n\r\n", $tmp);
            if($d[1])
            {
                preg_match("#filename=(.+?)\n#", $tmp, $fname);
                preg_match("#Content-Length: (.+?)\n#", $tmp, $fsize);
                $h['filename'] = $fname[1] != "" ? $fname[1] : basename($url['path']);
                $h['fsize'] = $fsize[1];
                break;
            }
        }
        @fclose($fp);
        return $h;
        mysql_close($conn);
	}

?>