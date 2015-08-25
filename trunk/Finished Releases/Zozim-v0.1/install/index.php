<?php

/*
 * Zozim URL Shortener Script v0.1
 * Copyright 2011 Zozim Group
 *
 * Website: http://zoz.im
 * License: http://zoz.im/info/license
 *
 * ./install/index.php - last updated: september 24, 2011 by igeekygeek
 * 
 */
 
(@include_once './header.htm') or die("ERROR: Header File Missing!");

?>

Welcome to the Zozim installer! Fill in the information below to install Zozim! <br /> <br />

<form action="install.php" method="post">
<table border="0">
<tr>
<td colspan="3"><strong>Your URL Shortener Information</strong></td>
</tr>
<tr>
<td><div style="text-align: left; padding-left: 2px;" >Site Name: </div></td>
<td><input type="text" name="sitename" value="My URL Shortener" onfocus="this.value=''"></td>
<td>The name of your URL Shortener!</td>
</tr>
<tr>
<td><div style="text-align: left; padding-left: 2px;" >Site URL: </div></td>
<td><input type="text" name="siteurl" value="http://example.com/" onfocus="this.value=''"></td>
<td>The URL of your site WITH trailing slash.</td>
</tr>
<tr>
<td><div style="text-align: left; padding-left: 2px;" >Table Prefix: </div></td>
<td><input type="text" name="tableprefix" value="zozim_" onfocus="this.value=''"></td>
<td>Prefix for multiple installs in one database.</td>
</tr>
<tr>
<td colspan="3"><strong>Database Information</strong></td>
</tr>
<tr>
<td><div style="text-align: left; padding-left: 2px;" >Database Name: </div></td>
<td><input type="text" name="dbname"></td>
<td>The name of the database to use.</td>
</tr>
<tr>
<td><div style="text-align: left; padding-left: 2px;" >Database Username: </div></td>
<td><input type="text" name="dbuser"></td>
<td>Your database username.</td>
</tr>
<tr>
<td><div style="text-align: left; padding-left: 2px;" >Database Password: </div></td>
<td><input type="password" name="dbpass"></td>
<td>Your database password.</td>
</tr>
<tr>
<td><div style="text-align: left; padding-left: 2px;" >Database Hostname: </div></td>
<td><input type="text" name="dbhost" value="localhost"></td>
<td>You probably don't need to change this.</td>
</tr>
<tr>
<td colspan="3"><input type="hidden" name="ps" value="1"><input type="submit" value="Install Zozim!"></td>
</tr>
</table> 
</form>

<?php

(@include_once './footer.htm') or die("ERROR: Header File Missing!");