<?
/*

// Codi creat per M Minoves, tots els drets reservats. Sota llicència GNU/GPL però per modificació o adaptació contactar amb l'autor.
// Code created by  M Minoves, All rights reserved. Under GNU/GPL licence but for modification notificate the author.

// www.aldeaglobal.net/callserver

// call.php VERSION: 2.1008093015

Explanations are bilingual in catalan and english


SINTAXI DE LA URL ÉS LA SEGÜENT: / URL SINTAX IS AS FOLLOWS:
 call.php?provider=justvoip.com&disp=1&default=0034&forcea=0034&forceb=0034&us=USER&ps=PASSWORD&tela=TELEPHONEA&telb=TELEPHONEB


Està instalat a / It is installed on:
 http://www.aldeaglobal.net/callserver/call.php?provider=justvoip.com&disp=0&hideprice=0&default=0034&forcea=0034&forceb=0034&us=USER&ps=PASSWORD&tela=TELEPHONEA&telb=TELEPHONEB

Un exemple senzill podria ser / A simplified example could be:
 http://www.aldeaglobal.net/callserver/call.php?provider=justvoip.com&us=myusername&ps=mypassword&tela=00496151000000&telb=0034938550000


provider=justvoip		Proveidor de Betamax / Betamax provider used   ex: justvoip.com, voipbusterpro.com, internetcalls.com ...
										(Price comparition at http://backsla.sh/betamax)
									
												freecall.com
												internetcalls.com
												justvoip.com
												lowratevoip.com
												netappel.fr
												poivy.com
												sipdiscount.com
												sparvoip.de
												voipbuster.com
												voipbusterpro.com
												voipcheap.co.uk
												voipcheap.com
												voipdiscount.com
												voipstunt.com
												webcalldirect.com
												voicetrading.com

disp=1					Ensenya el header i el contingut de les pàgines que descarrega. / Show the header and the content of the downloaded pages

server=					Url del compte Betamax (No necessari) / Betamax account URL (Not needed)  ex. 'https://myaccount.justvoip.com'

default=0034				Si un número de telèfon no està en format internacional, assumeix que aquest prefix / If one telephone number is not specified in the international format, it assumes it will have as prefix

forcea=0034				Força un prefix als numeros / Forces the numbers to have one prefix
forceb=0034

us=USER					Usuari i contrasenya / Account user and password
ps=PASSWORD

tela=TELEPHONEA			Telèfon origen  / Source telephone
telb=TELEPHONEB			Telèfon destí   / Destination telephone

hideprice=1				No mostra informació de preus / Hides pricing information

hidelogin=1             En errors no mostra informacio del login / On errors it does not show login info
hidelogin=2             En errors no mostra informacio del login pero si demana pels telefons / On errors it does not show login info but it asks for telephones if missing.
hidelogin=3             No mostra errors, ni mostra informacio del login pero si demana pels telefons / It doesn't show error or login info but it asks for telephones if missing.


slow=1					Activa negociacó lenta / Forces slow negotiation during login



// Installation notes on a server / Instal·lació avançada en un servidor:

The only requirement is that you have to have installed the OpenSSL (i.e.: 0.9.7i 14 Oct 2005) in order to let the script login to the secure server. This means that your scripts can open secure https pages.
You do not need to have CURL installed for this script.
This script has been tested on a FreeBSD 4.10-RELEASE FreeBSD 4.10-RELEASE #5 with the PHP Version 4.4.4  
It shouldn't be dependant on the version, but I have tried several PHP servers and some configurations did not work.
I managed to make it work on a PHP Version 4.3.4 on a Windows NT 6.0 build 6000 by commenting the whole BE3B section.
Betamax probably checks the way the socket connections are performed in order to detect fake browsers (like this one), and
in that case applies automatically the logout method. If somebody knows another reason please tell me.




You are also free to use the already installed script on such a server at (please do not abuse of it):
www.aldeaglobal.net/callserver/call.php

Which with all the sintax would be:
www.aldeaglobal.net/callserver/call.php?provider=justvoip.com&disp=0&hideprice=0&default=0034&forcea=0034&forceb=0034&us=USER&ps=PASSWORD&tela=TELEPHONEA&telb=TELEPHONEB

// Donations:

If you like this program you can give me a beer! All donations are voluntary. They are all welcome and they help me paying the server maintenance and "buying time" to keep updating.
http://www.aldeaglobal.net/donate

// Disclaimer:
 
I developed and published this script because I think it is not against any agreement with Betamax.
In fact Betamax should be aware that this is a promotion of people having/opening accounts with them. It is a service that they could already offer, and that I programmed for free for non lucrative personal interest.
If anybody thinks this goes against it or it is illegal please contact me.



*/

// START




// Add the headers to avoid proxy cache of this page. We want a new call every time the page is called  / Afegeix les capçaleres que eviten que es la pàgina es guardi en un caché d'un proxy, ja que volem una nova trucada cada vegada que obrim la pàgina:
// 1. Allows cache for 30 seconds, this avoids making the same call twice, but it also do not let to call twice in 30 sec (even different numbers).
header("Cache-Control: must-revalidate");
$offset = 30; // 60 * 60 * 24 * 1;
header("Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT");

if(isset($_REQUEST['telb']) && strlen($_REQUEST['telb']))
{
	if(strlen($_REQUEST['telb']) != 10)
	{
		echo "O telefone precisa ter 10 d&iacute;gitos (DDD + N&uacute;mero).";
		exit();
	}
	
	if(in_array(substr($_REQUEST['telb'], 2, 1), array('6' ,'7' ,'8', '9')))
	{
		echo "N&atilde;o &eacute; permitido utiliza&ccedil;&atilde;o de n&uacute;mero de telefone celular.";
		exit();
	}
}

