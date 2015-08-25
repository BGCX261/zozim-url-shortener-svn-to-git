<?php

/*
 * Zozim URL Shortener Script v0.1
 * Copyright 2011 Zozim Group
 *
 * Website: http://zoz.im
 * License: http://zoz.im/info/license
 *
 * ./inc/header.php - last updated: september 25, 2011 by igeekygeek
 * 
 */

 
$data['configFile'] = "./inc/config.php";
$data['installFile'] = "./install/install.php";


if(file_exists($data['configFile'])) {
	(@include_once 'config.php') or die("ERROR: Config File Missing!");
	if (file_exists($data['installFile']))
	{
		$data['installExists'] = true;
		
	}
	$data['configExists'] = true;
}
else
{
	$data['configExists'] = false;
}




?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $currentPage . $config['separator'] . $config['sitename']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
$siteURL = $config['siteurl'];
(@include_once './style/header.htm') or die("ERROR: Header Template File Missing!");

if($data['configExists'] === true)
{
mysql_connect ($config['dbhost'], $config['dbuser'], $config['dbpass'])or die("ERROR: Could not connect: ".mysql_error());
mysql_select_db($config['dbname']) or die(mysql_error());
}

?>