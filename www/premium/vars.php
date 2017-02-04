<?php

$server = "e-profissionalizando.com/premium"; // This will be the url where users will be redirected to when they want to download a file
$sitename = "rapidshare-premium"; // Websitename
$domain = "rapidshare-premium.com"; // Domain

//Define packs
$pack1 = 500; // Pack 1 -> 1 EUR
$pack2 = 2000; // Pack 2 -> 3 EUR
$pack3 = 5000; // Pack 3 -> 6 EUR
$percentref = 30; // If a premium user reffers a user to buy a pack, then this is the percent he will get of the total ordered credits
// Define ref pack values
$refamountpack1 = ($pack1 * $percentref) / 100;
$refamountpack2 = ($pack2 * $percentref) / 100;
$refamountpack3 = ($pack3 * $percentref) / 100;


$daily = "10"; // How much downloads are allowed per RESET
$dailyip = "5"; // How much downloads are allowed per day per IP


$paypalemail = "email@domain.com";
$alertpayemail = "email@domain.com";


// Errormessages

$errormsgservers = "Sorry, but our servers are very busy with handling your processes. Please wait a few minutes - WANT TO DOWNLOAD MORE? KEEP SUPPORTING OUR SPONSORS & ADS";
$errorrsaccounts = "Sorry, our Rapidshare account for FREE pins are out of usage. Try again tomorrow or upgrade to PREMIUM - WANT TO DOWNLOAD MORE? KEEP SUPPORTING OUR SPONSORS & ADS";
$errorgloballimitexceeded = "<br />Sorry but our 10 minute limit of $limittot downloads has been exceeded for free downloaders. <a href=?page=ads><b>Click here</b></a> to raise it!  Upgrade to PREMIUM to download more! Sorry, but come again in a few minutes. Support us to get more downloads...<br />";
$errorpersonalbandwidth = "Sorry, you ($usrip) have downloaded $dailyip files, you can get more downloads with our referral system. Your referral link is: <a href=?page=ref&type=free&ID=$usrip>?page=ref&type=free&ID=$usrip</a> (Right click - copy url)";

?>