// 2. Instead, to avoid completely proxy caches could be:
//			header( 'Cache-Control: no-cache, must-revalidate' );
//			header( 'Last-Modified: ' . gmdate( "D, d M Y H:i:s" ) . ' GMT' );
//			header( 'Expires: now' );
//			header( 'Pragma: no-cache' );



// Detect if the user access via wap or normal browser. This is not needed for a PDA like XDA which can accept WAP 2.0 and so it is able to read normal HTML pages.
// Detecta si l'usuari accedeix via wap o normal. Això no és necessari per PDA's com la XDA ja que accepten WAP 2.0 i per això poden llegir pàgines normals.
if(eregi("text/vnd.wap.wml",$HTTP_ACCEPT)) {
    // The user can accept WML format, for WAP 1.0 / L'usuari accepta accepta WML, per WAP 1.0
    $wapuser= true;
    header("Content-type: text/vnd.wap.wml");
		echo ("<?xml version='1.0'?>");
    echo '<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">';
		echo '<wml>';
		echo '<card id="t1" title="TelWeb">';
		
    //header("Location: /wap/index.wml");
    // exit;
}
else
{
		$wapuser = false;
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">';
		echo '<html>';
		echo '<head> <title>Telefone Web</title> </head>';
		echo "\n<body>\n";
}

/*
// We empty the buffer and send the first part of the web page to the user:
flush();
ob_flush();
echo "\n";
flush();
ob_flush();
flush();
ob_flush();
*/

// We check not to overuse this script, and also avoids making the same call twice when clicked double.
$counter_file = "ultimacces.txt";
if (file_exists($counter_file))
     $visits = file($counter_file);
else
    $visits[0]=0;

if($visits[0] + 10 > time())
    showerror("Server overuse. Please wait 10 seconds..");

$fp = fopen($counter_file , "w");
fputs($fp , time());
fclose($fp);



// En cas de cridar el script sense parametres / In case of calling this script directly without parameters
if ($_REQUEST["tela"] =='' && $_REQUEST["telb"] =='' && $_REQUEST["us"] =='' && $_REQUEST["ps"] =='' && $_REQUEST["provider"] =='')
{
	showerror('');
}


// Usuari i contrasenya / Account user and password
if(!isset($_REQUEST["us"]) || !isset($_REQUEST["ps"]))
{
  showerror("Missing Login information");
}

$usuari = $_REQUEST["us"];
$contrasenya = $_REQUEST["ps"];

if($usuari == "")
{
  showerror("Login name cannot be empty");
}
if($contrasenya == "")
{
  showerror("Password cannot be empty");
}


// $disp=1; // Ensenya el header i el contingut de les pàgines que descarrega. / Show the header and the content of the downloaded pages
if($_REQUEST["disp"] ==1)
{
    $disp=1;
}


// Proveidor de Betamax / Betamax provider used  ex: justvoip.com, voipbusterpro.com, internetcalls.com ...
if(isset($_REQUEST["provider"]))
{
    $servidor = 'https://www.' . $_REQUEST["provider"]; // . '.com';

}

// Url del compte Betamax (No necessari) / Betamax account URL (Not needed)  ex. 'https://myaccount.justvoip.com'
if(isset($_REQUEST["server"]))
{
 $servidor = $_REQUEST["server"];
}

if($servidor == "")
{
$servidor = "https://www.justvoip.com";
}


// tela= Telèfon origen  / Source telephone
// telb= Telèfon destí   / Destination telephone
if (isset($_REQUEST["tela"]) && $_REQUEST["tela"] != "")
{
    $tela= $_REQUEST["tela"];
}else{
    showerror("Missing TelA");
}

if (isset($_REQUEST["telb"]) && $_REQUEST["telb"] != "")
{
    $telb= $_REQUEST["telb"];
}else{
    showerror("Missing TelB");
}

if ($tela == $telb)
{
    showerror("TelA = TelB");
}



// Força un prefix als numeros de telèfon / Forces the telephone numbers to have one prefix
if($_REQUEST["forcea"] !="")
{
   $tela = $_REQUEST["forcea"] . $tela;
}

if($_REQUEST["forceb"] !="")
{
   $telb = $_REQUEST["forceb"] . $telb;
}


// Si un número de telèfon no està en format internacional, assumeix que te aquest prefix / If one telephone number is not specified in the international format, it assumes it will have as prefix
if($_REQUEST["default"] !="")
{
   if (substr($tela,0,2)!= "00" && substr($tela,0,1)!= "+")
   {
       $tela = $_REQUEST["default"] . $tela;
   }
   if (substr($telb,0,2)!= "00" && substr($telb,0,1)!= "+")
   {
       $telb = $_REQUEST["default"] . $telb;
   }
}


if (strlen($tela)<5 || (substr($tela,0,2)!= "00" && substr($tela,0,1)!= "+") || !is_numeric($tela))
{
   showerror("Invalid number tela: $tela");
}
if (strlen($telb)<5 || (substr($telb,0,2)!= "00" && substr($telb,0,1)!= "+") || !is_numeric($telb))
{
   showerror("Invalid number telb: $telb");
}






echo "TelA: $tela TelB: $telb<br>";
echo "Connecting..<br>\n";


// We empty the buffer and send the first part of the web page to the user:
flush();
ob_flush();
echo "\n";
flush();
ob_flush();
flush();
ob_flush();







/////////////////////////////////////////////////////
// Inici/Start:

