<?php

/*
 * Zozim URL Shortener Script v0.1
 * Copyright 2011 Zozim Group
 *
 * Website: http://zoz.im
 * License: http://zoz.im/info/license
 *
 * shorten.php - last updated: september 25, 2011 by igeekygeek
 * 
 */
 
 // Page URL
$currentPage = "Shorten URL";

// Load Header
(@include_once './inc/header.php') or die("ERROR: Header File Missing!");

// Load Variable
$data['ps'] = mysql_real_escape_string($_POST['ps']);
$data['ipaddress'] = $_SERVER['REMOTE_ADDR'];


if($data['ps'] != 1)
{
	echo "Oops! There seems to have been an error. Did you forget to submit the form?";
	include './inc/footer.php';
	die();
}
else
{
	// Define some variables
	$error_message = "";
	
	// Check if URL is valid
	
	$data['longurl'] = $_POST['longurl'];
	
	if($data['longurl'] == "\\'")
	{
		$error_message = "Oops! That URL appears to be invalid.";
	}
	
	$data['longurl'] = mysql_real_escape_string($data['longurl']);
	$data['longurl'] = filter_var($data['longurl'], FILTER_SANITIZE_URL);
	
	if(empty($data['longurl']))
	{
		$error_message = "Oops! You forgot to enter a long URL to shorten.";
	}
	
	$check['1'] = mysql_query("SELECT * FROM ". $config['tableprefix'] . "urls WHERE longurl='$data[longurl]'");
	$check['2'] = mysql_num_rows($check['1']);
	
	if($check['2'] > 0)
	{
		while($row = mysql_fetch_array($check['1']))
		{
			$data['shorturl'] = $row['shorturl'];
		}
		$error_message = "Oops! That URL has already been shortened. URL: <a href=\"". $data['shorturl'] ."\">" . $data['shorturl'] . "</a>.";
	}
	
	if($data['longurl'] == "\'" || $data['longurl'] == "\\\'")
	{
		$error_message = "Oops! That URL appears to be invalid.";
	}
	
	$check['3'] = strpos($data['longurl'],"http://");
	
	if($check['3'] === false)
	{
		$check['4'] = strpos($data['longurl'],"www.");
		
		if($check['4'] === false)
		{
			$error_message = "Oops! That URL appears to be invalid. Did you forget the <em>http://</em>?";
		}
	}
	
	// Make the random url
	if($config['mode'] == "random" && $config['modetype'] == "alphanumeric")
	{
		$data['chars'] = $config['alphanumeric_chars'];
		$data['shortid'] = "";
		for($i = 0; $i < $config['urlnum']; $i++)
		{
			$data['shortid'] .= substr($data['chars'], (rand()%(strlen($data['chars']))), 1);
		}
	}
	else if($config['mode'] == "random" && $config['modetype'] == "alpha")
	{
		$data['chars'] = $config['alpha_chars'];
		$data['shortid'] = "";
		for($i = 0; $i < $config['urlnum']; $i++)
		{
			$data['shortid'] .= substr($data['chars'], (rand()%(strlen($data['chars']))), 1);
		}
	}
	else if($config['mode'] == "random" && $config['modetype'] == "numeric")
	{
		$data['chars'] = $config['numeric_chars'];
		$data['shortid'] = "";
		for($i = 0; $i < $config['urlnum']; $i++)
		{
			$data['shortid'] .= substr($data['chars'], (rand()%(strlen($data['chars']))), 1);
		}
	}
	else
	{
		$error_message = "ERROR: Internal Error!";
	}
	
	if($error_message != "")
	{
		echo $error_message . "<br />";
		(@include_once './inc/footer.php') or die("ERROR: Footer File Missing!");
		die();
	}
	
	$data['shorturl'] = $config['siteurl'] . $data['shortid'];
	
	mysql_query("INSERT INTO " . $config['tableprefix'] . "urls (longurl, shorturl, shortid, ipaddress) VALUES ('$data[longurl]','$data[shorturl]','$data[shortid]','$data[ipaddress]')");
	
	// At last, success!
	echo "Success! Your short URL is: <a href=". $data['shorturl'] . ">" . $data['shorturl'] . "</a>.<br>";
}

(@include_once './inc/footer.php') or die("ERROR: Footer File Missing!");

?>