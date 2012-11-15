<?php
if (!defined('THINK_PATH')) exit();
$lc_version = require './version.inc.php';
$config	= require './config.inc.php';
$dcd_config = array(
);
return array_merge($lc_version,$config,$dcd_config);
?>