$be = new BrowserEmulator();
$be->addHeaderLine("Referer", $servidor . "/myaccount/index.php?part=timeout");
// $be->addHeaderLine("Referer", "https://www.justvoip.com/myaccount/index.php");
// $be->addHeaderLine("Accept-Encoding", "x-compress; x-zip");
$be->addHeaderLine("Accept",'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*');
$be->addHeaderLine("Accept-Language",'ca');
$be->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
$be->addPostData("part", "menu");
//$be->addPostData("username", $usuari);
//$be->addPostData("password", $contrasenya);

$file = $be->fopen($servidor . "/myaccount/index.php");
$response = $be->getLastResponseHeaders();

//Getting the first Session ID:
$sessio = trobaSessio($response);


if ($disp==1)
{
    echo "<br>1head:<textarea COLS=90 ROWS=20>";
        // echo "usuari = $usuari contrasenya = $contrasenya";   
		foreach ($response as $liniaresposta)
           {
           echo $liniaresposta;
           }
    echo "</textarea><br>";

    echo "<br>1body:<textarea COLS=90 ROWS=20>";
        while ($line = fgets($file, 1024)) {
           // do something with the file
           print $line;
        }

    echo "</textarea><br>";

	echo "<br>sessio='" . $sessio . "'<br>";
}

//At the moment, the Betamax server do not check the variable windowm and therefore it's not needed to be read:
$windowm = "";

//We wait 50ms
usleep(50);





if($_REQUEST["slow"] ==1) //New parameter. When the script does not work, this method is slower but safer.
{

//////////////////////////////////////////////////////////
//Opening setwindowname.php -  Sometimes it is required:

$be2 = new BrowserEmulator();
$be2->addHeaderLine("Referer", $servidor . "/myaccount/index.php");
$be2->addHeaderLine("Accept",'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*');
$be2->addHeaderLine("Accept-Language",'ca');
$be2->addHeaderLine('Content-Type','application/x-www-form-urlencoded');
$be2->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
$be2->addHeaderLine("Cookie", "TRACKERID=" . $sessio . "; windowname=" . $windowm );

$file2 = $be2->fopen($servidor . "/myaccount/setwindowname.php");

$impres=""; 

if ($disp==1)
{
$response2 = $be2->getLastResponseHeaders();


    echo "<br>2head:<textarea COLS=90 ROWS=20>";
           foreach ($response2 as $liniaresposta2)
           {
           echo $liniaresposta2;
           }
    echo "</textarea><br>";

    echo "<br>2body:<textarea COLS=90 ROWS=20>";
}        
		while ($line2 = fgets($file2, 1024)) {
           $impres .= $line2;
		   if ($disp==1)
				print $line2;
        }
	
	// example: Set_Cookie("windowname", '29cd6e5c7e4k1ohwi8cnn3wo', 2147433627, '/', '', '');	
	$windowm = tallaEntre($impres, 'Set_Cookie("windowname", ' . "'", "'");

	if ($disp==1)
	{	echo "</textarea><br>";
		//echo "Impres='$impres'";
		echo "Windowname='$windowm'";
	}


}
	
	

//////////////////////////////////////////////////////////
// Performing login:

$be3 = new BrowserEmulator();
$be3->addHeaderLine("Referer", $servidor . "/myaccount/index.php?part=timeout");
//$be3->addHeaderLine("Accept-Encoding", "x-compress; x-zip");
$be3->addHeaderLine("Accept",'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*');
$be3->addHeaderLine("Accept-Language",'ca');
$be3->addHeaderLine('Content-Type','application/x-www-form-urlencoded');
$be3->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');

$be3->addHeaderLine("Cookie", "TRACKERID=" . $sessio . "; windowname=" . $windowm );
// $be3->addPostData("PHPSESSID", $sessio);


$be3->addPostData("part", "menu");
$be3->addPostData("username", $usuari);
$be3->addPostData("password", $contrasenya);



//$file3 = $be3->fopen($servidor . "/myaccount/index.php?part=menu&justloggedin=true");
$file3 = $be3->fopen($servidor . "/myaccount/index.php");
$response3 = $be3->getLastResponseHeaders();

// Getting the new Sessio nID:
$sessio_new = trobaSessio($response3);
if ($sessio_new != "")
	$sessio = $sessio_new;


$impres="";

if ($disp==1)
{
    echo "<br>3head:<textarea COLS=90 ROWS=20>";
           foreach ($response3 as $liniaresposta3)
           {
           echo $liniaresposta3;
           }
    echo "</textarea><br>";

    echo "<br>3body:<textarea COLS=90 ROWS=20>";
} 
while ($line3 = fgets($file3, 1024)) {
           // do something with the file
           $impres .= $line3;
		   if ($disp==1)
				print $line3;
}
if ($disp==1)	{
	echo "</textarea><br>";
	echo "<br>sessio='" . $sessio . "'<br>";
}


/*
When tring several times with a wrong password, the login blocks for 1 hour and this error shows after login:
"Username and/or password incorrect (error 4)<br>Your account has been blocked for security reasons. Even if you enter the correct password you still cannot access your account for at least one hour. Please wait and try again later. 
If you are uncertain about the correct username/password combination please check the registration email or request resending of your password. You can find this option next to the login fields.<br><br></b></p>
"
And the last try shows:
"password incorrect (error 4) "..."For security reasons you have one more attempt before this username will be temporarily blocked. If you are uncertain about the correct username/password combination please check the registration email or request resending of your password. You can find this option next to the login fields."
*/
if (!(strpos($impres, "error") === false)) //"password incorrect (error 4)"
{
    //echo "<br>Login/Password incorrect!<br>\n";
	echo "<br>Login Error:<br>\n";
	echo strip_tags(tallaEntre($impres, "<p>", "</p>"));
	echo "<br>";
	printFinal();
	exit();
}


