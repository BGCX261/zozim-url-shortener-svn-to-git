<?php

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
 
$config['dbname'] = "zozim_urls";
$config['dbuser'] = "zozim_urls";
$config['dbpass'] = "6FU4sJ5NF6fsZQS5";
$config['dbhost'] = "localhost";
$config['tableprefix'] = "prefix_";

/* 
 * Site Name - It's the name of your site!
 * Site URL - The url of your site: WITH trailing slash!
 * Seperator - The character to seperate page name with site title in the <title> tags.
 */
 
$config['sitename'] = "Zozim URL Shortener";
$config['siteurl'] = "http://localhost/zozim/";
$config['separator'] = " - ";

/* ---------------------------- DO NOT EDIT BELOW THIS LINE UNLESS TOLD OTHERWISE ---------------------------- */

/* 
 * Mode - The mode of shortened links. Default: random
 * Mode Type - The type / style of the mode you are using. Default: alphanumeric
 * URL Num - The number of characters for short ID's to be. Example: 5, short url would be: zoz.im/1b3xa
 * alphanumeric_chars - The characters used in alphanumeric mode type.
 * alpha_chars - Letters used in alpha mode type.
 * numeric_chars - Numbers used in numeric mode type.
 * clickClear - Have a message & clear when clicked in long url input box.
 */
 
$config['mode'] = "random";
$config['modetype'] = "alphanumeric";
$config['urlnum'] = "5";
$config['alphanumeric_chars'] = "abcdefghijklmnopqrstuvwxyz01234567890123456789";
$config['alpha_chars'] = "abcdefghijklmnopqrstuvwxyz";
$config['numeric_chars'] = "0123456789";
$config['clickClear'] = true;

?>