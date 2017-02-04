Readme - Rapidshare Premium Link Generator


1. REQUIREMENTS
===============

- PHP
- MySQL
- cURL
- Sockets
- And offcourse, good traffic :)
- cronjobs

2. INSTALLING
=============

1. SQL, make an sql database with your controlpanel (cPanel, DA,...) and instert the file "sql.sql" from "db" folder
2. Update these files: vars.php, config.php, db.php, network_standalone.php (only if you work with multiple servers)
3. Protect admin area with your controlpanel (htaccess)
4. Login to your admin aread and add accounts, also select the type, free = accounts for free downloaders, premium = accounts for premium downloaders
5. Now add a server, do this by adding the server in the panel, its usefull to use phpmyadmin if you don't understand the admin area.
6. Also don't forget to change the title in the index.php


2.1 Cronjobs
------------

00:01 (1 minute after midnight) -> php -q /home/"hostusername"/public_html/admin/accountcheck.php          ("hostusername" (without quotes) is your username for your host)
*/7 (every 7 minutes) -> php -q /home/"hostusername"/public_html/network_standalone.php  // if you work with multiple servers, then this is needed
*/5 (every 5 minutes) -> php -q /home/"hostusername"/public_html/admin/accountcheck.php 
*/10 (every 10 minutes) -> php -q /home/"hostusername"/public_html/admin/cron10min.php                      // You may change this, this is a reset every x minutes of the "free" downloaders
00:00 (midnight) -> php -q /home/"hostusername"/public_html/admin/cron.php
00:00 (midnight) -> php -q /home/"hostusername"/public_html/admin/refcron.php

THESE CRONJOBS COMMANDS ARE USED WITH cPanel (most versions will execute these, if it is not working, contact your host)


3. SERVERS
==========

3.1 Downloadservers
-------------------

- In the folder multiple servers you have 2 folders
- mainserver, edit the file "download.php" ($downloadserverdomain and $mysqlserver) need to be changed, 
	$downloadserverdomain is the domain you use for your downloadservers, for example:
	'dl1.domain.com', then domain.com would be the $downloadserverdomain
	Now upload the file "download.php" to your url you have setted in "vars.php"
- downloadserver, edit the file "download.php" ($downloadserverdomain and $mysqlserver) need to be changed,
	$downloadserverdomain is the domain you use for your downloadservers, for example:
	'dl1.domain.com', then domain.com would be the $downloadserverdomain
	Now upload the file to your downloadserver(s)
- now add the downloadserver in the admin panel


3.3 SQL SERVER
--------------

- Go to the folder "sqlserver" and edit the file get_file_info.php


- SQL file: in the folder "db"

3.4 Payment processors
----------------------

AlertPay IPN: - alertpaydone.php (you need to edit the $ap_SecurityCode var, also you need to configure your alertpay account
PayPal IPN: - ppdone.php (you need to edit $auth_token var, also you need to configure your paypal account)
DaoPay (modbile): - mobdone.php - you need to make a website and edit the values on that page


4. UPDATES
----------

1. There's a known bug because of the rapidshare update, on some accounts its showing the old premium zone page and "accountcheck.php" won't work. We will send an update when this is fixed.
2. We will send updates if we change our script,...


MAKE SURE TO PROTECT THE ADMIN DIRECTORY


Enjoy using the site!

YOU ARE NOT ALLOWED TO SELL THIS SCRIPT OR CHANGE IT AND SELL IT UNDER ANOTHER NAME