if($_REQUEST["slow"] ==1) //New parameter. When the script does not work, this method is slower but safer.
{

//We wait 100ms
usleep(100);	



//////////////////////////////////////////////////////////
//Opening main page -  Sometimes it is required:

$be4 = new BrowserEmulator();

$be4->addHeaderLine("Referer", $servidor . "/myaccount/index.php");
//$be4->addHeaderLine("Accept",'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*');
//$be4->addHeaderLine("Accept-Language",'ca');
//$be4->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
$be4->addHeaderLine("Cookie", "TRACKERID=" . $sessio . "; windowname=" . $windowm );

$file4 = $be4->fopen($servidor . "/myaccount/index.php?part=menu&justloggedin=true");
//$file4 = $be4->fopen($servidor . "/clx/webcalls2.php?panel=true");

if ($disp==1)
{
$response4 = $be4->getLastResponseHeaders();


    echo "<br>4head:<textarea COLS=90 ROWS=20>";
           foreach ($response4 as $liniaresposta4)
           {
           echo $liniaresposta4;
           }
    echo "</textarea><br>";

    echo "<br>4body:<textarea COLS=90 ROWS=20>";
        while ($line4 = fgets($file4, 1024)) {
           print $line4;
        }
	echo "</textarea><br>";
}



//We wait 100ms
usleep(200);	


//////////////////////////////////////////////////////////
//Opening resetwindow.php -  Sometimes it is required:

$be4a = new BrowserEmulator();
$be4a->addHeaderLine("Referer", $servidor . "/myaccount/index.php?part=menu&justloggedin=true");
//$be4a->addHeaderLine("Accept",'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*');
//$be4a->addHeaderLine("Accept-Language",'ca');
//$be4a->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
$be4a->addHeaderLine("Cookie", "TRACKERID=" . $sessio . "; voipusername=" . $usuari . "; windowname=" . $windowm );

$file4a = $be4a->fopen($servidor . "/myaccount/resetwindow.php");

$impres=""; 

if ($disp==1)
{
$response4a = $be4a->getLastResponseHeaders();


    echo "<br>4Ahead:<textarea COLS=90 ROWS=20>";
           foreach ($response4a as $liniaresposta4a)
           {
           echo $liniaresposta4a;
           }
    echo "</textarea><br>";

    echo "<br>4Abody:<textarea COLS=90 ROWS=20>";
}        
		while ($line4a = fgets($file4a, 1024)) {
           $impres .= $line4a;
		   if ($disp==1)
				print $line4a;
        }
	
	// example: Set_Cookie("windowname", '29cd6e5c7e3k1ohwi8cnn3wo', 2147433627, '/', '', '');	
	$windowm = tallaEntre($impres, 'Set_Cookie("windowname", ' . "'", "'");

	if ($disp==1)
	{	echo "</textarea><br>";
		//echo "Impres='$impres'";
		echo "Windowname='$windowm'";
	}



//We wait 100ms
usleep(100);	

}
//end if slow==1



if($_REQUEST["slow"] ==1) //New parameter. When the script does not work, this method is slower but safer.
{	
//////////////////////////////////////////////////////////
//Opening /myaccount/webcalls2.php?panel=true without calling -  Sometimes it is required:

$be4b = new BrowserEmulator();
$be4b->addHeaderLine("Referer", $servidor . "/myaccount/index.php?part=menu&justloggedin=true");
$be4b->addHeaderLine("Accept",'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*');
$be4b->addHeaderLine("Accept-Language",'ca');
$be4b->addHeaderLine('Content-Type','application/x-www-form-urlencoded');
$be4b->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
$be4b->addHeaderLine("Cookie", "TRACKERID=" . $sessio . "; voipusername=" . $usuari . "; windowname=" . $windowm );


$file4b = $be4b->fopen($servidor . "/myaccount/webcalls2.php");

if ($disp==1)
{
$response4b = $be4b->getLastResponseHeaders();


    echo "<br>4Bhead:<textarea COLS=90 ROWS=20>";
           foreach ($response4b as $liniaresposta4b)
           {
           echo $liniaresposta4b;
           }
    echo "</textarea><br>";

    echo "<br>4Bbody:<textarea COLS=90 ROWS=20>";
        while ($line4b = fgets($file4b, 1024)) {
           print $line4b;
        }
	echo "</textarea><br>";
}



// We empty the buffer and send the first part of the web page to the user:
echo "\n";
flush();
ob_flush();
flush();
ob_flush();
flush();
ob_flush();

//We wait 300ms
usleep(300);

}


//////////////////////////////////////////////////////////
//Setting the call:

$be5 = new BrowserEmulator();
//$be5->addHeaderLine("Referer", $servidor . "/clx/webcalls2.php?panel=true");

//$be5->addHeaderLine("Accept-Encoding", "x-compress; x-zip");
//echo substr($servidor, 8);

//$be5->addHeaderLine("Host", substr($servidor, 8));
//$be5->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
//$be5->addHeaderLine("Accept",'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*');
//$be5->addHeaderLine("Accept-Language",'ca');
//$be5->addHeaderLine("Accept-Encoding", "gzip,deflate");
//$be5->addHeaderLine("Accept-Charset", "ISO-8859-1,utf-8;q=0.7,*;q=0.7");
//$be5->addHeaderLine("Keep-Alive", "300");
//$be5->addHeaderLine("Connection", "keep-alive");
$be5->addHeaderLine("Referer", $servidor . "/myaccount/phone-to-phone.php");
//$be5->addHeaderLine("Cookie", "PHPSESSID=" . $sessio . "; voipusername=" . $usuari . "; windowname=" . $windowm );
//$be5->addHeaderLine("Content-Type:", "application/x-www-form-urlencoded");

