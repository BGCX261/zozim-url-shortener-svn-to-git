<?php

/*
 * Zozim URL Shortener Script v0.1
 * Copyright 2011 Zozim Group
 *
 * Website: http://zoz.im
 * License: http://zoz.im/info/license
 *
 * index.php - last updated: september 25, 2011 by igeekygeek
 * 
 */
 
 // Page URL
$currentPage = "Home";

// Load Header
(@include_once './inc/header.php') or die("ERROR: Header File Missing!");

if($data['configExists'] === false)
{
	echo 'Oops! It seems you have not installed Zozim yet. <a href="./install/">Click here to go to the installer</a>.';
	die();
}

if($data['installExists'] === true)
{
	echo 'Oops! It seems you have forgotten to delete the install directory. Please do that before attempting to use Zozim';
	die();
}

// Load Variable
$data['ipaddress'] = $_SERVER['REMOTE_ADDR'];

echo '<form action="shorten.php" method="post">';
if($config['clickClear'] === true)
{
	echo '<input onfocus="this.value=\'\'" type="text" name="longurl" value="Type your long URL here..." />';
}
else
{
	echo 'Your Long URL: <input type="text" name="longurl" />';
}

echo '<input type="hidden" name="ps" value="1" />
<input type="submit" value="Shorten URL!" />
</form>';

// Load Footer
(@include_once './inc/footer.php') or die("ERROR: Footer File Missing!");

?>