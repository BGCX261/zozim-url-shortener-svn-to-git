<?php

/*
 * Zozim URL Shortener Script v0.1
 * Copyright 2011 Zozim Group
 *
 * Website: http://zoz.im
 * License: http://zoz.im/info/license
 *
 * go.php - last updated: september 25, 2011 by igeekygeek
 * 
 */

// Load Config
(@include_once './inc/config.php') or die("ERROR: Config File Missing!");

$currentPage = "Home";

mysql_connect ($config['dbhost'], $config['dbuser'], $config['dbpass'])or die("ERROR: Could not connect: ".mysql_error());
mysql_select_db($config['dbname']) or die(mysql_error());

// Load short URL
$data['u'] = mysql_real_escape_string($_GET['u']);

$check['1'] = substr($data['u'], -1);

if($check['1'] == "/")
{
	$data['u'] = substr_replace($data['u'], '', -1, 1);
}

$query = mysql_query("SELECT * FROM " . $config['tableprefix'] . "urls WHERE shortid='$data[u]'");
$query2 = mysql_num_rows($query);

if($query2 < 1)
{
	include './inc/header.php';
	echo "The entered url is invalid. <br />";
	include './inc/footer.php';
	die();
}
else
{
	mysql_query("UPDATE " . $config['tableprefix'] . "urls SET clicks = clicks+1 WHERE shortid='$data[u]'");
	
	while($row = mysql_fetch_array($query))
	{
		$data['longurl'] = $row['longurl'];
	}
	
	$data['shorturl'] = $config['siteurl'] . $data['u'];
	header("Location: $data[longurl]");
}

mysql_close();

?>