$be5->addHeaderLine("Accept",'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8');
$be5->addHeaderLine("Accept-Language",'ca');
$be5->addHeaderLine('Content-Type','application/x-www-form-urlencoded');
$be5->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
$be5->addHeaderLine("Cookie", "TRACKERID=" . $sessio . "; voipusername=" . $usuari . "; windowname=" . $windowm );

//$be5->debug = true;

$be5->addPostData("action", "initcall");
$be5->addPostData("panel", "true");

$be5->addPostData("anrphonenr", $tela);
$be5->addPostData("bnrphonenr", $telb);


$file5 = $be5->fopen($servidor . "/myaccount/phone-to-phone.php");
$response5 = $be5->getLastResponseHeaders();

if ($disp==1)
{
    echo "<br>5head:<textarea COLS=90 ROWS=20>";
           foreach ($response5 as $liniaresposta5)
           {
           echo $liniaresposta5;
           }
    echo "</textarea><br>";

    echo "<br>5body:<textarea COLS=90 ROWS=20>";
}
        $impres="";
        while ($line5 = fgets($file5, 1024)) {
           // do something with the file
           if ($disp==1) print $line5;
           $impres .= $line5;
        }

if ($disp==1) echo "</textarea><br>";


if ($impres == "")
{
    echo "<br>Failed<br>\n";
	printFinal();
	exit();
}
echo "<br>Done<br>\n";


// We empty the buffer and send the first part of the web page to the user:
echo "\n";
flush();
ob_flush();
flush();
ob_flush();
flush();
ob_flush();

//We wait 50ms
usleep(50);

//hideprice=1					No mostra informació de preus / Hides pricing information
if($_REQUEST["hideprice"] == 1){
	printFinal();
	exit();
}


$variablesJavascript[1] = trobaPart($impres, 'connection1.send("', '");');
$variablesJavascript[2] = trobaPart($impres, 'connection2.send("', '");');
$variablesJavascript[3] = trobaPart($impres, 'connection3.send("', '");');
$variablesJavascript[4] = trobaPart($impres, 'connection4.send("', '");');
$variablesJavascript[5] = trobaPart($impres, 'connection5.send("', '");');
$variablesJavascript[6] = trobaPart($impres, 'connection6.send("', '");');
$variablesJavascript[7] = trobaPart($impres, 'connection7.send("', '");');


//////////////////////////////////////////////////////////
//Status (and the price of the current call):
// getwebcallstatus2.php

//$be9a = new BrowserEmulator();

//$be9a->addHeaderLine("Referer", $servidor . "/clx/webcalls2.php");
//$be9a->addHeaderLine("Accept-Encoding", "x-compress; x-zip");

//$be9a->addHeaderLine("Accept",'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*');
//$be9a->addHeaderLine("Accept-Language",'ca');
//$be9a->addHeaderLine('Content-Type','application/x-www-form-urlencoded');
//$be9a->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');


//$be9a->addHeaderLine("Referer", $servidor . "/clx/index.php?part=menu&justloggedin=true");
//$be9b->addHeaderLine("Accept-Encoding", "x-compress; x-zip");
//$be9a->addHeaderLine("Accept",'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*');
//$be9a->addHeaderLine("Accept-Language",'ca');
//$be9a->addHeaderLine("Content-Type","application/x-www-form-urlencoded");
//$be9a->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
// $be9b->addHeaderLine("Cookie", "PHPSESSID=" . $sessio . "; voipusername=" . $usuari . "; windowname=" . $windowm );
//$be9a->addHeaderLine("Cookie", "PHPSESSID=" . $sessio . "; voipusername=" . $usuari . "; windowname=" . $windowm . "; anrphn=" . $tela . "; bnrphn=" . $telb );


// $be9a->addPostData("part", "menu");
// $be9a->addPostData("username", $usuari);
// $be9a->addPostData("password", $contrasenya);




