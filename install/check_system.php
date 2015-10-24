<?php
/**
 * Slims Installer files
 *
 * Copyright © 2006 - 2012 Advanced Power of PHP
 * modification by Waris Agung Widodo (ido.alit@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */
require 'settings.php';
require 'compat.php';

// system rec
$phpversion = '5.4.0';

// default state
$php_pass = 0;
$db_pass = 0;
$gd_pass = 0;
$yaz_pass = 0;
$pass = 0;
$pass_max = 3;

// ststus html
$success = '<i class="fa fa-check-square status-success"></i>';
$error = '<i class="fa fa-exclamation-triangle status-error"></i>';

// checking
if ($php = isPhpOk($phpversion)) {
    $php_pass = 1;
    $pass++;
}

if ($databaseDriver = isDatabaseDriverOk()) {
    $db_pass = 1;
    $pass++;
}

if ($gd = isGdOk()) {
    $gd_pass = 1;
    $pass++;
}

if ($yaz = isYazOk()) {
	$yaz_pass = 1;
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Step 1 | Slims Installer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="shortcut icon" href="img/webicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
</head>
<body>
    <div class="wrapper">
	<div class="title">
	    <h2>Step 1 - Environment Checking</h2>
	</div>
	<p class="message">Check the minimum system environment for installing SLiMS</p>
	<div class="content hastable">
		<div class="items">
			<div class="key">
				PHP version
			</div>
			<div class="value">
				<?php echo phpversion(); ?>
			</div>
			<div class="status">
				<?php echo ($php_pass) ? $success : $error; ?>
			</div>
			<div class="status-message">
				<?php echo ($php_pass) ? '' : '&nbsp; <em>min : '.$phpversion.'</em>'; ?>
			</div>
		</div>

		<div class="items">
			<div class="key">
				DatabaseDriver
			</div>
			<div class="value">
				<?php echo databaseDriverType(); ?>
			</div>
			<div class="status status-error">
				<?php echo ($db_pass) ? $success : $error; ?>
			</div>
			<div class="status-message">
				<?php echo ($db_pass) ? '' : '&nbsp; <em>min : mysql or mysqli</em>'; ?>
			</div>
		</div>

		<div class="items">
			<div class="key">
				GD
			</div>
			<div class="value">
				<?php echo ($db_pass) ? 'Yes' : 'No'; ?>
			</div>
			<div class="status status-error">
				<?php echo ($gd_pass) ? $success : $error; ?>
			</div>
			<div class="status-message"></div>
		</div>

		<div class="items">
			<div class="key">
				YAZ
			</div>
			<div class="value">
				<?php echo ($yaz_pass) ? 'Yes' : 'No'; ?>
			</div>
			<div class="status status-error">
				<?php echo ($yaz_pass) ? $success : $error; ?>
			</div>
			<div class="status-message">
				<?php echo ($yaz_pass) ? '' : '&nbsp; <em>optional</em>'; ?>
			</div>
		</div>

		<div class="toright">
			<input type="button" class="button" name="btn_cancel" value="Back" onclick="document.location.href='index.php'">
			<?php
			if ($pass == $pass_max) { ?>
				<input type="button" class="button" value="Next" name="submit" title="Click to start installation" onclick="document.location.href='install.php'">
			<?php } else { ?>
			<input type="button" class="button disabled" disabled="" value="Next">
			<?php } ?>
	    </div>
	</div>
	<?php include_once("footer.php"); ?>
</div>
</body>
</html>