<?php

/*
 * Zozim URL Shortener Script v0.1
 * Copyright 2011 Zozim Group
 *
 * Website: http://zoz.im
 * License: http://zoz.im/info/license
 *
 * ./inc/footer.php - last updated: september 24, 2011 by igeekygeek
 * 
 */
 

(@include_once './inc/config.php') or die("ERROR: Config File Missing!");

$siteName = $config['sitename'];

(@include_once './style/footer.htm') or die("ERROR: Footer Template File Missing!");

mysql_close();

?>