for($repeteix=1;$repeteix<=6;$repeteix++)
{
$variablesJavascriptX = $variablesJavascript[$repeteix]; 
    
    
$be9a = new BrowserEmulator();


//$be9a->addHeaderLine("Referer", $servidor . "/clx/webcalls2.php");
//$be9a->addHeaderLine("Accept-Encoding", "x-compress; x-zip");

//$be9a->addHeaderLine("Accept",'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*');
//$be9a->addHeaderLine("Accept-Language",'ca');
//$be9a->addHeaderLine('Content-Type','application/x-www-form-urlencoded');
//$be9a->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');


$be9a->addHeaderLine("Referer", $servidor . "/myaccount/index.php?part=menu&justloggedin=true");
//$be9b->addHeaderLine("Accept-Encoding", "x-compress; x-zip");
$be9a->addHeaderLine("Accept",'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8');
$be9a->addHeaderLine("Accept-Language",'ca');
$be9a->addHeaderLine("Content-Type","application/x-www-form-urlencoded");
$be9a->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
// $be9b->addHeaderLine("Cookie", "PHPSESSID=" . $sessio . "; voipusername=" . $usuari . "; windowname=" . $windowm );
$be9a->addHeaderLine("Cookie", "TRACKERID=" . $sessio . "; voipusername=" . $usuari . "; windowname=" . $windowm . "; anrphn=" . $tela . "; bnrphn=" . $telb );
$be9a->debug = false;


// echo $variablesJavascriptX;
/*
echo "<br>var1" . tallaEntre($variablesJavascriptX,'var1=','&');
echo "<br>var2" . tallaEntre($variablesJavascriptX,'var2=','&');
echo "<br>var3" . tallaEntre($variablesJavascriptX,'var3=','&');
echo "<br>var4" . tallaEntre($variablesJavascriptX,'var4=','&');
echo "<br>var5" . tallaEntre($variablesJavascriptX,'var5=','&');
echo "<br>var9" . tallaEntre($variablesJavascriptX . '&','var9=','&');

$be9a->addPostData("var1",tallaEntre($variablesJavascriptX,'var1=','&'));
$be9a->addPostData("var2",tallaEntre($variablesJavascriptX,'var2=','&'));
$be9a->addPostData("var3",tallaEntre($variablesJavascriptX,'var3=','&'));
$be9a->addPostData("var4",tallaEntre($variablesJavascriptX,'var4=','&'));
$be9a->addPostData("var5",tallaEntre($variablesJavascriptX,'var5=','&'));
$be9a->addPostData("var9",tallaEntre($variablesJavascriptX. '&','var9=','&'));
*/
$be9a->addPostData("PostStringMar","PostStringMar");
$be9a->PostStringMar = $variablesJavascriptX;

$file9a = $be9a->fopen($servidor . "/myaccount/getwebcallstatus2.php"); // . $variablesJavascriptX);
$response9a = $be9a->getLastResponseHeaders();

if ($disp==1)
{
    echo "<br>9a-head:<textarea COLS=90 ROWS=20>";
           foreach ($response9a as $liniaresposta9a)
           {
           echo $liniaresposta9a;
           }
    echo "</textarea><br>";


    echo "<br>9a-body:<textarea COLS=90 ROWS=20>";
}
        $impres9a="";

        while ($line9a = fgets($file9a, 1024)) {
           // do something with the file
           if ($disp==1) print $line9a;
           $impres9a .= $line9a;
        }

if ($disp==1) echo "</textarea><br>";


/*
$impres9a == "adialing;:50000;0;60;0;80000;60"

From the JavaScript:
ASideSetupCharge = parseInt(arrest[0]);               
ASideTariff = parseInt(arrest[1]);
ASideTariffIntervall = parseInt(arrest[2]);
BSideSetupCharge = parseInt(arrest[3]);
BSideTariff = parseInt(arrest[4]);
BSideTariffIntervall = parseInt(arrest[5]);
*/


//  		$impres9a == "AAA;BBB:CCC;DDD;EEE;FFF;GGG;HHH"   === "adialing;:50000;0;60;0;80000;60"
		if (!(strpos($impres9a, ":") === false))
		{
			$impres9aArray = split(":", $impres9a);
			
			// "AAA;BBB"
			if (!(stripos($impres9aArray[0], "adialing") === false))
			{
				echo "Calling!<br>\n";
			}else{
				echo "Not calling?<br>\n";
			}


			// "CCC;DDD;EEE;FFF;GGG;HHH"
			if (!(strpos($impres9aArray[1], ";") === false))
			{
				$impres9aArray2 = split(";", $impres9aArray[1]);

				if (count($impres9aArray2) == 6)
				{	
					echo "<br>";
					echo "Price A: ";
					if ($impres9aArray2[0] > 0)
						echo centims($impres9aArray2[0]);
					if($impres9aArray2[1] > 0)
						echo " + " . centims($impres9aArray2[1]) . "/" . $impres9aArray2[2] . "s";
					echo "<br>\n";
					
					echo "Price B: ";
					if ($impres9aArray2[3] > 0)
						echo centims($impres9aArray2[3]);
					if($impres9aArray2[4] > 0)
						echo " + " . centims($impres9aArray2[4]) . "/" . $impres9aArray2[5] . "s";
					echo "<br>\n";
				}
			}
			
			$repeteix=7; // ==> exit for
		}else{
			echo "Not calling. Trying again...<br>\n";
			//$variablesJavascriptX =  $variablesJavascript2;
			
			// We empty the buffer and send the first part of the web page to the user:
			echo "\n";
			flush();
			ob_flush();
			flush();
			ob_flush();
			flush();
			ob_flush();

			//We wait 500ms
			usleep(500);
			
		}
}



//////////////////////////////////////////////////////////
// Remaining Balance:
//getwebcallbalance.php

