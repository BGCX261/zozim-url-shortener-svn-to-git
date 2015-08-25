<?php

$data['configFile'] = "./inc/config.php";
$data['installFile'] = "./install/install.php";


if(file_exists($data['configFile'])) {
	echo "EXISTS";
}
else
{
	echo "NOPE!";
}

echo "<br>";

if(file_exists($data['installFile'])) {
	echo "EXISTS";
}
else
{
	echo "NOPE!";
}