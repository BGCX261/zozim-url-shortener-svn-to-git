<?php

/*
 * Zozim URL Shortener Script v0.1
 * Copyright 2011 Zozim Group
 *
 * Website: http://zoz.im
 * License: http://zoz.im/info/license
 *
 * ./install/install.php - last updated: september 24, 2011 by igeekygeek
 * 
 */
 
(@include_once './header.htm') or die("ERROR: Header File Missing!");

$install['ps'] = $_POST['ps'];
$install['dbname'] = $_POST['dbname'];
$install['dbhost'] = $_POST['dbhost'];
$install['dbuser'] = $_POST['dbuser'];
$install['dbpass'] = $_POST['dbpass'];
$install['siteurl'] = $_POST['siteurl'];
$install['sitename'] = $_POST['sitename'];
$install['tableprefix'] = $_POST['tableprefix'];


if($install['ps'] != 1)
{
	echo "Oops!";
}
else
{
	// Check database for connection
	mysql_connect ($install['dbhost'], $install['dbuser'], $install['dbpass'])or die("Zozim could not connect with the specified username and password. Are you sure you spelled it correctly?");
	mysql_select_db($install['dbname']) or die("Zozim cannot find that database. Are you sure you spelled it correctly?");
	
	// Escape all details
	$install['siteurl'] = mysql_real_escape_string($install['siteurl']);
	$install['sitename'] = mysql_real_escape_string($install['sitename']);
	
	// Check for valid details
	$error_message = "";
	if(empty($install['sitename']))
	{
		$error_message = "Oops! It seems you have forgotten to enter a site name.";
	}
	if(empty($install['siteurl']))
	{
		$error_message = "Oops! It seems you have forgotten to enter a site URL.";
	}
	
	$check['1'] = substr($install['siteurl'], -1);
	$check['2'] = substr($install['siteurl'], -2, 1);

	if($check['1'] == "/")
	{
		if($check['2'] == "/")
		{
			$error_message = "Oops! You seem to have put two trailing slashes. Please go back and only put one.";
		}
	}
	
	if($check['1'] != "/")
	{
		$error_message = "Oops! You seem to have forgot to put a trailing slash on the site url. Please go back and put one." . $install['siteurl'];
	}
	
	if($error_message != "")
	{
		echo $error_message;
		include './footer.htm';
		die();
	}
	
	// Create our Config File!

$install['file'] = fopen("../inc/config.php", "w") or die("Your config file is not writable. Please chmod it to 666 and try again.");
$install['fileText'] = '<?php

/*
 * Zozim URL Shortener Script v0.1
 * Copyright 2011 Zozim Group
 *
 * Website: http://zoz.im
 * License: http://zoz.im/info/license
 *
 * ./inc/config.php
 * 
 */
 
$config[\'dbname\'] = "' . $install['dbname'] . '";
$config[\'dbuser\'] = "' . $install['dbuser'] . '";
$config[\'dbpass\'] = "' . $install['dbpass'] . '";
$config[\'dbhost\'] = "' . $install['dbhost'] . '";
$config[\'tableprefix\'] = "' . $install['tableprefix'] . '";

/* 
 * Site Name - It\'s the name of your site!
 * Site URL - The url of your site: WITH trailing slash!
 * Seperator - The character to seperate page name with site title in the <title> tags.
 */
 
$config[\'sitename\'] = "' . $install['sitename'] . '";
$config[\'siteurl\'] = "' . $install['siteurl'] . '";
$config[\'separator\'] = " - ";

/* --------------------- DO NOT EDIT BELOW THIS LINE UNLESS TOLD OTHERWISE --------------------- */

/* 
 * Mode - The mode of shortened links. Default: random
 * Mode Type - The type / style of the mode you are using. Default: alphanumeric
 * URL Num - The number of characters for short IDs to be. Example: 5, short url would be: zoz.im/1b3xa
 * alphanumeric_chars - The characters used in alphanumeric mode type.
 * alpha_chars - Letters used in alpha mode type.
 * numeric_chars - Numbers used in numeric mode type.
 * clickClear - Have a message & clear when clicked in long url input box.
 */
 
$config[\'mode\'] = "random";
$config[\'modetype\'] = "alphanumeric";
$config[\'urlnum\'] = "5";
$config[\'alphanumeric_chars\'] = "abcdefghijklmnopqrstuvwxyz01234567890123456789";
$config[\'alpha_chars\'] = "abcdefghijklmnopqrstuvwxyz";
$config[\'numeric_chars\'] = "0123456789";
$config[\'clickClear\'] = true;

?>';
fwrite($install['file'], $install['fileText']);
fclose($install['file']);
	
	// Create our table!
	mysql_query("CREATE TABLE `" . $install['dbname'] ."`.`". $install['tableprefix'] . "urls` (`id` INT(16) NOT NULL AUTO_INCREMENT PRIMARY KEY, `longurl` VARCHAR(500) NOT NULL, `shorturl` VARCHAR(255) NOT NULL, `shortid` VARCHAR(16) NOT NULL, `dateadded` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `clicks` INT(16) NOT NULL, `ipaddress` VARCHAR(255) NOT NULL) ENGINE = MyISAM;");
	
	echo "Success! Zozim has been installed. <strong>Please delete the install directory before using.</strong><br />";
	
	mysql_close();
}

(@include_once './footer.htm') or die("ERROR: Footer File Missing!");