$be9b = new BrowserEmulator();
$be9b->addHeaderLine("Referer", $servidor . "/myaccount/index.php?part=menu&justloggedin=true");
//$be9b->addHeaderLine("Accept-Encoding", "x-compress; x-zip");
$be9b->addHeaderLine("Accept",'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*');
$be9b->addHeaderLine("Accept-Language",'ca');
$be9b->addHeaderLine("Content-Type","application/x-www-form-urlencoded");
$be9b->addHeaderLine("User-Agent",'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
// $be9b->addHeaderLine("Cookie", "PHPSESSID=" . $sessio . "; voipusername=" . $usuari . "; windowname=" . $windowm );
$be9b->addHeaderLine("Cookie", "TRACKERID=" . $sessio . "; voipusername=" . $usuari . "; windowname=" . $windowm . "; anrphn=" . $tela . "; bnrphn=" . $telb );

// $be3->addPostData("PHPSESSID", $sessio);
// $be3->addPostData("windowname", "wci9we87do5k3o1c46hecn2n");

// $be9b->addPostData("part", "menu");
// $be9b->addPostData("username", $usuari);
// $be9b->addPostData("password", $contrasenya);



$file9b = $be9b->fopen($servidor . "/myaccount/getwebcallbalance.php?" . $variablesJavascript7);
$response9b = $be9b->getLastResponseHeaders();

if ($disp==1)
{
    echo "<br>9b-head:<textarea COLS=90 ROWS=20>";
           foreach ($response9b as $liniaresposta9b)
           {
           echo $liniaresposta9b;
           }
    echo "</textarea><br>";


    echo "<br>9b-body:<textarea COLS=90 ROWS=20>";
}
        $impres9b="";

        while ($line9b = fgets($file9b, 1024)) {
           // do something with the file
           if ($disp==1) print $line9b;
           $impres9b .= $line9b;
        }

if ($disp==1) echo "</textarea><br>";

// Format  $impres9b == "1060000" == 10,60 eur
if (strlen($impres9b)>1)
{   
	if ((int)($impres9b) < 1000)
    {
		echo "No credit!<br>\n";
	}else{
		echo "Remains: " . centimsBalance($impres9b) . "<br>\n";
	}
}

printFinal();


// Final / End
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



function centims($price)
{
		if (substr($price,-4) == "0000")
		{
			$price = substr($price,0,-4) . "c";
		}
		elseif (substr($price,-3) == "000")
		{
			$price = substr($price,0,-4) . "," . substr($price,-4, 1) . "c";
		}
	return $price;
}

function centimsBalance($price)
{
		if (substr($price,-3) == "000")
		{
			$price = substr($price,0,-5) . "," . substr($price,-5, 2); //Eur
		}elseif (substr($price,-2) == "00")
		{
			$price = substr($price,0,-5) . "," . substr($price,-5, 3); //Eur
		}else
		{
			$price = substr($price,0,-5) . "," . substr($price,-5, 5); //Eur
		}
		
	return $price;
}


function showerror($missatge)
{

if($_REQUEST["provider"] == "")
	$_REQUEST["provider"] = 'justvoip.com';

if($_REQUEST["hidelogin"] != 3){    
    echo '<b>' . $missatge . '</b><br>';
}
    
if($_REQUEST["hidelogin"] >= 2){
    echo '<center><form method="POST" name="telweb" action="call.php">
    <table border="0" width="20%" cellspacing="0" cellpadding="2">
        <tr>
            <td align="right">TelA:</td>
            <td><input type="text" name="tela" value="'.$_REQUEST["tela"].'"></td>
        </tr><tr>
            <td align="right">TelB:</td>
            <td><input type="text" name="telb" value="'.$_REQUEST["telb"].'"></td>
        </tr><tr>
            <td align="right"></td>
            <td>
            <input type="hidden" name="us" value="'.$_REQUEST["us"].'">
            <input type="hidden" name="ps" value="'.$_REQUEST["ps"].'">
            <input type="hidden" name="provider" value="'.$_REQUEST["provider"].'">
            <input type="submit" value="Call"></td>
        </tr>
    </table>
    </form>
    </center>';
}elseif($_REQUEST["hidelogin"] != 1){
    echo '<center>
';
}

printFinal();
exit();

} 



function printFinal()
{
	echo "<br><small>" . gmdate("ymd D H:i:s") . "</small>";


	/*
	echo "
	<small><small>SINTAXI DE LA URL ÉS LA SEGÜENT: / URL SINTAX IS AS FOLLOWS:<br> call.php?provider=justvoip&disp=0&default=0034&forcea=0034&forceb=0034&us=USER&ps=PASSWORD&tela=TELEPHONEA&telb=TELEPHONEB
	<br>No utilizeu aquesta web per males finalitats. La utilització de la mateixa implica acceptar la responsabilitat de tota possible sobrecàrrega del sistema de trucades utilitzat. Gràcies.</small></small></small>
	";
	*/


	if ($wapuser)
	{
			echo '</card>';
			echo '</wml>';
	}
	else
	{
			echo "\n</body>\n";
			echo '</html>';
	}
}


function tallaEntre($liniatext,$entre1,$entre2){
	if (!(strpos($liniatext, $entre1) === false)) 
	{
		$posGenIni = strpos($liniatext, $entre1) + strlen($entre1);
		//if (!(strpos($liniatext, $entre2) === false)) 
		$posGenFin = strpos($liniatext, $entre2, $posGenIni);
		return substr($liniatext, $posGenIni, $posGenFin - $posGenIni);
	}
	return false;
}


function trobaSessio($responseGen){

   //foreach ($responseGen as $liniarespostaGen)   <--It has to be the last PHPSESSID
	for ($i=count($responseGen); $i > 0; $i--)
	{
	$liniarespostaGen = $responseGen[$i - 1];

        if (!(strpos($liniarespostaGen, "PHPSESSID=") === false))
        {
            $posGenIni = strpos($liniarespostaGen, "PHPSESSID=") + 10;
            $posGenFin = strpos($liniarespostaGen, ";", $posGenIni);
            return substr($liniarespostaGen, $posGenIni, $posGenFin - $posGenIni);
        }
        if (!(strpos($liniarespostaGen, "TRACKERID=") === false))
        {                                           
            $posGenIni = strpos($liniarespostaGen, "TRACKERID=") + 10;
            $posGenFin = strpos($liniarespostaGen, ";", $posGenIni);
            return substr($liniarespostaGen, $posGenIni, $posGenFin - $posGenIni);
        }
        
   }
	return false;
}


function trobaPart($liniarespostaGen, $part1, $part2){
		if (!(strpos($liniarespostaGen, $part1) === false))
		{
			$posGenIni = strpos($liniarespostaGen, $part1) + strlen($part1);
			$posGenFin = strpos($liniarespostaGen, $part2, $posGenIni);
			return substr($liniarespostaGen, $posGenIni, $posGenFin - $posGenIni);
		}

	return false;
}



//FINAL
/***************************************************************************

Browser Emulating file functions v2.0.1b       (adaptat i millorat per / adapted & improved by: MMinoves)
(c) Kai Blankenhorn
www.bitfolge.de/browseremulator
kaib@bitfolge.de


This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

****************************************************************************


Changelog:

v2.0.1b
    SSL and improvements by MMinoves

v2.0.1
    fixed authentication bug
    added global debug switch

v2.0    03-09-03
    added a wrapper class; this has the advantage that you no longer need
        to specify a lot of parameters, just call the methods to set
        each option
    added option to use a special port number, may be given by setPort or
        as part of the URL (e.g. server.com:80)
    added getLastResponseHeaders()

v1.5
    added Basic HTTP user authorization
    minor optimizations

v1.0
    initial release



***************************************************************************/


/**
 * BrowserEmulator class. Provides methods for opening urls and emulating
 * a web browser request.
 **/
class BrowserEmulator {

    var $headerLines = Array();
    var $postData = Array();
    var $authUser = "";
    var $authPass = "";
    var $port;
    var $lastResponse = Array();
    var $debug = false;
	var $PostStringMar = "";
	
    function BrowserEmulator() {
        $this->resetHeaderLines();
        $this->resetPort();
    }

    /**
    * Adds a single header field to the HTTP request header. The resulting header
    * line will have the format
    * $name: $value\n
    **/
    function addHeaderLine($name, $value) {
        $this->headerLines[$name] = $value;
    }

    /**
    * Deletes all custom header lines. This will not remove the User-Agent header field,
    * which is necessary for correct operation.
    **/
    function resetHeaderLines() {
        $this->headerLines = Array();

        /*******************************************************************************/
        /**************    YOU MAX SET THE USER AGENT STRING HERE    *******************/
        /*                                                                             */
        /* default is "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)",            */
        /* which means Internet Explorer 6.0 on WinXP                                  */

        $this->headerLines["User-Agent"] = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";

        /*******************************************************************************/

    }

    /**
    * Add a post parameter. Post parameters are sent in the body of an HTTP POST request.
    **/
    function addPostData($name, $value) {
        $this->postData[$name] = $value;
    }

    /**
    * Deletes all custom post parameters.
    **/
    function resetPostData() {
        $this->postData = Array();
    }

    /**
    * Sets an auth user and password to use for the request.
    * Set both as empty strings to disable authentication.
    **/
    function setAuth($user, $pass) {
        $this->authUser = $user;
        $this->authPass = $pass;
    }

    /**
    * Selects a custom port to use for the request.
    **/
    function setPort($portNumber) {
        $this->port = $portNumber;
    }

    /**
    * Resets the port used for request to the HTTP default (80).
    **/
    function resetPort() {
        $this->port = 80;
    }

    /**
    * Make an fopen call to $url with the parameters set by previous member
    * method calls. Send all set headers, post data and user authentication data.
    * Returns a file handle on success, or false on failure.
    **/
    function fopen($url) {
        $this->lastResponse = Array();

        preg_match("~([a-z]*://)?([^:^/]*)(:([0-9]{1,5}))?(/.*)?~i", $url, $matches);

        $protocol = $matches[1];
        $server = $matches[2];
        $port = $matches[4];
        $path = $matches[5];
        if ($port!="") {
            $this->setPort($port);
        }
        elseif ($protocol == 'https://')     // by marti:
        {
            $this->setPort(443);
            // $server = "ssl://" . $server;

            // print "PORT SEGUR";
        }
        if ($path=="") $path = "/";
        $socket = false;
        
        $old_error_state = error_reporting(0);
        $socket = fsockopen(($protocol == 'https://' ? 'ssl://' : '') . $server, $this->port, $errno, $errstr);      // by marti
        error_reporting($old_error_state);
        
        if (!$socket) {
    				//die ("Cannot connect: $errno - $errstr<br />\n");
    				die ("Error connecting to the server.<br />\n Error " . $errno . ": " .$errstr);
        }
        else{
            $this->headerLines["Host"] = $server;

            if ($this->authUser!="" && $this->authPass!="") {
                $this->headerLines["Authorization"] = "Basic ".base64_encode($this->authUser.":".$this->authPass);
            }

            if (count($this->postData)==0) {
                $request = "GET $path HTTP/1.0\r\n";
            } else {
                $request = "POST $path HTTP/1.0\r\n";
            }

            if ($this->debug) echo $request;
            fputs ($socket, $request);

            if (count($this->postData)>0) {
                $PostStringArray = Array();
                foreach ($this->postData AS $key=>$value) {
                    $PostStringArray[] = "$key=$value";
                }
                $PostString = join("&", $PostStringArray);
				if ($this->PostStringMar != "")
				     $PostString = $this->PostStringMar;
                $this->headerLines["Content-Length"] = strlen($PostString);
            }

            foreach ($this->headerLines AS $key=>$value) {
                if ($this->debug) echo "$key: $value\r\n";
                fputs($socket, "$key: $value\r\n");
                // echo "$key: $value\r\n";
            }
            if ($this->debug) echo "\r\n";
            fputs($socket, "\r\n");
            if (count($this->postData)>0) {
                if ($this->debug) echo "$PostString";
                fputs($socket, $PostString."\r\n");
            }
        }
        if ($this->debug) echo "\r\n";
        if ($socket) {
            $line = fgets($socket, 1000);
            if ($this->debug) echo $line;
            $this->lastResponse[] = $line;
            $status = substr($line,9,3);
            while (trim($line = fgets($socket, 1000)) != ""){
                if ($this->debug) echo "$line";
                $this->lastResponse[] = $line;
                if ($status=="401" AND strpos($line,"WWW-Authenticate: Basic realm=\"")===0) {
                    fclose($socket);
                    return FALSE;
                }
            }
        }
        return $socket;
    }

    /**
    * Make an file call to $url with the parameters set by previous member
    * method calls. Send all set headers, post data and user authentication data.
    * Returns the requested file as an array on success, or false on failure.
    **/
    function file($url) {
        $file = Array();
        $socket = $this->fopen($url);
        if ($socket) {
            $file = Array();
            while (!feof($socket)) {
                $file[] = fgets($socket, 10000);
            }
        } else {
            return FALSE;
        }
        return $file;
    }

    function getLastResponseHeaders() {
        return $this->lastResponse;
    }
}

?>

